<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Popup;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PopupController extends Controller
{
    public function index(Request $request)
    {
        $searchType = $request->input('search_type', 'title');
        $searchKeyword = $request->input('search_keyword');

        $query = Popup::query();

        if ($searchKeyword) {
            if ($searchType == 'title') {
                $query->where('title', 'like', '%' . $searchKeyword . '%');
            } elseif ($searchType == 'content') {
                $query->where('content', 'like', '%' . $searchKeyword . '%');
            }
        }

        $totalCount = $query->count();
        $popups = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.popup.HNA_Popup_List_001', compact('popups', 'totalCount', 'searchType', 'searchKeyword'));
    }

    public function create()
    {
        return view('admin.popup.HNA_Popup_Regi_001');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'start_date' => 'required|date',
            'start_hour' => 'required|integer|between:0,23',
            'end_date' => 'required|date',
            'end_hour' => 'required|integer|between:0,23',
        ]);

        $startAt = Carbon::parse($validated['start_date'])->setHour((int)$validated['start_hour'])->setMinute(0)->setSecond(0);
        $endAt = Carbon::parse($validated['end_date'])->setHour((int)$validated['end_hour'])->setMinute(0)->setSecond(0);

        Popup::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'start_at' => $startAt,
            'end_at' => $endAt,
            'is_visible' => $request->has('is_visible'),
        ]);

        return redirect()->route('HNA_Popup_List_001')->with('success', '팝업이 등록되었습니다.');
    }

    public function show(Popup $popup)
    {
        return view('admin.popup.HNA_Popup_Detail_001', compact('popup'));
    }

    public function edit(Popup $popup)
    {
        return view('admin.popup.HNA_Popup_Modi_001', compact('popup'));
    }

    public function update(Request $request, Popup $popup)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'start_date' => 'required|date',
            'start_hour' => 'required|integer|between:0,23',
            'end_date' => 'required|date',
            'end_hour' => 'required|integer|between:0,23',
        ]);

        $startAt = Carbon::parse($validated['start_date'])->setHour((int)$validated['start_hour'])->setMinute(0)->setSecond(0);
        $endAt = Carbon::parse($validated['end_date'])->setHour((int)$validated['end_hour'])->setMinute(0)->setSecond(0);

        $popup->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'start_at' => $startAt,
            'end_at' => $endAt,
            'is_visible' => $request->has('is_visible'),
        ]);

        return redirect()->route('HNA_Popup_List_001')->with('success', '팝업이 수정되었습니다.');
    }

    public function destroy(Popup $popup)
    {
        $popup->delete();
        return redirect()->route('HNA_Popup_List_001')->with('success', '팝업이 삭제되었습니다.');
    }

    public function preview(Request $request)
    {
        $title = $request->input('title', '제목 미리보기');
        $content = $request->input('content', '내용 미리보기');

        return view('admin.popup.HNA_Popup_Preview_001', compact('title', 'content'));
    }
}
