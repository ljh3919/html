<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\NoticeAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class NoticeController extends Controller
{
    public function index(Request $request)
    {
        $searchType = $request->input('search_type');
        $searchKeyword = $request->input('search_keyword');

        $query = Notice::with('author', 'attachments');

        if ($searchType && $searchKeyword) {
            if ($searchType === 'all') {
                $query->where(function($q) use ($searchKeyword) {
                    $q->where('title', 'like', "%{$searchKeyword}%")
                      ->orWhere('content', 'like', "%{$searchKeyword}%");
                });
            } elseif ($searchType === 'title') {
                $query->where('title', 'like', "%{$searchKeyword}%");
            } elseif ($searchType === 'content') {
                $query->where('content', 'like', "%{$searchKeyword}%");
            }
        }

        $totalCount = $query->count();
        $notices = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.customer.notice.HNA_Customer_Noticelist_001', compact('notices', 'totalCount', 'searchType', 'searchKeyword'));
    }

    public function create()
    {
        return view('admin.customer.notice.HNA_Customer_Noticeregi_001');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'attachments.*' => 'nullable|file|max:10240', // 10MB limit
        ], [
            'title.required' => '입력항목을 다시 확인해주시기 바랍니다.',
            'content.required' => '입력항목을 다시 확인해주시기 바랍니다.',
        ]);

        DB::beginTransaction();
        try {
            $notice = Notice::create([
                'title' => $request->title,
                'content' => $request->content,
                'author_id' => auth('admin')->id(),
            ]);

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $storedPath = $file->store('public/uploads/notices');
                    $notice->attachments()->create([
                        'original_name' => $file->getClientOriginalName(),
                        'stored_name' => basename($storedPath),
                        'file_path' => $storedPath,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('HNA_Customer_Noticelist_001')->with('success', '등록되었습니다.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => '등록 중 오류가 발생했습니다.'])->withInput();
        }
    }

    public function show(Notice $notice)
    {
        $notice->increment('view_count');
        return view('admin.customer.notice.HNA_Customer_Noticeview_001', compact('notice'));
    }

    public function edit(Notice $notice)
    {
        return view('admin.customer.notice.HNA_Customer_Noticemodi_001', compact('notice'));
    }

    public function update(Request $request, Notice $notice)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'attachments.*' => 'nullable|file|max:10240',
        ], [
            'title.required' => '입력항목을 다시 확인해주시기 바랍니다.',
            'content.required' => '입력항목을 다시 확인해주시기 바랍니다.',
        ]);

        DB::beginTransaction();
        try {
            $notice->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);

            // 기존 파일 삭제 처리 (만약 요청에 포함되어 있다면)
            if ($request->has('delete_attachments')) {
                foreach ($request->delete_attachments as $attachmentId) {
                    $attachment = NoticeAttachment::find($attachmentId);
                    if ($attachment) {
                        Storage::delete($attachment->file_path);
                        $attachment->delete();
                    }
                }
            }

            // 신규 파일 업로드 (최대 3개 제한은 클라이언트/서버에서 체크)
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $storedPath = $file->store('public/uploads/notices');
                    $notice->attachments()->create([
                        'original_name' => $file->getClientOriginalName(),
                        'stored_name' => basename($storedPath),
                        'file_path' => $storedPath,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('HNA_Customer_Noticeview_001', $notice->id)->with('success', '수정되었습니다.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => '수정 중 오류가 발생했습니다.'])->withInput();
        }
    }

    public function destroy(Notice $notice)
    {
        foreach ($notice->attachments as $attachment) {
            Storage::delete($attachment->file_path);
        }
        $notice->delete();
        return redirect()->route('HNA_Customer_Noticelist_001')->with('success', '삭제되었습니다.');
    }

    public function massDestroy(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            $notices = Notice::whereIn('id', $ids)->get();
            foreach ($notices as $notice) {
                foreach ($notice->attachments as $attachment) {
                    Storage::delete($attachment->file_path);
                }
                $notice->delete();
            }
        }
        return response()->json(['success' => true]);
    }

    public function downloadAttachment(NoticeAttachment $attachment)
    {
        return Storage::download($attachment->file_path, $attachment->original_name);
    }
}
