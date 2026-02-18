<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '하늘누리 관리자' }}</title>
    <!-- Bootstrap CSS (가정: CDN 사용 중이거나 이미 포함됨) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans KR', sans-serif;
            background-color: #f4f7f6;
        }
        #wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #343a40;
            color: #fff;
            transition: all 0.3s;
            min-height: 100vh;
        }
        #sidebar .sidebar-header {
            padding: 20px;
            background: #212529;
        }
        #sidebar ul.components {
            padding: 20px 0;
        }
        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }
        #sidebar ul li a {
            padding: 10px 20px;
            font-size: 1.1em;
            display: block;
            color: #adb5bd;
            text-decoration: none;
        }
        #sidebar ul li a:hover {
            color: #fff;
            background: #495057;
        }
        #sidebar ul li.active > a {
            color: #fff;
            background: #007bff;
        }
        #content {
            width: 100%;
            padding: 20px;
            transition: all 0.3s;
        }
        .menu-title {
            font-size: 0.9em;
            font-weight: bold;
            text-transform: uppercase;
            padding: 10px 20px;
            color: #6c757d;
        }
        .sub-menu {
            padding-left: 20px;
            font-size: 0.9em;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>하늘누리 Admin</h3>
            </div>
            <ul class="list-unstyled components">
                <!-- <div class="menu-title">관리자 관리</div> -->
                <li class="{{ Request::is('admin/HNA_Admag*') ? 'active' : '' }}">
                    <a href="{{ route('HNA_Admag_list_001') }}">관리자 관리</a>
                </li>
                
                <!-- <div class="menu-title">회원 관리</div> -->
                <li class="{{ Request::is('admin/HNA_Memmag*') ? 'active' : '' }}">
                    <a href="{{ route('HNA_Memmag_List_001') }}">회원 관리</a>
                </li>
                
                <li>
                    <a href="#cyberSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">사이버 추모관</a>
                    <ul class="collapse list-unstyled sub-menu {{ Request::is('admin/HNA_Deadmag*', 'admin/HNA_Lettermag*') ? 'show' : '' }}" id="cyberSubmenu">
                        <li class="{{ Request::is('admin/HNA_Deadmag*') ? 'active' : '' }}">
                            <a href="{{ route('HNA_Deadmag_List_001') }}">고인 관리</a>
                        </li>
                        <li class="{{ Request::is('admin/HNA_Lettermag*') ? 'active' : '' }}">
                            <a href="{{ route('HNA_Lettermag_List_001') }}">하늘 편지 관리</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="#customerSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">고객센터</a>
                    <ul class="collapse list-unstyled sub-menu {{ Request::is('admin/HNA_Customer_Notice*', 'admin/HNA_Customer_Councel*', 'admin/HNA_Customer_Referen*') ? 'show' : '' }}" id="customerSubmenu">
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
                
                <li class="{{ Request::is('admin/HNA_Popup*') ? 'active' : '' }}">
                    <a href="{{ route('HNA_Popup_List_001') }}">팝업관리</a>
                </li>
                
                <li class="{{ Request::is('admin/HNA_Brochure*') ? 'active' : '' }}">
                    <a href="{{ route('HNA_Brochure_Applicationlist_001') }}">브로슈어 신청관리</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 shadow-sm">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-dark">
                        <i class="fas fa-align-left"></i>
                        <span>메뉴 토글</span>
                    </button>
                    <div class="ml-auto">
                        <span class="mr-3">{{ auth('admin')->user()->name ?? '관리자' }}님 환영합니다</span>
                        <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-outline-danger btn-sm">로그아웃</a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </nav>

            @yield('content')
        </div>
    </div>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
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
