<?php

namespace App\Http\Controllers\Admin\Memorial;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    public function index(Request $request)
    {
        $searchType = $request->input('search_type');
        $searchKeyword = $request->input('search_keyword');

        $query = Letter::query();

        if ($searchType && $searchKeyword) {
            if ($searchType === 'username') {
                $query->where('username', 'like', "%{$searchKeyword}%");
            } elseif ($searchType === 'content') {
                $query->where('content', 'like', "%{$searchKeyword}%");
            } elseif ($searchType === 'author') {
                $query->where('author_description', 'like', "%{$searchKeyword}%");
            }
        }

        $totalCount = $query->count();
        $letters = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.memorial.lettermag.HNA_Lettermag_List_001', compact('letters', 'totalCount', 'searchType', 'searchKeyword'));
    }

    public function show(Letter $letter)
    {
        return view('admin.memorial.lettermag.HNA_Lettermag_View_001', compact('letter'));
    }

    public function destroy(Letter $letter)
    {
        $letter->delete();
        return redirect()->route('HNA_Lettermag_List_001')->with('success', '삭제되었습니다.');
    }

    public function massDestroy(Request $request)
    {
        $ids = $request->input('ids');
        if (!empty($ids)) {
            Letter::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }
}
