<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\InquiryReply;
use App\Models\InquiryAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $searchType = $request->input('search_type');
        $searchKeyword = $request->input('search_keyword');

        $query = Inquiry::with('reply.admin');

        if ($searchType && $searchKeyword) {
            if ($searchType === 'title_content') {
                $query->where(function($q) use ($searchKeyword) {
                    $q->where('title', 'like', "%{$searchKeyword}%")
                      ->orWhere('content', 'like', "%{$searchKeyword}%");
                });
            } elseif ($searchType === 'author') {
                $query->where('username', 'like', "%{$searchKeyword}%");
            }
        }

        $totalCount = $query->count();
        $inquiries = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.customer.councel.HNA_Customer_Councellist_001', compact('inquiries', 'totalCount', 'searchType', 'searchKeyword'));
    }

    public function show(Inquiry $inquiry)
    {
        $inquiry->load('reply.attachments', 'reply.admin');
        return view('admin.customer.councel.HNA_Customer_Councelview_001', compact('inquiry'));
    }

    public function createReply(Inquiry $inquiry)
    {
        return view('admin.customer.councel.HNA_Customer_Replyrigo_001', compact('inquiry'));
    }

    public function storeReply(Request $request, Inquiry $inquiry)
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
            $reply = InquiryReply::create([
                'inquiry_id' => $inquiry->id,
                'admin_id' => auth('admin')->id(),
                'title' => $request->title,
                'content' => $request->content,
            ]);

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $storedPath = $file->store('public/uploads/inquiry_replies');
                    $reply->attachments()->create([
                        'original_name' => $file->getClientOriginalName(),
                        'stored_name' => basename($storedPath),
                        'file_path' => $storedPath,
                    ]);
                }
            }

            $inquiry->update(['status' => '답변완료']);

            DB::commit();
            return redirect()->route('HNA_Customer_Councelview_001', $inquiry->id)->with('success', '답변이 등록되었습니다.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => '답변 등록 중 오류가 발생했습니다.'])->withInput();
        }
    }

    public function editReply(Inquiry $inquiry)
    {
        $inquiry->load('reply.attachments');
        return view('admin.customer.councel.HNA_Customer_Replymodi_001', compact('inquiry'));
    }

    public function updateReply(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'attachments.*' => 'nullable|file|max:10240',
        ], [
            'title.required' => '입력항목을 다시 확인해주시기 바랍니다.',
            'content.required' => '입력항목을 다시 확인해주시기 바랍니다.',
        ]);

        $reply = $inquiry->reply;

        DB::beginTransaction();
        try {
            $reply->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);

            if ($request->has('delete_attachments')) {
                foreach ($request->delete_attachments as $attachmentId) {
                    $attachment = InquiryAttachment::find($attachmentId);
                    if ($attachment) {
                        Storage::delete($attachment->file_path);
                        $attachment->delete();
                    }
                }
            }

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $storedPath = $file->store('public/uploads/inquiry_replies');
                    $reply->attachments()->create([
                        'original_name' => $file->getClientOriginalName(),
                        'stored_name' => basename($storedPath),
                        'file_path' => $storedPath,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('HNA_Customer_Councelview_001', $inquiry->id)->with('success', '답변이 수정되었습니다.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => '답변 수정 중 오류가 발생했습니다.'])->withInput();
        }
    }

    public function destroy(Inquiry $inquiry)
    {
        if ($inquiry->reply) {
            foreach ($inquiry->reply->attachments as $attachment) {
                Storage::delete($attachment->file_path);
            }
        }
        $inquiry->delete();
        return redirect()->route('HNA_Customer_Councellist_001')->with('success', '삭제되었습니다.');
    }

    public function downloadAttachment(InquiryAttachment $attachment)
    {
        return Storage::download($attachment->file_path, $attachment->original_name);
    }
}
