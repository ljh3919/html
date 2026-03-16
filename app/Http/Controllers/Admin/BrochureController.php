<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrochureApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BrochureMail;
use Carbon\Carbon;

class BrochureController extends Controller
{
    public function index(Request $request)
    {
        $searchType = $request->input('search_type', 'member_id'); // ID or Name
        $searchKeyword = $request->input('search_keyword');
        $statusFilter = $request->input('status_filter', '전체'); // 전체, 발송완료, 미발송

        $query = BrochureApplication::query();

        if ($searchKeyword) {
            if ($searchType == 'member_id') {
                $query->where('member_id', 'like', '%' . $searchKeyword . '%');
            } elseif ($searchType == 'name') {
                $query->where('name', 'like', '%' . $searchKeyword . '%');
            }
        }

        if ($statusFilter && $statusFilter !== '전체') {
            $query->where('status', $statusFilter);
        }

        $totalCount = $query->count();
        $applications = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.brochure.HNA_Brochure_Applicationlist_001', compact('applications', 'totalCount', 'searchType', 'searchKeyword', 'statusFilter'));
    }

    public function send(Request $request)
    {
        $ids = $request->input('ids');
        
        if (!$ids) {
            return back()->with('error', '선택된 항목이 없습니다.');
        }

        if (!is_array($ids)) {
            $ids = [$ids];
        }

        $applications = BrochureApplication::whereIn('id', $ids)->get();

        foreach ($applications as $application) {
            // 실제 이메일 발송
            try {
                Mail::to($application->email)->send(new BrochureMail($application->name));
                
                $application->update([
                    'status' => '발송완료',
                    'sent_at' => now(),
                ]);
            } catch (\Exception $e) {
                \Log::error('Brochure Mail sending failed for ID ' . $application->id . ': ' . $e->getMessage());
                // 개별 발송 실패 시 로그만 남기고 계속 진행하거나 처리 방식 결정 (여기서는 로그 남김)
            }
        }

        return back()->with('success', '브로슈어가 발송되었습니다.');
    }
}
