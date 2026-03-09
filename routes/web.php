<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\Memorial\DeadController;
use App\Http\Controllers\Admin\Memorial\LetterController;
use App\Http\Controllers\Admin\Customer\NoticeController;
use App\Http\Controllers\Admin\Customer\InquiryController;
use App\Http\Controllers\Admin\Customer\ReferenceController;
use App\Http\Controllers\Admin\PopupController;
use App\Http\Controllers\Admin\BrochureController;
use App\Http\Controllers\Front\Customer\InquiryController as FrontInquiryController;
use App\Http\Controllers\Front\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.index');
})->name('front.index');

// Frontend Routes
Route::group(['prefix' => 'front'], function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('front.login');
    Route::post('/login', [AuthController::class, 'login'])->name('front.login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('front.logout');
    Route::get('/findid', function () { return view('front.member.login.HN_Login_Idsearch_001'); })->name('front.findid');
    Route::post('/findid', [AuthController::class, 'findId'])->name('front.findid.post');
    Route::get('/findpassword', function () { return view('front.member.login.HN_Login_Pwsearch_001'); })->name('front.findpassword');
    Route::post('/findpassword', [AuthController::class, 'findPassword'])->name('front.findpassword.post');
    Route::get('/join01', function () { return view('front.member.join.HN_Join_001'); })->name('front.join01');
    Route::get('/join02', function () { return view('front.member.join.HN_Join_002'); })->name('front.join02');
    Route::get('/join03', function () { return view('front.member.join.HN_Join_003'); })->name('front.join03');
    Route::post('/check-id', [AuthController::class, 'checkDuplicateId'])->name('front.check_id');
    Route::post('/join02', [AuthController::class, 'register'])->name('front.register.post');
    Route::post('/send-sms', [AuthController::class, 'sendSms'])->name('front.send_sms');
    Route::post('/verify-sms', [AuthController::class, 'verifySms'])->name('front.verify_sms');
    Route::get('/myinfo', [AuthController::class, 'showMyInfo'])->name('front.myinfo');
    Route::get('/myinfo_edit', [AuthController::class, 'showMyInfoEditForm'])->name('front.myinfo_edit');
    Route::post('/myinfo_edit', [AuthController::class, 'updateMyInfo'])->name('front.myinfo_edit.post');
    Route::get('/change_password', function () { return view('front.member.myinfo.HN_MemInfo_Pwmodi_001'); })->name('front.change_password');
    Route::post('/change_password', [AuthController::class, 'changePassword'])->name('front.change_password.post');
    Route::get('/service_terms', function () { return view('front.terms.service_terms'); })->name('front.service_terms');
    Route::get('/personal_terms', function () { return view('front.terms.personal_terms'); })->name('front.personal_terms');

    // Introdu
    Route::group(['prefix' => 'introdu'], function () {
        Route::get('/greeting', function () { return view('front.introdu.HN_Introdu_Greeting_001'); })->name('front.introdu.greeting');
        Route::get('/hnstory', function () { return view('front.introdu.HN_Introdu_Hnstory_001'); })->name('front.introdu.hnstory');
        Route::get('/perarti', function () { return view('front.introdu.HN_Introdu_Perarti_001'); })->name('front.introdu.perarti');
        Route::get('/way', function () { return view('front.introdu.HN_Introdu_Way_001'); })->name('front.introdu.way');
    });

    // Facil
    Route::group(['prefix' => 'facil'], function () {
        Route::get('/bongan', function () { return view('front.facil.HN_Facil_Bongan_001'); })->name('front.facil.bongan');
        Route::get('/naburial', function () { return view('front.facil.HN_Facil_Naburial_001'); })->name('front.facil.naburial');
        Route::get('/aditinal', function () { return view('front.facil.HN_Facil_Aditinal_001'); })->name('front.facil.aditinal');
        Route::get('/surround', function () { return view('front.facil.HN_Facil_Surround_001'); })->name('front.facil.surround');
    });

    // DistriInfo
    Route::group(['prefix' => 'distriinfo'], function () {
        Route::get('/distriproce', function () { return view('front.distriinfo.HN_DistriInfo_Distriproce_001'); })->name('front.distriinfo.distriproce');
        Route::get('/distriprice', function () { return view('front.distriinfo.HN_DistriInfo_Distriprice_001'); })->name('front.distriinfo.distriprice');
        Route::get('/applibenefit', function () { return view('front.distriinfo.HN_DistriInfo_Applibenefit_001'); })->name('front.distriinfo.applibenefit');
    });

    // Memorial
    Route::group(['prefix' => 'memorial'], function () {
        Route::get('/deadsearch', function () { return view('front.memorial.HN_Memorial_Deadsearch_001'); })->name('front.memorial.deadsearch');
        Route::get('/deadresult', function () { return view('front.memorial.HN_Memorial_Deadresult_001'); })->name('front.memorial.deadresult');
        Route::get('/letterlist', function () { return view('front.memorial.letter.HN_Memorial_Letterlist_001'); })->name('front.memorial.letterlist');
        Route::get('/letterview', function () { return view('front.memorial.letter.HN_Memorial_Letterview_001'); })->name('front.memorial.letterview');
        Route::get('/letterregi', function () { return view('front.memorial.letter.HN_Memorial_Letterregi_001'); })->name('front.memorial.letterregi');
        Route::get('/lettermodi', function () { return view('front.memorial.letter.HN_Memorial_Lettermodi_001'); })->name('front.memorial.lettermodi');
    });

    // Customer
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/notice', [App\Http\Controllers\Front\Customer\NoticeController::class, 'index'])->name('front.notice.index');
        Route::get('/notice/{id}', [App\Http\Controllers\Front\Customer\NoticeController::class, 'show'])->name('front.notice.show');
        
        // 1:1 Counsel
        Route::get('/councel', [App\Http\Controllers\Front\Customer\InquiryController::class, 'index'])->name('front.customer.councel.index');
        Route::get('/councel/create', [App\Http\Controllers\Front\Customer\InquiryController::class, 'create'])->name('front.customer.councel.create');
        Route::post('/councel', [App\Http\Controllers\Front\Customer\InquiryController::class, 'store'])->name('front.customer.councel.store');
        Route::get('/councel/{inquiry}', [App\Http\Controllers\Front\Customer\InquiryController::class, 'show'])->name('front.customer.councel.show');
        Route::get('/councel/{inquiry}/edit', [App\Http\Controllers\Front\Customer\InquiryController::class, 'edit'])->name('front.customer.councel.edit');
        Route::put('/councel/{inquiry}', [App\Http\Controllers\Front\Customer\InquiryController::class, 'update'])->name('front.customer.councel.update');
        Route::delete('/councel/{inquiry}', [App\Http\Controllers\Front\Customer\InquiryController::class, 'destroy'])->name('front.customer.councel.destroy');

        Route::get('/referen', [App\Http\Controllers\Front\Customer\ReferenceController::class, 'index'])->name('front.customer.referen.index');
        Route::get('/referen/{id}', [App\Http\Controllers\Front\Customer\ReferenceController::class, 'show'])->name('front.customer.referen.show');
        Route::get('/sangjang', function () { return view('front.customer.sangjang'); })->name('front.customer.sangjang');
        
        Route::get('/faq', function () { return view('front.customer.HN_Customer_Faq_001'); })->name('front.customer.faq');
    });
});

// Admin Routes
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        if (auth()->guard('admin')->check()) {
            return redirect()->route('HNA_Admag_list_001');
        }
        return redirect()->route('HNA_Login_001');
    });

    // --- 로그인 및 정보 찾기 ---
    Route::get('/HNA_Login_001', [AdminController::class, 'loginForm'])->name('HNA_Login_001');
    Route::post('/HNA_Login_001', [AdminController::class, 'login'])->name('admin.login');

    Route::get('/HNA_FindId_001', [AdminController::class, 'findIdForm'])->name('HNA_FindId_001');
    Route::get('/HNA_FindPw_001', [AdminController::class, 'findPwForm'])->name('HNA_FindPw_001');

    Route::post('/find-id', [AdminController::class, 'findId'])->name('admin.findId');
    Route::post('/find-pw', [AdminController::class, 'findPw'])->name('admin.findPw');

    // --- 관리자 기능 (auth:admin) ---
    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::get('/HNA_Admag_list_001', [AdminController::class, 'index'])->name('HNA_Admag_list_001');
        Route::post('/HNA_Admag_list_001/mass-destroy', [AdminController::class, 'massDestroy'])->name('admin.admag.massDestroy');
        Route::get('/HNA_Admag_Regi_001', [AdminController::class, 'create'])->name('HNA_Admag_Regi_001');
        Route::post('/HNA_Admag_Regi_001', [AdminController::class, 'store'])->name('admin.admag.store');
        Route::get('/HNA_Admag_view_001/{admin}', [AdminController::class, 'show'])->name('HNA_Admag_view_001');
        Route::get('/HNA_Admag_Modi_001/{admin}', [AdminController::class, 'edit'])->name('HNA_Admag_Modi_001');
        Route::put('/HNA_Admag_Modi_001/{admin}', [AdminController::class, 'update'])->name('admin.admag.update');
        Route::delete('/HNA_Admag_list_001/{admin}', [AdminController::class, 'destroy'])->name('admin.admag.destroy');

        // --- 회원관리 (HNA_Memmag) ---
        Route::group(['prefix' => 'HNA_Memmag'], function() {
            Route::get('/List_001', [MemberController::class, 'index'])->name('HNA_Memmag_List_001');
            Route::post('/mass-destroy', [MemberController::class, 'massDestroy'])->name('admin.memmag.massDestroy');
            Route::get('/Regi_001', [MemberController::class, 'create'])->name('HNA_Memmag_Regi_001');
            Route::post('/Regi_001', [MemberController::class, 'store'])->name('admin.memmag.store');
            Route::get('/View_001/{member}', [MemberController::class, 'show'])->name('HNA_Memmag_View_001');
            Route::get('/Modi_001/{member}', [MemberController::class, 'edit'])->name('HNA_Memmag_Modi_001');
            Route::put('/Modi_001/{member}', [MemberController::class, 'update'])->name('admin.memmag.update');
            Route::delete('/View_001/{member}', [MemberController::class, 'destroy'])->name('admin.memmag.destroy');
        });
    });

    // 기존 개별 라우트들 중복 제거 또는 주석 처리
    // Route::view('/HNA_Login_001', 'admin.login.HNA_Login_001')->name('HNA_Login_001');
        // --- 고인 관리 (HNA_Deadmag) ---
        Route::group(['prefix' => 'HNA_Deadmag'], function() {
            Route::get('/List_001', [DeadController::class, 'index'])->name('HNA_Deadmag_List_001');
            Route::post('/mass-destroy', [DeadController::class, 'massDestroy'])->name('admin.deadmag.massDestroy');
            Route::get('/Regi_001', [DeadController::class, 'create'])->name('HNA_Deadmag_Regi_001');
            Route::post('/Regi_001', [DeadController::class, 'store'])->name('admin.deadmag.store');
            Route::get('/View_001/{dead}', [DeadController::class, 'show'])->name('HNA_Deadmag_View_001');
            Route::get('/Modi_001/{dead}', [DeadController::class, 'edit'])->name('HNA_Deadmag_Modi_001');
            Route::put('/Modi_001/{dead}', [DeadController::class, 'update'])->name('admin.deadmag.update');
            Route::delete('/View_001/{dead}', [DeadController::class, 'destroy'])->name('admin.deadmag.destroy');
        });

        // --- 하늘 편지 관리 (HNA_Lettermag) ---
        Route::group(['prefix' => 'HNA_Lettermag'], function() {
            Route::get('/List_001', [LetterController::class, 'index'])->name('HNA_Lettermag_List_001');
            Route::post('/mass-destroy', [LetterController::class, 'massDestroy'])->name('admin.lettermag.massDestroy');
            Route::get('/View_001/{letter}', [LetterController::class, 'show'])->name('HNA_Lettermag_View_001');
            Route::delete('/View_001/{letter}', [LetterController::class, 'destroy'])->name('admin.lettermag.destroy');
        });

        // --- 공지사항 관리 (HNA_Customer_Notice) ---
        Route::group(['prefix' => 'HNA_Customer_Notice'], function() {
            Route::get('/Noticelist_001', [NoticeController::class, 'index'])->name('HNA_Customer_Noticelist_001');
            Route::post('/mass-destroy', [NoticeController::class, 'massDestroy'])->name('admin.notice.massDestroy');
            Route::get('/Noticeregi_001', [NoticeController::class, 'create'])->name('HNA_Customer_Noticeregi_001');
            Route::post('/store', [NoticeController::class, 'store'])->name('admin.notice.store');
            Route::get('/Noticeview_001/{notice}', [NoticeController::class, 'show'])->name('HNA_Customer_Noticeview_001');
            Route::get('/Noticemodi_001/{notice}', [NoticeController::class, 'edit'])->name('HNA_Customer_Noticemodi_001');
            Route::put('/update/{notice}', [NoticeController::class, 'update'])->name('admin.notice.update');
            Route::delete('/destroy/{notice}', [NoticeController::class, 'destroy'])->name('admin.notice.destroy');
            Route::get('/download/{attachment}', [NoticeController::class, 'downloadAttachment'])->name('admin.notice.download');
        });

        // --- 1:1 상담 관리 (HNA_Customer_Councel) ---
        Route::group(['prefix' => 'HNA_Customer_Councel'], function() {
            Route::get('/Councellist_001', [InquiryController::class, 'index'])->name('HNA_Customer_Councellist_001');
            Route::get('/Councelview_001/{inquiry}', [InquiryController::class, 'show'])->name('HNA_Customer_Councelview_001');
            Route::delete('/destroy/{inquiry}', [InquiryController::class, 'destroy'])->name('admin.inquiry.destroy');
            Route::get('/Replyrigo_001/{inquiry}', [InquiryController::class, 'createReply'])->name('HNA_Customer_Replyrigo_001');
            Route::post('/Replystore/{inquiry}', [InquiryController::class, 'storeReply'])->name('admin.inquiry.reply.store');
            Route::get('/Replymodi_001/{inquiry}', [InquiryController::class, 'editReply'])->name('HNA_Customer_Replymodi_001');
            Route::put('/Replyupdate/{inquiry}', [InquiryController::class, 'updateReply'])->name('admin.inquiry.reply.update');
            Route::get('/download/{attachment}', [InquiryController::class, 'downloadAttachment'])->name('admin.inquiry.download');
        });

        // --- 자료실 (HNA_Customer_Referen) ---
        Route::group(['prefix' => 'HNA_Customer_Referen'], function() {
            Route::get('/Referenlist_001', [ReferenceController::class, 'index'])->name('HNA_Customer_Referenlist_001');
            Route::get('/Referenrigo_001', [ReferenceController::class, 'create'])->name('HNA_Customer_Referenrigo_001');
            Route::post('/store', [ReferenceController::class, 'store'])->name('admin.reference.store');
            Route::get('/Referenview_001/{reference}', [ReferenceController::class, 'show'])->name('HNA_Customer_Referenview_001');
            Route::get('/Referenmodi_001/{reference}', [ReferenceController::class, 'edit'])->name('HNA_Customer_Referenmodi_001');
            Route::put('/update/{reference}', [ReferenceController::class, 'update'])->name('admin.reference.update');
            Route::delete('/destroy/{reference}', [ReferenceController::class, 'destroy'])->name('admin.reference.destroy');
            Route::get('/download/{attachment}', [ReferenceController::class, 'downloadAttachment'])->name('admin.reference.download');
        });
        // --- 팝업 관리 (HNA_Popup) ---
        Route::group(['prefix' => 'HNA_Popup'], function() {
            Route::get('/Popup_List_001', [PopupController::class, 'index'])->name('HNA_Popup_List_001');
            Route::get('/Popup_Regi_001', [PopupController::class, 'create'])->name('HNA_Popup_Regi_001');
            Route::post('/store', [PopupController::class, 'store'])->name('admin.popup.store');
            Route::get('/Popup_Detail_001/{popup}', [PopupController::class, 'show'])->name('HNA_Popup_Detail_001');
            Route::get('/Popup_Modi_001/{popup}', [PopupController::class, 'edit'])->name('HNA_Popup_Modi_001');
            Route::put('/update/{popup}', [PopupController::class, 'update'])->name('admin.popup.update');
            Route::delete('/destroy/{popup}', [PopupController::class, 'destroy'])->name('admin.popup.destroy');
            Route::post('/preview', [PopupController::class, 'preview'])->name('admin.popup.preview');
        });
        // --- 브로슈어 신청 관리 (HNA_Brochure) ---
        Route::group(['prefix' => 'HNA_Brochure'], function() {
            Route::get('/Applicationlist_001', [BrochureController::class, 'index'])->name('HNA_Brochure_Applicationlist_001');
            Route::post('/send', [BrochureController::class, 'send'])->name('admin.brochure.send');
        });
});
