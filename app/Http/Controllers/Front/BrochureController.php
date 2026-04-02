<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BrochureApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrochureController extends Controller
{
    /**
     * 브로슈어 신청 페이지 표시
     */
    public function index()
    {
        if (!Auth::guard('member')->check()) {
            return redirect()->route('front.login');
        }
        return view('front.customer.HN_Brochure_Application_001');
    }

    /**
     * 브로슈어 신청 데이터 저장
     */
    public function store(Request $request)
    {
        $member = Auth::guard('member')->user();
        if (!$member) {
            return redirect()->route('front.login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        BrochureApplication::create([
            'member_id' => $member->username,
            'name' => $request->name,
            'email' => $request->email,
            'status' => '미발송',
        ]);

        return response()->json([
            'success' => true,
            'message' => '브로슈어 신청이 접수되었습니다.'
        ]);
    }
}
