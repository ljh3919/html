<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Models\ReferenceRoom;
use App\Models\ReferenceAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ReferenceController extends Controller
{
    public function index(Request $request)
    {
        $searchType = $request->input('search_type');
        $searchKeyword = $request->input('search_keyword');

        $query = ReferenceRoom::with('author', 'attachments');

        if ($searchType && $searchKeyword) {
            if ($searchType === 'title_content') {
                $query->where(function($q) use ($searchKeyword) {
                    $q->where('title', 'like', "%{$searchKeyword}%")
                      ->orWhere('content', 'like', "%{$searchKeyword}%");
                });
            } elseif ($searchType === 'author') {
                $query->whereHas('author', function($q) use ($searchKeyword) {
                    $q->where('name', 'like', "%{$searchKeyword}%");
                });
            }
        }

        $totalCount = $query->count();
        $references = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.customer.reference.HNA_Customer_Referenlist_001', compact('references', 'totalCount', 'searchType', 'searchKeyword'));
    }

    public function create()
    {
        return view('admin.customer.reference.HNA_Customer_Referenrigo_001');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'attachments.*' => 'nullable|file|max:10240',
        ], [
            'title.required' => '입력항목을 확인후 입력해 주세요',
            'content.required' => '입력항목을 확인후 입력해 주세요',
        ]);

        DB::beginTransaction();
        try {
            $reference = ReferenceRoom::create([
                'title' => $request->title,
                'content' => $request->content,
                'author_id' => auth('admin')->id(),
            ]);

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $storedPath = $file->store('public/uploads/references');
                    $reference->attachments()->create([
                        'original_name' => $file->getClientOriginalName(),
                        'stored_name' => basename($storedPath),
                        'file_path' => $storedPath,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('HNA_Customer_Referenlist_001')->with('success', '등록되었습니다.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => '등록 중 오류가 발생했습니다.'])->withInput();
        }
    }

    public function show(ReferenceRoom $reference)
    {
        return view('admin.customer.reference.HNA_Customer_Referenview_001', compact('reference'));
    }

    public function edit(ReferenceRoom $reference)
    {
        return view('admin.customer.reference.HNA_Customer_Referenmodi_001', compact('reference'));
    }

    public function update(Request $request, ReferenceRoom $reference)
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
            $reference->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);

            if ($request->has('delete_attachments')) {
                foreach ($request->delete_attachments as $attachmentId) {
                    $attachment = ReferenceAttachment::find($attachmentId);
                    if ($attachment) {
                        Storage::delete($attachment->file_path);
                        $attachment->delete();
                    }
                }
            }

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $storedPath = $file->store('public/uploads/references');
                    $reference->attachments()->create([
                        'original_name' => $file->getClientOriginalName(),
                        'stored_name' => basename($storedPath),
                        'file_path' => $storedPath,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('HNA_Customer_Referenview_001', $reference->id)->with('success', '수정되었습니다.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => '수정 중 오류가 발생했습니다.'])->withInput();
        }
    }

    public function destroy(ReferenceRoom $reference)
    {
        foreach ($reference->attachments as $attachment) {
            Storage::delete($attachment->file_path);
        }
        $reference->delete();
        return redirect()->route('HNA_Customer_Referenlist_001')->with('success', '삭제되었습니다.');
    }

    public function downloadAttachment(ReferenceAttachment $attachment)
    {
        return Storage::download($attachment->file_path, $attachment->original_name);
    }
}
