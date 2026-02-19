<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>퍼블리싱 페이지 목록 - 하늘누리</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; color: #333; }
        .section-title { border-bottom: 2px solid #5d401a; color: #5d401a; padding-bottom: 10px; margin-top: 40px; margin-bottom: 20px; font-weight: bold; }
        .list-group-item { transition: 0.2s; display: flex; justify-content: space-between; align-items: center; }
        .list-group-item:hover { background-color: #f1f1f1; padding-left: 25px; }
        .badge-custom { background-color: #5d401a; color: #fff; }
        a { text-decoration: none !important; color: inherit; display: block; width: 100%; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="font-weight-bold">하늘누리 퍼블리싱 목록</h2>
            <span class="text-muted">Last Updated: {{ date('Y-m-d H:i') }}</span>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h4 class="section-title">FRONT (사용자)</h4>
                <div class="list-group shadow-sm">
                    <a href="/front/HN_Main_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>메인 페이지</span> <span class="badge badge-light">Main</span>
                    </a>
                    <a href="/front/HN_Login_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>로그인</span> <span class="badge badge-light">Member</span>
                    </a>
                    <a href="/front/HN_Join_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>회원가입 (약관)</span> <span class="badge badge-light">Member</span>
                    </a>
                    <a href="/front/HN_Join_002" target="_blank" class="list-group-item list-group-item-action">
                        <span>회원가입 (입력)</span> <span class="badge badge-light">Member</span>
                    </a>
                    <a href="/front/HN_Introdu_Greeting_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>인사말</span> <span class="badge badge-light">Intro</span>
                    </a>
                    <a href="/front/HN_Facil_Bongan_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>시설안내 (봉안담)</span> <span class="badge badge-light">Facility</span>
                    </a>
                    <a href="/front/HN_DistriInfo_Distriproce_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>분양안내 (절차)</span> <span class="badge badge-light">Info</span>
                    </a>
                    <a href="/front/HN_Memorial_Deadsearch_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>사이버추모관 (검색)</span> <span class="badge badge-light">Memorial</span>
                    </a>
                     <a href="/front/HN_Customer_Noticelist_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>고객센터 (공지사항)</span> <span class="badge badge-light">CS</span>
                    </a>
                </div>
            </div>

            <div class="col-md-6">
                <h4 class="section-title">ADMIN (관리자)</h4>
                <div class="alert alert-warning">
                    <small>* 관리자 페이지는 로그인이 필요할 수 있습니다.</small><br>
                    <strong>ID:</strong> haneulnuri / <strong>PW:</strong> 1234
                </div>
                <div class="list-group shadow-sm">
                    <a href="/admin/HNA_Login_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>관리자 로그인</span> <span class="badge badge-custom">Auth</span>
                    </a>
                    <a href="/admin/HNA_Admag_list_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>관리자 관리 (목록)</span> <span class="badge badge-custom">Admin</span>
                    </a>
                    <a href="/admin/HNA_Memmag/List_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>회원 관리 (목록)</span> <span class="badge badge-custom">Member</span>
                    </a>
                    <a href="/admin/HNA_Deadmag/List_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>고인 관리 (목록)</span> <span class="badge badge-custom">Dead</span>
                    </a>
                    <a href="/admin/HNA_Lettermag/List_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>하늘편지 관리 (목록)</span> <span class="badge badge-custom">Letter</span>
                    </a>
                    <a href="/admin/HNA_Customer_Notice/Noticelist_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>공지사항 관리 (목록)</span> <span class="badge badge-custom">Notice</span>
                    </a>
                    <a href="/admin/HNA_Customer_Councel/Councellist_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>1:1 상담 관리 (목록)</span> <span class="badge badge-custom">Counsel</span>
                    </a>
                    <a href="/admin/HNA_Customer_Referen/Referenlist_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>자료실 관리 (목록)</span> <span class="badge badge-custom">Referen</span>
                    </a>
                    <a href="/admin/HNA_Popup/Popup_List_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>팝업 관리 (목록)</span> <span class="badge badge-custom">Popup</span>
                    </a>
                    <a href="/admin/HNA_Brochure/Applicationlist_001" target="_blank" class="list-group-item list-group-item-action">
                        <span>브로슈어 신청 관리</span> <span class="badge badge-custom">Brochure</span>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5 text-muted">
            <small>&copy; {{ date('Y') }} Haneulnuri Project. All rights reserved.</small>
        </div>
    </div>
</body>
</html>
