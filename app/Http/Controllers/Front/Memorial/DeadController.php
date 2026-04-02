<?php

namespace App\Http\Controllers\Front\Memorial;

use App\Http\Controllers\Controller;
use App\Models\Dead;
use Illuminate\Http\Request;

class DeadController extends Controller
{
    /**
     * 고인검색 페이지 노출
     */
    public function index()
    {
        return view('front.memorial.HN_Memorial_Deadsearch_001');
    }

    /**
     * 고인검색 결과 페이지 노출
     */
    public function search(Request $request)
    {
        $name = $request->input('name');

        $query = Dead::query();

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        $deads = $query->orderBy('death_date', 'desc')->paginate(10);

        return view('front.memorial.HN_Memorial_Deadresult_001', compact('deads', 'name'));
    }
}
