<?php

namespace App\Http\Controllers\Front\Memorial;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LetterController extends Controller
{
    /**
     * 하늘편지 목록 페이지
     */
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'all'); // all or my
        $searchType = $request->input('search_type', 'all');
        $search = $request->input('search');

        $query = Letter::query();

        if ($tab === 'my') {
            if (!auth()->guard('member')->check()) {
                return redirect()->route('front.login')->with('error', '로그인이 필요한 서비스입니다.');
            }
            $query->where('username', auth()->guard('member')->user()->username);
        }

        if ($search) {
            $query->where(function($q) use ($search, $searchType) {
                if ($searchType === 'username') {
                    $q->where('username', 'like', "%{$search}%");
                } elseif ($searchType === 'content') {
                    $q->where('content', 'like', "%{$search}%");
                } elseif ($searchType === 'author') {
                    $q->where('author_description', 'like', "%{$search}%");
                } else {
                    $q->where('username', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%")
                      ->orWhere('author_description', 'like', "%{$search}%");
                }
            });
        }

        $letters = $query->orderBy('created_at', 'desc')->paginate(10);
        $allCount = Letter::count();
        $myCount = auth()->guard('member')->check() ? Letter::where('username', auth()->guard('member')->user()->username)->count() : 0;
        $totalCount = $letters->total(); // 현재 필터(검색 등) 기준 총 개수

        return view('front.memorial.letter.HN_Memorial_Letterlist_001', compact('letters', 'allCount', 'myCount', 'totalCount', 'tab', 'search'));
    }

    /**
     * 하늘편지 작성 페이지
     */
    public function create()
    {
        if (!auth()->guard('member')->check()) {
            return redirect()->route('front.login')->with('error', '로그인이 필요한 서비스입니다.');
        }

        return view('front.memorial.letter.HN_Memorial_Letterregi_001');
    }

    /**
     * 하늘편지 저장
     */
    public function store(Request $request)
    {
        if (!auth()->guard('member')->check()) {
            return redirect()->route('front.login')->with('error', '로그인이 필요한 서비스입니다.');
        }

        $request->validate([
            'author_description' => 'required|max:50',
            'content' => 'required|max:1000',
        ], [
            'author_description.required' => '작성자를 입력해주세요.',
            'content.required' => '내용을 입력해주세요.',
        ]);

        Letter::create([
            'username' => auth()->guard('member')->user()->username, // 실제 회원 아이디 저장
            'author_description' => $request->author_description,
            'content' => $request->content,
            'is_private' => $request->has('is_private') ? 'Y' : 'N',
        ]);

        return redirect()->route('front.memorial.letterlist')->with('success', '편지가 소중하게 전달되었습니다.');
    }

    /**
     * 하늘편지 상세 보기
     */
    public function show($id)
    {
        $letter = Letter::findOrFail($id);

        // 비공개 글 접근 제어
        if ($letter->is_private === 'Y') {
            if (!auth()->guard('member')->check() || auth()->guard('member')->user()->username !== $letter->username) {
                return redirect()->route('front.memorial.letterlist')->with('error', '비공개 게시물입니다. 작성자 본인만 열람할 수 있습니다.');
            }
        }

        return view('front.memorial.letter.HN_Memorial_Letterview_001', compact('letter'));
    }

    /**
     * 하늘편지 수정 페이지
     */
    public function edit($id)
    {
        $letter = Letter::findOrFail($id);

        if (!auth()->guard('member')->check() || auth()->guard('member')->user()->username !== $letter->username) {
            return redirect()->route('front.memorial.letterlist')->with('error', '수정 권한이 없습니다.');
        }

        return view('front.memorial.letter.HN_Memorial_Letteredit_001', compact('letter'));
    }

    /**
     * 하늘편지 수정 처리
     */
    public function update(Request $request, $id)
    {
        $letter = Letter::findOrFail($id);

        if (!auth()->guard('member')->check() || auth()->guard('member')->user()->username !== $letter->username) {
            return redirect()->route('front.memorial.letterlist')->with('error', '수정 권한이 없습니다.');
        }

        $request->validate([
            'author_description' => 'required|max:50',
            'content' => 'required|max:1000',
        ], [
            'author_description.required' => '작성자를 입력해주세요.',
            'content.required' => '내용을 입력해주세요.',
        ]);

        $letter->update([
            'author_description' => $request->author_description,
            'content' => $request->content,
            'is_private' => $request->has('is_private') ? 'Y' : 'N',
        ]);

        return redirect()->route('front.memorial.letterview', $id)->with('success', '수정되었습니다.');
    }

    /**
     * 하늘편지 삭제 처리
     */
    public function destroy($id)
    {
        $letter = Letter::findOrFail($id);

        if (!auth()->guard('member')->check() || auth()->guard('member')->user()->username !== $letter->username) {
            return redirect()->route('front.memorial.letterlist')->with('error', '삭제 권한이 없습니다.');
        }

        $letter->delete();

        return redirect()->route('front.memorial.letterlist')->with('success', '삭제되었습니다.');
    }
}
