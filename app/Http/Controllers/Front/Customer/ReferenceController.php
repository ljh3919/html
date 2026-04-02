<?php

namespace App\Http\Controllers\Front\Customer;

use App\Http\Controllers\Controller;
use App\Models\ReferenceRoom;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    /**
     * 자료실 목록
     */
    public function index(Request $request)
    {
        $searchKeyword = $request->input('search_keyword');
        $query = ReferenceRoom::with('attachments');

        if ($searchKeyword) {
            $query->where(function($q) use ($searchKeyword) {
                $q->where('title', 'like', "%{$searchKeyword}%")
                  ->orWhere('content', 'like', "%{$searchKeyword}%");
            });
        }

        $references = $query->orderBy('created_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('front.customer.referen.partials.list', compact('references'))->render();
        }

        return view('front.customer.referen.HN_Customer_Referenlist_001', compact('references', 'searchKeyword'));
    }

    /**
     * 자료실 상세
     */
    public function show($id)
    {
        $reference = ReferenceRoom::with('attachments')->findOrFail($id);
        return view('front.customer.referen.HN_Customer_Referenview_001', compact('reference'));
    }
}
