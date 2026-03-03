<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('member')->check()) {
            return redirect()->route('frontend.index');
        }
        return view('frontend.login');
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

            return response()->json(['success' => true, 'redirect' => route('frontend.index')]);
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
            return redirect()->route('frontend.login');
        }
        return view('frontend.myinfo', compact('member'));
    }

    public function showMyInfoEditForm()
    {
        $member = Auth::guard('member')->user();
        if (!$member) {
            return redirect()->route('frontend.login');
        }
        return view('frontend.myinfo_edit', compact('member'));
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

        return response()->json(['success' => true, 'message' => '정보가 수정되었습니다.', 'redirect' => route('frontend.myinfo')]);
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

        return response()->json(['success' => true, 'message' => '비밀번호가 성공적으로 변경되었습니다.', 'redirect' => route('frontend.myinfo')]);
    }

    public function checkDuplicateId(Request $request)
    {
        $userId = $request->input('userId');
        $exists = \App\Models\Member::where('userId', $userId)->exists();

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

        return response()->json(['success' => true, 'redirect' => route('frontend.join04')]);
    }

    public function logout(Request $request)
    {
        Auth::guard('member')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('frontend.index');
    }
}
