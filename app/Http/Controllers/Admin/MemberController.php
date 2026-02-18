<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $searchType = $request->input('search_type');
        $searchKeyword = $request->input('search_keyword');

        $query = Member::query();

        if ($searchType && $searchKeyword) {
            if ($searchType === 'username') {
                $query->where('username', 'like', "%{$searchKeyword}%");
            } elseif ($searchType === 'name') {
                $query->where('name', 'like', "%{$searchKeyword}%");
            } elseif ($searchType === 'email') {
                $query->where('email', 'like', "%{$searchKeyword}%");
            }
        }

        $totalCount = $query->count();
        $members = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.memmag.HNA_Memmag_List_001', compact('members', 'totalCount', 'searchType', 'searchKeyword'));
    }

    public function massDestroy(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            Member::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }

    public function create()
    {
        return view('admin.memmag.HNA_Memmag_Regi_001');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:members,username|regex:/^[a-zA-Z0-9]+$/',
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

        Member::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password, // Member 모델에서 hashed 캐스트 사용 중
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return redirect()->route('HNA_Memmag_List_001')->with('success', '등록되었습니다.');
    }

    public function show(Member $member)
    {
        return view('admin.memmag.HNA_Memmag_View_001', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('admin.memmag.HNA_Memmag_Modi_001', compact('member'));
    }

    public function update(Request $request, Member $member)
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

        $member->name = $request->name;
        if ($request->filled('password')) {
            $member->password = $request->password;
        }
        $member->phone = $request->phone;
        $member->email = $request->email;
        $member->save();

        return redirect()->route('HNA_Memmag_View_001', $member->id)->with('success', '수정되었습니다.');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('HNA_Memmag_List_001')->with('success', '삭제되었습니다.');
    }
}
