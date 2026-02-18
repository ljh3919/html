<?php

namespace App\Http\Controllers\Admin\Memorial;

use App\Http\Controllers\Controller;
use App\Models\Dead;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DeadController extends Controller
{
    public function index(Request $request)
    {
        $searchType = $request->input('search_type');
        $searchKeyword = $request->input('search_keyword');

        $query = Dead::query();

        if ($searchType && $searchKeyword) {
            if ($searchType === 'name') {
                $query->where('name', 'like', "%{$searchKeyword}%");
            } elseif ($searchType === 'dead_code') {
                $query->where('dead_code', 'like', "%{$searchKeyword}%");
            }
        }

        $totalCount = $query->count();
        $deads = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.memorial.deadmag.HNA_Deadmag_List_001', compact('deads', 'totalCount', 'searchType', 'searchKeyword'));
    }

    public function create()
    {
        return view('admin.memorial.deadmag.HNA_Deadmag_Regi_001');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:하늘누리관,자연장',
            'death_date' => 'required|date',
            'location_row' => 'required|string',
            'location_num' => 'required|string',
        ], [
            'required' => '입력항목을 확인 후 등록을 해주시기 바랍니다.',
        ]);

        // 고인 코드 생성 로직
        $categoryCode = ($request->category === '하늘누리관') ? '01' : '02';
        $today = Carbon::now();
        $datePrefix = $today->format('ymd'); // YYMMDD
        
        $codePrefix = 'D' . $categoryCode . $datePrefix;
        
        // 해당 접두사로 시작하는 오늘의 마지막 일련번호 찾기
        $lastDead = Dead::where('dead_code', 'like', $codePrefix . '%')
                        ->orderBy('dead_code', 'desc')
                        ->first();
        
        $serial = 1;
        if ($lastDead) {
            $lastSerial = intval(substr($lastDead->dead_code, -2));
            $serial = $lastSerial + 1;
        }
        
        $deadCode = $codePrefix . str_pad($serial, 2, '0', STR_PAD_LEFT);

        Dead::create([
            'dead_code' => $deadCode,
            'name' => $request->name,
            'category' => $request->category,
            'location_hall' => $request->location_hall,
            'location_area' => $request->location_area,
            'location_row' => $request->location_row,
            'location_num' => $request->location_num,
            'death_date' => $request->death_date,
            'burial_date' => $today->format('Y-m-d'),
        ]);

        return redirect()->route('HNA_Deadmag_List_001')->with('success', '등록되었습니다.');
    }

    public function show(Dead $dead)
    {
        return view('admin.memorial.deadmag.HNA_Deadmag_View_001', compact('dead'));
    }

    public function edit(Dead $dead)
    {
        return view('admin.memorial.deadmag.HNA_Deadmag_Modi_001', compact('dead'));
    }

    public function update(Request $request, Dead $dead)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:하늘누리관,자연장',
            'death_date' => 'required|date',
            'location_row' => 'required|string',
            'location_num' => 'required|string',
        ], [
            'required' => '입력항목을 확인 후 등록을 해주시기 바랍니다.',
        ]);

        $dead->update([
            'name' => $request->name,
            'category' => $request->category,
            'location_hall' => $request->location_hall,
            'location_area' => $request->location_area,
            'location_row' => $request->location_row,
            'location_num' => $request->location_num,
            'death_date' => $request->death_date,
        ]);

        return redirect()->route('HNA_Deadmag_View_001', $dead->id)->with('success', '수정되었습니다.');
    }

    public function destroy(Dead $dead)
    {
        $dead->delete();
        return redirect()->route('HNA_Deadmag_List_001')->with('success', '삭제되었습니다.');
    }

    public function massDestroy(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            Dead::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }
}
