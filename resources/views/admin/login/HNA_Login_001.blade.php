@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        .wrap-login .login-cont {
            width: 456px !important;
        }
    </style>
@endpush

@section('content')
<div class="container admin login">
    <div class="wrap-login">
        <div class="login-cont">
            <h1 class="tit-login">Login</h1>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('admin.login') }}" method="POST" class="form-login @if($errors->any()) error @endif" id="loginForm">
                @csrf
                <div class="form-tit">아이디</div>
                <div class="input-group @error('username') error @enderror">
                    <input
                        type="text"
                        name="username"
                        class="input-box"
                        placeholder="아이디를 입력해주세요."
                        value="{{ Cookie::get('remember_admin_id') ?? old('username') }}"
                        required
                        autofocus
                    />
                    @error('username')
                    <span class="error-message">
                        <span class="error-icon">!</span>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="form-tit">비밀번호</div>
                <div class="input-group @error('password') error @enderror">
                    <input
                        type="password"
                        name="password"
                        class="input-box"
                        placeholder="비밀번호를 입력해주세요."
                        required
                    />
                    @error('password')
                    <span class="error-message">
                        <span class="error-icon">!</span>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="checkbox-group">
                    <div class="checkbox-list">
                        <label class="checkbox-item">
                            <input type="checkbox" name="remember" class="checkbox-input" {{ Cookie::get('remember_admin_id') ? 'checked' : '' }} />
                            <span class="checkbox-label">아이디 저장</span>
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn primary h56 full" form="loginForm">
                    <span>로그인</span>
                </button>
            </form>
            <div class="wrap-find">
                <button type="button" class="btn empty" id="btnFindIdPopup">아이디 찾기</button>
                <button type="button" class="btn empty" id="btnFindPwPopup">비밀번호 찾기</button>
            </div>
        </div>
        <div class="alert-text">* 하늘누리 관리자만 로그인 가능합니다.</div>
    </div>
</div>

<!-- 아이디 찾기 모달 -->
<div class="modal fade" id="findIdModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="wrap-popup">
                <div class="popup-header">
                    <h3 class="popup-tit">아이디 찾기</h3>
                    <button type="button" class="popup-close" data-dismiss="modal" aria-label="닫기">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <path d="M4 28L28 4" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                            <path d="M4 4L28 28" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>
                <div class="popup-body">
                    <div class="popup-cont" id="findIdPopupContent">
                        <div class="wrap-cont">
                            <div id="findIdResult" class="alert d-none" style="margin-bottom: 20px; font-size: 14px; padding: 10px; border-radius: 8px; background-color: #fff1f0; border: 1px solid #ffa39e; color: #cf1322;"></div>
                            <form id="findIdForm">
                                @csrf
                                <div class="wrap-form">
                                    <div class="tit">이름</div>
                                    <div class="desc">
                                        <div class="input-group">
                                            <input type="text" name="name" id="modal_name" class="input-box" placeholder="성명을 입력해 주세요" required />
                                            <span class="error-message"><span class="error-icon">!</span>에러메세지</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-form">
                                    <div class="tit">이메일 주소</div>
                                    <div class="desc">
                                        <div class="input-group">
                                            <input type="email" name="email" id="modal_email" class="input-box" placeholder="이메일을 입력해 주세요" required />
                                            <span class="error-message"><span class="error-icon">!</span>에러메세지</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-btn">
                                     <button type="button" class="btn line" data-dismiss="modal"><span>취소</span></button>
                                     <button type="submit" class="btn primary"><span>찾기</span></button>
                                </div>
                            </form>
                            <div id="findIdSuccessArea" class="d-none">
                                <div class="wrap-cont">
                                    <p>고객님의 아이디는</p>
                                    <p>"<strong id="userIdResult"></strong>" 입니다.</p>
                                </div>
                                <div class="wrap-btn">
                                    <button type="button" class="btn primary" data-dismiss="modal"><span>확인</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 비밀번호 찾기 모달 -->
<div class="modal fade" id="findPwModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="wrap-popup">
                <div class="popup-header">
                    <h3 class="popup-tit">비밀번호 찾기</h3>
                    <button type="button" class="popup-close" data-dismiss="modal" aria-label="닫기">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <path d="M4 28L28 4" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                            <path d="M4 4L28 28" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>
                <div class="popup-body">
                    <div class="popup-cont" id="findPwPopupContent">
                        <div class="wrap-cont">
                            <div id="findPwResult" class="alert d-none" style="margin-bottom: 20px; font-size: 14px; padding: 10px; border-radius: 8px; background-color: #fff1f0; border: 1px solid #ffa39e; color: #cf1322;"></div>
                            <form id="findPwForm">
                                @csrf
                                <div class="wrap-form">
                                    <div class="tit">아이디</div>
                                    <div class="desc">
                                        <div class="input-group">
                                            <input type="text" name="username" id="modal_pw_username" class="input-box" placeholder="아이디를 입력해 주세요" required />
                                            <span class="error-message"><span class="error-icon">!</span>에러메세지</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-form">
                                    <div class="tit">이름</div>
                                    <div class="desc">
                                        <div class="input-group">
                                            <input type="text" name="name" id="modal_pw_name" class="input-box" placeholder="성명을 입력해 주세요" required />
                                            <span class="error-message"><span class="error-icon">!</span>에러메세지</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-form">
                                    <div class="tit">이메일 주소</div>
                                    <div class="desc">
                                        <div class="input-group">
                                            <input type="email" name="email" id="modal_pw_email" class="input-box" placeholder="이메일을 입력해 주세요" required />
                                            <span class="error-message"><span class="error-icon">!</span>에러메세지</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-btn">
                                    <button type="button" class="btn line" data-dismiss="modal"><span>취소</span></button>
                                    <button type="submit" class="btn primary"><span>찾기</span></button>
                                </div>
                            </form>
                            <div id="findPwSuccessArea" class="d-none">
                                <div class="wrap-cont">
                                    <p><span id="success_pw_username"></span> 님의 임시 비빌번호를</p>
                                    <p>등록된 이메일(<span id="success_pw_email"></span>)로 발송하였습니다.</p>
                                    <p>비밀번호를 변경 후 사용하시기 바랍니다.</p>
                                </div>
                                <div class="wrap-btn">
                                    <button type="button" class="btn primary" data-dismiss="modal"><span>확인</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // 수동으로 모달 호출하여 Bootstrap 자동 포커스 복원(엔터키 중복실행) 방지
    $('#btnFindIdPopup').on('click', function(e) {
        e.preventDefault();
        $('#findIdModal').modal('show');
    });

    $('#btnFindPwPopup').on('click', function(e) {
        e.preventDefault();
        $('#findPwModal').modal('show');
    });

    // 아이디 찾기 AJAX
    $('#findIdForm').on('submit', function(e) {
        e.preventDefault();
        const resultDiv = $('#findIdResult');
        const form = $('#findIdForm');
        const successArea = $('#findIdSuccessArea');

        resultDiv.addClass('d-none');

        $.ajax({
            url: "{{ route('admin.findId') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if(response.success) {
                    form.addClass('d-none');
                    $('#userIdResult').text(response.username);
                    successArea.removeClass('d-none');
                } else {
                    resultDiv.removeClass('d-none').text(response.message);
                }
            },
            error: function() {
                resultDiv.removeClass('d-none').text('시스템 오류가 발생했습니다.');
            }
        });
    });

    // 비밀번호 찾기 AJAX
    $('#findPwForm').on('submit', function(e) {
        e.preventDefault();
        const resultDiv = $('#findPwResult');
        const form = $('#findPwForm');
        const successArea = $('#findPwSuccessArea');

        resultDiv.addClass('d-none');

        $.ajax({
            url: "{{ route('admin.findPw') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if(response.success) {
                    form.addClass('d-none');
                    $('#success_pw_username').text(response.username);
                    $('#success_pw_email').text(response.email);
                    successArea.removeClass('d-none');
                } else {
                    resultDiv.removeClass('d-none').text(response.message);
                }
            },
            error: function() {
                resultDiv.removeClass('d-none').text('시스템 오류가 발생했습니다.');
            }
        });
    });

    // 모달 닫힐 때 초기화 및 포커스 뺏기 (엔터키 칠 때 다시 열리는 현상 방지)
    $('.modal').on('hidden.bs.modal', function() {
        $(this).find('form').removeClass('d-none');
        $(this).find('form')[0].reset();
        $(this).find('.alert').addClass('d-none');
        $('#findIdSuccessArea, #findPwSuccessArea').addClass('d-none');

        // 포커스를 패스워드 입력란이나 아이디 입력란 등 안전한 곳으로 이동시킵니다
        if ($('input[name="username"]').val() === '') {
            $('input[name="username"]').focus();
        } else {
            $('input[name="password"]').focus();
        }
    });
});
</script>
@endpush
