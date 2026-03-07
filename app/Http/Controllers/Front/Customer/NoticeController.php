<?php

namespace App\Http\Controllers\Front\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;

class NoticeController extends Controller
{
    /**
     * Display a listing of the notices.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Notice::orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
        }

        $notices = $query->paginate(10);
        
        if ($request->ajax()) {
            return view('front.customer.notice.partials.list', compact('notices'))->render();
        }

        return view('front.customer.notice.HN_Customer_Noticelist_001', compact('notices'));
    }

    /**
     * Display the specified notice.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // 공지사항 조회 + 첨부파일(관계가 있을 경우) 로드
        // 첨부파일 관계명은 모델 설정에 따라 달라질 수 있으므로 기본 모델만 우선 조회
        $notice = Notice::findOrFail($id);

        // 조회수 증가 기능
        $notice->increment('view_count');

        return view('front.customer.notice.HN_Customer_Noticeview_001', compact('notice'));
    }
}
