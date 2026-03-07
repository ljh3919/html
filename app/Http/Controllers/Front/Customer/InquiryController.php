<?php

namespace App\Http\Controllers\Front\Customer;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\InquiryReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    /**
     * 나의 상담 목록
     */
    public function index(Request $request)
    {
        $member = Auth::guard('member')->user();
        if (!$member) {
            return redirect()->route('front.login');
        }

        $searchKeyword = $request->input('search_keyword');
        $query = Inquiry::where('username', $member->username);

        if ($searchKeyword) {
            $query->where(function($q) use ($searchKeyword) {
                $q->where('title', 'like', "%{$searchKeyword}%")
                  ->orWhere('content', 'like', "%{$searchKeyword}%");
            });
        }

        $inquiries = $query->orderBy('created_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('front.customer.councel.partials.list', compact('inquiries'))->render();
        }

        return view('front.customer.councel.HN_Customer_Councellist_001', compact('inquiries', 'searchKeyword'));
    }

    /**
     * 상담 등록 폼
     */
    public function create()
    {
        $member = Auth::guard('member')->user();
        if (!$member) {
            return redirect()->route('front.login');
        }

        return view('front.customer.councel.HN_Customer_Councelregi_001', compact('member'));
    }

    /**
     * 상담 저장
     */
    public function store(Request $request)
    {
        $member = Auth::guard('member')->user();
        if (!$member) {
            return abort(403);
        }

        $request->validate([
            'email' => 'required|email',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ], [
            'required' => '입력내용을 확인해주세요.',
        ]);

        Inquiry::create([
            'username' => $member->username,
            'email' => $request->email,
            'title' => $request->title,
            'content' => $request->content,
            'status' => '미답변',
        ]);

        return redirect()->route('front.customer.councel.index')->with('success', '등록되었습니다.');
    }

    /**
     * 상담 상세 및 답변 확인
     */
    public function show(Inquiry $inquiry)
    {
        $member = Auth::guard('member')->user();
        if (!$member || $inquiry->username !== $member->username) {
            return abort(403);
        }

        $inquiry->load('reply.attachments');

        return view('front.customer.councel.HN_Customer_Councelview_001', compact('inquiry'));
    }

    /**
     * 상담 수정 폼
     */
    public function edit(Inquiry $inquiry)
    {
        $member = Auth::guard('member')->user();
        if (!$member || $inquiry->username !== $member->username) {
            return abort(403);
        }

        if ($inquiry->status === '답변완료') {
            return back()->with('error', '답변이 완료된 문의는 수정할 수 없습니다.');
        }

        return view('front.customer.councel.HN_Customer_Councelmodi_001', compact('inquiry', 'member'));
    }

    /**
     * 상담 수정
     */
    public function update(Request $request, Inquiry $inquiry)
    {
        $member = Auth::guard('member')->user();
        if (!$member || $inquiry->username !== $member->username) {
            return abort(403);
        }

        if ($inquiry->status === '답변완료') {
            return back()->with('error', '답변이 완료된 문의는 수정할 수 없습니다.');
        }

        $request->validate([
            'email' => 'required|email',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ], [
            'required' => '입력내용을 확인해주세요.',
        ]);

        $inquiry->update([
            'email' => $request->email,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('front.customer.councel.show', $inquiry->id)->with('success', '수정되었습니다.');
    }

    /**
     * 상담 삭제
     */
    public function destroy(Inquiry $inquiry)
    {
        $member = Auth::guard('member')->user();
        if (!$member || $inquiry->username !== $member->username) {
            return abort(403);
        }

        if ($inquiry->status === '답변완료') {
            return back()->with('error', '답변이 완료된 문의는 삭제할 수 없습니다.');
        }

        $inquiry->delete();

        return redirect()->route('front.customer.councel.index')->with('success', '삭제되었습니다.');
    }
}
