<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\AdminTempPasswordMail;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.admag.HNA_Admag_list_001', compact('admins'));
    }

    public function massDestroy(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            Admin::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }

    public function create()
    {
        return view('admin.admag.HNA_Admag_Regi_001');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:admins,username|regex:/^[a-zA-Z0-9]+$/',
            'password' => 'required|string|min:10|max:16|regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/|confirmed',
            'phone' => 'required|string',
            'email' => 'required|email',
        ], [
            'required' => '입력항목을 확인 후 등록버튼을 선택해주세요.',
            'username.regex' => '아이디는 영문 또는 영문+숫자만 가능합니다.',
            'password.regex' => '10~16자의 숫자와 영문 대 소문자 조합으로 사용하세요.',
            'password.confirmed' => '비밀번호가 일치하지 않습니다.',
            'username.unique' => '이미 사용 중인 아이디입니다.',
        ]);

        Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return redirect()->route('HNA_Admag_list_001')->with('success', '등록되었습니다.');
    }

    public function show(Admin $admin)
    {
        return view('admin.admag.HNA_Admag_view_001', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        return view('admin.admag.HNA_Admag_Modi_001', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:10|max:16|regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/|confirmed',
            'phone' => 'required|string',
            'email' => 'required|email',
        ], [
            'required' => '입력항목을 확인 후 등록버튼을 선택해주세요.',
            'password.regex' => '10~16자의 숫자와 영문 대 소문자 조합으로 사용하세요.',
            'password.confirmed' => '비밀번호가 일치하지 않습니다.',
        ]);

        $admin->name = $request->name;
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->save();

        return redirect()->route('HNA_Admag_view_001', $admin->id)->with('success', '수정되었습니다.');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('HNA_Admag_list_001')->with('success', '삭제되었습니다.');
    }

    // --- 로그인 및 정보 찾기 추가 ---

    public function loginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('HNA_Admag_list_001');
        }
        return view('admin.login.HNA_Login_001');
    }

    public function findIdForm()
    {
        return view('admin.login.HNA_FindId_001');
    }

    public function findPwForm()
    {
        return view('admin.login.HNA_FindPw_001');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => '아이디를 정확하게 입력해주세요',
            'password.required' => '비밀번호를 정확하게 입력해주세요',
        ]);

        if (Auth::guard('admin')->attempt($credentials, false)) {
            if ($request->remember) {
                Cookie::queue('remember_admin_id', $request->username, 60*24*30); // 30일
            } else {
                Cookie::queue(Cookie::forget('remember_admin_id'));
            }
            return redirect()->route('HNA_Admag_list_001');
        }

        return back()->withErrors(['login_fail' => '아이디 또는 비밀번호가 일치하지 않습니다.'])->withInput($request->only('username'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('HNA_Login_001');
    }

    public function findId(Request $request)
    {
        if (empty($request->name) || empty($request->email)) {
            return response()->json(['success' => false, 'message' => '입력항목을 확인후 입력해 주세요']);
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['success' => false, 'message' => '이메일 주소 형식이 올바르지 않습니다.']);
        }

        $admin = Admin::where('name', $request->name)
                      ->where('email', $request->email)
                      ->first();

        if ($admin) {
            return response()->json(['success' => true, 'username' => $admin->username]);
        }
        return response()->json(['success' => false, 'message' => '입력하신 정보와 일치하는 아이디를 찾을 수 없습니다.']);
    }
    public function findPw(Request $request)
    {
        if (empty($request->username) || empty($request->name) || empty($request->email)) {
            return response()->json(['success' => false, 'message' => '입력항목을 확인후 입력해 주세요']);
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['success' => false, 'message' => '이메일 주소 형식이 올바르지 않습니다.']);
        }

        $admin = Admin::where('username', $request->username)
                      ->where('name', $request->name)
                      ->where('email', $request->email)
                      ->first();

        if ($admin) {
            // 임시 비밀번호 생성
            $tempPassword = Str::random(10);
            
            // 비밀번호 업데이트
            $admin->password = Hash::make($tempPassword);
            $admin->save();

            // 이메일 발송
            try {
                Mail::to($admin->email)->send(new AdminTempPasswordMail($tempPassword));
                return response()->json(['success' => true, 'email' => $admin->email, 'username' => $admin->username]);
            } catch (\Exception $e) {
                \Log::error('Mail sending failed: ' . $e->getMessage());
                return response()->json(['success' => false, 'message' => '이메일 발송 중 오류가 발생했습니다.']);
            }
        }

        return response()->json(['success' => false, 'message' => '입력하신 정보와 일치하는 관리자 정보를 찾을 수 없습니다.']);
    }
}
