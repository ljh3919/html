@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #000 !important;
        margin: 0;
        padding: 0;
        font-family: 'Noto Sans KR', sans-serif;
    }
    .login-wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .login-card {
        background-color: #e6e6e6;
        width: 100%;
        max-width: 450px;
        padding: 60px 50px;
        border-radius: 80px; /* Large rounded corners as seen in design */
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .login-title {
        font-size: 42px;
        font-weight: 800;
        color: #4b3621;
        margin-bottom: 40px;
        position: relative;
        display: inline-block;
    }
    .login-title::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 45px;
        height: 4px;
        background-color: #4b3621;
    }
    .form-group label {
        font-size: 16px;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
        display: block;
    }
    .form-control {
        background-color: transparent !important;
        border: 1px solid #bcbcbc !important;
        border-radius: 8px !important;
        height: 50px !important;
        padding: 10px 15px !important;
        font-size: 15px !important;
        color: #333 !important;
    }
    .form-control::placeholder {
        color: #999;
    }
    .form-control:focus {
        border-color: #4b3621 !important;
        box-shadow: none !important;
    }
    .custom-checkbox .custom-control-label {
        font-size: 15px;
        color: #333;
        font-weight: 500;
        padding-top: 2px;
    }
    .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
        background-color: #4b3621;
        border-color: #4b3621;
    }
    .btn-login {
        background-color: #4b3621;
        border: none;
        color: #fff;
        width: 100%;
        height: 65px;
        border-radius: 12px;
        font-size: 20px;
        font-weight: 700;
        margin-top: 30px;
        transition: all 0.3s;
    }
    .btn-login:hover {
        background-color: #3a2a1a;
        color: #fff;
    }
    .login-footer-links {
        margin-top: 40px;
        display: flex;
        justify-content: center;
        margin-top: 35px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 15px;
        color: #666;
    }
    .login-footer-links a {
        color: #444;
        text-decoration: none;
        font-weight: 500;
    }
    .login-footer-links a:hover {
        color: #4b3621;
    }
    .login-footer-links .divider {
        margin: 0 15px;
        color: #ccc;
    }

    /* 하단 안내 텍스트 */
    .login-bottom-info {
        margin-top: 25px;
        color: #666;
        font-size: 14px;
        font-weight: 500;
    }

    /* --- 모달 스타일 (HNA_Login_002P 반영) --- */
    .modal-content {
        border-radius: 20px !important;
        overflow: hidden;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .modal-header {
        background-color: #5d401f; /* 시안의 브라운 컬러 */
        color: #fff;
        padding: 15px 25px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .modal-title {
        font-size: 18px;
        font-weight: 700;
        line-height: 1;
    }
    .modal-header .close {
        color: #fff;
        opacity: 1;
        font-size: 24px;
        padding: 15px;
        margin: -15px -25px -15px auto;
    }
    .modal-body {
        padding: 40px 30px;
        background-color: #fff;
    }
    .modal-body .form-group {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }
    .modal-body .form-group label {
        width: 100px;
        margin-bottom: 0;
        font-size: 15px;
        font-weight: 700;
        color: #333;
    }
    .modal-body .form-group .form-control {
        flex: 1;
    }
    
    .modal-footer {
        padding: 0 30px 40px;
        border: none;
        display: flex;
        gap: 10px;
        justify-content: center;
    }
    .modal-footer .btn {
        width: 120px;
        height: 45px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 15px;
        border: none;
    }
    .btn-modal-cancel {
        background-color: #fff;
        color: #333;
        border: 1px solid #bcbcbc !important;
    }
    .btn-modal-submit {
        background-color: #5d401f;
        color: #fff;
    }
    .btn-modal-submit:hover {
        background-color: #4a3319;
        color: #fff;
    }

    #findIdResult, #findPwResult {
        font-size: 14px;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    /* 아이디 찾기 결과 전용 스타일 */
    .find-result-area {
        text-align: center;
        padding: 20px 0;
    }
    .find-result-text {
        font-size: 18px;
        color: #333;
        margin-bottom: 30px;
        line-height: 1.6;
    }
    .find-result-text strong {
        color: #4b3621;
        font-size: 20px;
        border-bottom: 2px solid #4b3621;
        padding-bottom: 2px;
    }
    .btn-go-login {
        background-color: #4b3621;
        color: #fff;
        width: 100%;
        height: 50px;
        border-radius: 8px;
        font-weight: 700;
        border: none;
    }
    .btn-go-login:hover {
        background-color: #3a2a1a;
        color: #fff;
    }
</style>

<div class="login-wrapper">
    <div class="login-card">
        <h1 class="login-title">Login</h1>

        @if ($errors->any())
            <div class="alert alert-danger small mb-4">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="form-group mb-4">
                <label for="username">아이디</label>
                <input class="form-control" id="username" name="username" type="text" placeholder="아이디를 입력해주세요." value="{{ Cookie::get('remember_admin_id') ?? old('username') }}" required autofocus />
            </div>
            <div class="form-group mb-4">
                <label for="password">비밀번호</label>
                <input class="form-control" id="password" name="password" type="password" placeholder="비밀번호를 입력해주세요." required />
            </div>
            <div class="form-group mb-4">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" id="remember" name="remember" type="checkbox" {{ Cookie::get('remember_admin_id') ? 'checked' : '' }} />
                    <label class="custom-control-label" for="remember">아이디 저장</label>
                </div>
            </div>
            <button type="submit" class="btn btn-login">로그인</button>
        </form>

        <div class="login-footer-links">
            <a href="#" data-toggle="modal" data-target="#findIdModal">아이디 찾기</a>
            <span class="divider">|</span>
            <a href="#" data-toggle="modal" data-target="#findPwModal">비밀번호 찾기</a>
        </div>
    </div>
    <div class="login-bottom-info">
        * 하늘누리 관리자만 로그인 가능합니다.
    </div>
</div>

<!-- 아이디 찾기 모달 (HNA_Login_002P 반영) -->
<div class="modal fade" id="findIdModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">아이디 찾기</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="findIdResult" class="alert d-none"></div>
                
                <!-- 입력 폼 영역 -->
                <form id="findIdForm">
                    @csrf
                    <div class="form-group">
                        <label for="modal_name">이름</label>
                        <input type="text" id="modal_name" name="name" class="form-control" placeholder="성명을 입력해 주세요" required>
                    </div>
                    <div class="form-group">
                        <label for="modal_email">이메일 주소</label>
                        <input type="email" id="modal_email" name="email" class="form-control" placeholder="이메일을 입력해 주세요" required>
                    </div>
                </form>

                <!-- 결과 노출 영역 (성공 시) -->
                <div id="findIdSuccessArea" class="find-result-area d-none">
                    <div class="find-result-text">
                        <span id="userNameResult">관리자</span>님의 아이디는<br>
                        <strong id="userIdResult">ID</strong> 입니다.
                    </div>
                    <button type="button" class="btn btn-go-login" data-dismiss="modal">확인</button>
                </div>
            </div>
            <div class="modal-footer" id="findIdModalFooter">
                <button type="button" class="btn btn-modal-cancel" data-dismiss="modal">취소</button>
                <button type="submit" form="findIdForm" class="btn btn-modal-submit">찾기</button>
            </div>
        </div>
    </div>
</div>

<!-- 비밀번호 찾기 모달 -->
<div class="modal fade" id="findPwModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">비밀번호 찾기</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="findPwResult" class="alert d-none"></div>

                <!-- 입력 폼 영역 -->
                <form id="findPwForm">
                    @csrf
                    <div class="form-group">
                        <label for="modal_pw_username">아이디</label>
                        <input type="text" id="modal_pw_username" name="username" class="form-control" placeholder="아이디를 입력해 주세요" required>
                    </div>
                    <div class="form-group">
                        <label for="modal_pw_name">이름</label>
                        <input type="text" id="modal_pw_name" name="name" class="form-control" placeholder="성명을 입력해 주세요" required>
                    </div>
                    <div class="form-group">
                        <label for="modal_pw_email">이메일 주소</label>
                        <input type="email" id="modal_pw_email" name="email" class="form-control" placeholder="이메일을 입력해 주세요" required>
                    </div>
                </form>

                <!-- 결과 노출 영역 (성공 시) -->
                <div id="findPwSuccessArea" class="find-result-area d-none">
                    <div class="find-result-text">
                        임시 비밀번호가 발송되었습니다.<br>
                        이메일을 확인해 주세요.
                    </div>
                    <button type="button" class="btn btn-go-login" data-dismiss="modal">확인</button>
                </div>
            </div>
            <div class="modal-footer" id="findPwModalFooter">
                <button type="button" class="btn btn-modal-cancel" data-dismiss="modal">취소</button>
                <button type="submit" form="findPwForm" class="btn btn-modal-submit">찾기</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // 아이디 찾기 AJAX
    $('#findIdForm').on('submit', function(e) {
        e.preventDefault();
        const resultDiv = $('#findIdResult');
        const form = $('#findIdForm');
        const successArea = $('#findIdSuccessArea');
        const footer = $('#findIdModalFooter');
        
        resultDiv.addClass('d-none').removeClass('alert-success alert-danger');

        $.ajax({
            url: "{{ route('admin.findId') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if(response.success) {
                    // 성공 시 폼과 푸터 숨기고 결과 노출
                    form.addClass('d-none');
                    footer.addClass('d-none');
                    
                    $('#userNameResult').text($('#modal_name').val());
                    $('#userIdResult').text(response.username);
                    successArea.removeClass('d-none');
                } else {
                    resultDiv.addClass('alert-danger').text(response.message).removeClass('d-none');
                }
            },
            error: function() {
                resultDiv.addClass('alert-danger').text('시스템 오류가 발생했습니다. 잠시 후 다시 시도해주세요.').removeClass('d-none');
            }
        });
    });

    // 비밀번호 찾기 AJAX
    $('#findPwForm').on('submit', function(e) {
        e.preventDefault();
        const resultDiv = $('#findPwResult');
        const form = $('#findPwForm');
        const successArea = $('#findPwSuccessArea');
        const footer = $('#findPwModalFooter');

        resultDiv.addClass('d-none').removeClass('alert-success alert-danger');

        $.ajax({
            url: "{{ route('admin.findPw') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if(response.success) {
                    // 성공 시 폼과 푸터 숨기고 결과 노출
                    form.addClass('d-none');
                    footer.addClass('d-none');
                    successArea.removeClass('d-none');
                } else {
                    resultDiv.addClass('alert-danger').text(response.message).removeClass('d-none');
                }
            },
            error: function() {
                resultDiv.addClass('alert-danger').text('시스템 오류가 발생했습니다. 잠시 후 다시 시도해주세요.').removeClass('d-none');
            }
        });
    });

    // 모달 닫힐 때 초기화
    $('.modal').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $(this).find('.alert').addClass('d-none');
        
        // 아이디/비밀번호 찾기 전용 초기좌
        $('#findIdForm, #findPwForm').removeClass('d-none');
        $('#findIdModalFooter, #findPwModalFooter').removeClass('d-none');
        $('#findIdSuccessArea, #findPwSuccessArea').addClass('d-none');
    });
});
</script>
@endpush
@endsection
