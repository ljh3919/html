<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '하늘누리 관리자' }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Admin Common CSS -->
    <link href="{{ asset('css/admin-common.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans KR', sans-serif;
            background-color: #fff;
            color: #333;
        }
        #wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #5d401a;
            color: #fff;
            transition: all 0.3s;
            min-height: 100vh;
        }
        #sidebar .sidebar-header {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        #sidebar .sidebar-header h3 {
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 0;
            color: #fff;
        }
        #sidebar ul.components {
            padding: 0;
        }
        #sidebar ul li {
            position: relative;
        }
        #sidebar ul li a {
            padding: 15px 20px;
            font-size: 1rem;
            display: flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
            transition: 0.2s;
        }
        #sidebar ul li a i {
            width: 25px;
            margin-right: 10px;
            font-size: 1.1rem;
        }
        #sidebar ul li a:hover {
            background: rgba(0,0,0,0.1);
        }
        #sidebar ul li.active > a {
            background: #3e2a0f;
        }
        #sidebar ul li.active > a::after {
            content: '>';
            position: absolute;
            right: 15px;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .sub-menu {
            display: block;
            background: transparent;
            padding: 0;
        }
        .sub-menu li a {
            padding: 12px 20px 12px 55px !important;
            font-size: 0.95rem !important;
            color: #ddd !important;
            background: transparent !important;
        }
        .sub-menu li.active > a {
            background: #3e2a0f !important;
            color: #fff !important;
        }
        .sub-menu li a:hover {
            color: #fff !important;
            background: rgba(0,0,0,0.1) !important;
        }
        /* 화살표 표시 (활성화된 메뉴에만) */
        #sidebar ul li.active > a::after {
            content: '>';
            position: absolute;
            right: 15px;
            font-weight: bold;
            font-size: 1.2rem;
        }
        #content {
            width: 100%;
            transition: all 0.3s;
        }
        .top-navbar {
            background: #5d401a;
            color: #fff;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 30px;
        }
        .top-navbar .user-info {
            font-size: 0.9rem;
            margin-right: 20px;
        }
        .btn-logout {
            background: #fff;
            color: #5d401a;
            border: none;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            text-transform: uppercase;
        }
        .btn-logout i {
            margin-left: 8px;
        }
        .main-content {
            padding: 30px;
        }
        .content-title {
            font-size: 1.4rem;
            font-weight: bold;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }
        .content-title::before {
            content: '•';
            margin-right: 10px;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>하늘누리 추모공원</h3>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="javascript:void(0);">
                        <i class="far fa-user"></i> 관리자 관리
                    </a>
                    <ul class="sub-menu">
                        <li class="{{ Request::is('admin/HNA_Admag*') ? 'active' : '' }}">
                            <a href="{{ route('HNA_Admag_list_001') }}">관리자 관리</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="javascript:void(0);">
                        <i class="fas fa-user-friends"></i> 회원관리
                    </a>
                    <ul class="sub-menu">
                        <li class="{{ Request::is('admin/HNA_Memmag*') ? 'active' : '' }}">
                            <a href="{{ route('HNA_Memmag_List_001') }}">회원 관리</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="javascript:void(0);">
                        <i class="far fa-heart"></i> 사이버추모관
                    </a>
                    <ul class="sub-menu">
                        <li class="{{ Request::is('admin/HNA_Deadmag*') ? 'active' : '' }}">
                            <a href="{{ route('HNA_Deadmag_List_001') }}">고인 관리</a>
                        </li>
                        <li class="{{ Request::is('admin/HNA_Lettermag*') ? 'active' : '' }}">
                            <a href="{{ route('HNA_Lettermag_List_001') }}">하늘편지 관리</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="javascript:void(0);">
                        <i class="fas fa-volume-up"></i> 고객센터
                    </a>
                    <ul class="sub-menu">
                        <li class="{{ Request::is('admin/HNA_Customer_Notice*') ? 'active' : '' }}">
                            <a href="{{ route('HNA_Customer_Noticelist_001') }}">공지사항</a>
                        </li>
                        <li class="{{ Request::is('admin/HNA_Customer_Councel*') ? 'active' : '' }}">
                            <a href="{{ route('HNA_Customer_Councellist_001') }}">1:1 상담</a>
                        </li>
                        <li class="{{ Request::is('admin/HNA_Customer_Referen*') ? 'active' : '' }}">
                            <a href="{{ route('HNA_Customer_Referenlist_001') }}">자료실</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="javascript:void(0);">
                        <i class="far fa-window-maximize"></i> 팝업 관리
                    </a>
                    <ul class="sub-menu">
                        <li class="{{ Request::is('admin/HNA_Popup*') ? 'active' : '' }}">
                            <a href="{{ route('HNA_Popup_List_001') }}">팝업 관리</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="javascript:void(0);">
                        <i class="far fa-file-alt"></i> 브로슈어 신청
                    </a>
                    <ul class="sub-menu">
                        <li class="{{ Request::is('admin/HNA_Brochure*') ? 'active' : '' }}">
                            <a href="{{ route('HNA_Brochure_Applicationlist_001') }}">브로슈어 신청</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <header class="top-navbar">
                <div class="user-info">
                    <strong>{{ auth('admin')->user()->username ?? 'ADMIN' }}</strong> 님이 로그인 하였습니다.
                </div>
                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn-logout">
                    LOGOUT <i class="fas fa-sign-out-alt"></i>
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </header>

            <div class="main-content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Font Awesome JS (Removed defer JS in favor of CSS) -->
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
