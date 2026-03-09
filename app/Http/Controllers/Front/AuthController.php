<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\FindIdMail;
use App\Mail\FindPwMail;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('member')->check()) {
            return redirect()->route('front.index');
        }
        return view('front.member.login.HN_Login_001');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::guard('member')->attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password']
        ], $request->filled('remember'))) {
            $request->session()->regenerate();

            return response()->json(['success' => true, 'redirect' => route('front.index')]);
        }

        return response()->json([
            'success' => false, 
            'message' => 'ID, 비밀번호를 확인하시고 다시 로그인 해주시기 바랍니다.'
        ], 422);
    }

    public function showMyInfo()
    {
        $member = Auth::guard('member')->user();
        if (!$member) {
            return redirect()->route('front.login');
        }
        return view('front.member.myinfo.HN_MemInfo_View_001', compact('member'));
    }

    public function showMyInfoEditForm()
    {
        $member = Auth::guard('member')->user();
        if (!$member) {
            return redirect()->route('front.login');
        }
        return view('front.member.myinfo.HN_MemInfo_Modi_001', compact('member'));
    }

    public function updateMyInfo(Request $request)
    {
        $member = Auth::guard('member')->user();
        if (!$member) {
            return response()->json(['success' => false, 'message' => '로그인이 필요합니다.'], 401);
        }

        $request->validate([
            'phone' => 'required|string',
            'email' => 'required|email',
        ], [
            'required' => '다시 한번 입력항목을 확인해 주세요.',
            'email' => '이메일 주소를 정확히 입력하세요.',
        ]);

        $member->update([
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return response()->json(['success' => true, 'message' => '정보가 수정되었습니다.', 'redirect' => route('front.myinfo')]);
    }

    public function changePassword(Request $request)
    {
        $member = Auth::guard('member')->user();
        if (!$member) {
            return response()->json(['success' => false, 'message' => '로그인이 필요합니다.'], 401);
        }

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|max:16|confirmed',
        ], [
            'current_password.required' => '기존 비밀번호를 입력해 주세요.',
            'password.required' => '새 비밀번호를 입력해 주세요.',
            'password.min' => '비밀번호는 최소 8자리 이상이어야 합니다.',
            'password.max' => '비밀번호는 최대 16자리 이하이어야 합니다.',
            'password.confirmed' => '변경 할 비밀번호가 일치하지 않습니다.',
        ]);

        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $member->password)) {
            return response()->json(['success' => false, 'message' => '기존 비밀번호가 일치하지 않습니다.'], 422);
        }

        $member->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        return response()->json(['success' => true, 'message' => '비밀번호가 성공적으로 변경되었습니다.', 'redirect' => route('front.myinfo')]);
    }

    public function checkDuplicateId(Request $request)
    {
        $userId = $request->input('userId');
        $exists = \App\Models\Member::where('username', $userId)->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => '이미 사용되고 있는 ID입니다.'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => '사용 가능한 ID입니다.'
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'userId' => 'required|string|unique:members,username|max:255',
            'userName' => 'required|string|max:255',
            'userPhone' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        \App\Models\Member::create([
            'username' => $data['userId'],
            'name' => $data['userName'],
            'phone' => $data['userPhone'],
            'email' => $data['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($data['password']),
        ]);

        return response()->json(['success' => true, 'redirect' => route('front.join03')]);
    }

    public function sendSms(Request $request)
    {
        $request->validate([
            'phone' => 'required|string'
        ]);

        // 실제 문자 발송 대신 6자리 난수 시뮬레이션
        $phone = $request->input('phone');
        $code = (string) rand(100000, 999999);

        // 세션에 1분간 저장
        $expiresAt = now()->addMinutes(1)->timestamp;
        session()->put('sms_auth_' . $phone, [
            'code' => $code,
            'expires_at' => $expiresAt
        ]);

        // SOLAPI 실 메시지 발송 연동 (Laravel Http(cGuzzle/cURL) 사용 - 닷홈 호스팅 대응)
        try {
            $apiKey = env('SOLAPI_API_KEY');
            $apiSecret = env('SOLAPI_API_SECRET');
            $senderKey = env('SOLAPI_SENDER');
            
            // Solapi V4 Auth (HMAC-SHA256)
            $date = date('Y-m-d\TH:i:s.v\Z'); // ISO-8601 with milliseconds
            $salt = uniqid();
            $signature = hash_hmac('sha256', $date . $salt, $apiSecret);
            $authHeader = "HMAC-SHA256 apiKey={$apiKey}, date={$date}, salt={$salt}, signature={$signature}";

            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Authorization' => $authHeader,
                'Content-Type' => 'application/json'
            ])->post('https://api.solapi.com/messages/v4/send', [
                'message' => [
                    'to' => preg_replace('/[^0-9]/', '', $phone),
                    'from' => preg_replace('/[^0-9]/', '', $senderKey),
                    'text' => "하늘누리 추모공원 가입 인증번호는 [" . $code . "] 입니다."
                ]
            ]);

            if ($response->failed()) {
                throw new \Exception('API Response Error: ' . $response->body());
            }

            \Illuminate\Support\Facades\Log::info("SOLAPI SMS Sent: Phone [{$phone}] Code [{$code}] Response: " . $response->body());
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('SOLAPI SMS sending failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => '발송 오류 원인: ' . $e->getMessage()
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => '입력하신 번호로 인증번호를 발송하였습니다.'
        ]);
    }

    public function verifySms(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'code' => 'required|string'
        ]);

        $phone = $request->input('phone');
        $inputCode = $request->input('code');

        $sessionData = session()->get('sms_auth_' . $phone);

        // 세션 데이터가 없거나, 만료시간이 지났거나, 코드가 틀리면 실패
        if (!$sessionData || now()->timestamp > $sessionData['expires_at'] || $sessionData['code'] !== $inputCode) {
            return response()->json([
                'success' => false,
                'message' => '인증번호가 올바르지 않거나 만료되었습니다.'
            ]);
        }

        // 인증 성공 후 세션 비우기
        session()->forget('sms_auth_' . $phone);
        // 가입 완료 시 검증을 위해 인증 완료 상태 저장
        session()->put('sms_verified_' . $phone, true);

        return response()->json([
            'success' => true,
            'message' => '인증이 완료되었습니다.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('member')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('front.index');
    }

    public function findId(Request $request)
    {
        if (empty($request->userName) || empty($request->userPhone)) {
            return response()->json(['success' => false, 'message' => '입력항목을 확인후 입력해 주세요']);
        }

        $member = \App\Models\Member::where('name', $request->userName)
                      ->whereRaw("REPLACE(phone, '-', '') = ?", [preg_replace('/[^0-9]/', '', $request->userPhone)])
                      ->first();

        if ($member) {
            $username = $member->username;
            // 아이디 마스킹 처리: 앞 3자리 이후 별표 처리 (이메일 형식이면 앞부분만 처리)
            if (strpos($username, '@') !== false) {
                $parts = explode('@', $username);
                $namePart = $parts[0];
                $maskedName = mb_substr($namePart, 0, 3) . str_repeat('*', max(0, mb_strlen($namePart) - 3));
                $maskedUsername = $maskedName . '@' . $parts[1];
            } else {
                $maskedUsername = mb_substr($username, 0, 3) . str_repeat('*', max(0, mb_strlen($username) - 3));
            }
            
            try {
                Mail::to($member->email)->send(new FindIdMail($member->name, $username));
                return response()->json(['success' => true, 'email' => $member->email]);
            } catch (\Exception $e) {
                \Log::error('Mail sending failed: ' . $e->getMessage());
                return response()->json(['success' => false, 'message' => '이메일 발송 중 오류가 발생했습니다. 잠시 후 다시 시도해주세요.']);
            }
        }
        
        return response()->json(['success' => false, 'message' => '입력하신 정보와 일치하는 아이디를 찾을 수 없습니다.']);
    }

    public function findPassword(Request $request)
    {
        if (empty($request->userName) || empty($request->userPhone)) {
            return response()->json(['success' => false, 'message' => '입력항목을 확인후 입력해 주세요']);
        }

        // 전화번호 하이픈 무시 비교
        $member = \App\Models\Member::where('name', $request->userName)
                      ->whereRaw("REPLACE(phone, '-', '') = ?", [preg_replace('/[^0-9]/', '', $request->userPhone)])
                      ->first();

        if ($member) {
            // 임시 비밀번호 생성 (10자리 문자열)
            $tempPassword = Str::random(10);
            
            // 비밀번호 업데이트
            $member->password = \Illuminate\Support\Facades\Hash::make($tempPassword);
            $member->save();

            // 이메일 발송
            try {
                Mail::to($member->email)->send(new FindPwMail($member->name, $tempPassword));
                return response()->json(['success' => true, 'email' => $member->email]);
            } catch (\Exception $e) {
                \Log::error('Mail sending failed: ' . $e->getMessage());
                return response()->json(['success' => false, 'message' => '이메일 발송 중 오류가 발생했습니다. 잠시 후 다시 시도해주세요.']);
            }
        }
        
        return response()->json(['success' => false, 'message' => '입력하신 정보와 일치하는 회원 정보를 찾을 수 없습니다.']);
    }
}
