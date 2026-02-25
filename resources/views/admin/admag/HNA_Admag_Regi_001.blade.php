@extends('layouts.admin')

@section('content')
<!-- title -->
<div class="wrap-tit">
    <h2 class="tit01">관리자 관리</h2>
</div>

<form id="regi-form" action="{{ route('admin.admag.store') }}" method="POST">
    @csrf
    <!-- table -->
    <table class="table board-table vertical-table">
        <tbody>
            <tr>
                <th class="required">이름</th>
                <td>
                    <div class="wrap-form">
                        <div class="input-group h30">
                            <input type="text" name="name" class="input-box @error('name') error @enderror" style="width: 325px" value="{{ old('name') }}" required />
                        </div>
                        @error('name')
                        <div class="wrap-form mt-1">
                            <span class="error-message">
                                <span class="error-icon">!</span>
                                {{ $message }}
                            </span>
                        </div>
                        @enderror
                    </div>
                </td>
            </tr>
            <tr>
                <th class="required">아이디</th>
                <td>
                    <div class="wrap-form">
                        <div class="input-group h30">
                            <input type="text" name="username" class="input-box @error('username') error @enderror" style="width: 325px" value="{{ old('username') }}" required />
                        </div>
                        @error('username')
                        <div class="wrap-form mt-1">
                            <span class="error-message">
                                <span class="error-icon">!</span>
                                {{ $message }}
                            </span>
                        </div>
                        @else
                        <span class="text-info mt-1">* 영문 또는 영문+숫자만 가능</span>
                        @enderror
                    </div>
                </td>
            </tr>
            <tr>
                <th class="required">비밀번호</th>
                <td>
                    <div class="wrap-form">
                        <div class="input-group h30">
                            <input type="password" name="password" class="input-box @error('password') error @enderror" style="width: 325px" required />
                        </div>
                        @error('password')
                        <div class="wrap-form mt-1">
                            <span class="error-message">
                                <span class="error-icon">!</span>
                                {{ $message }}
                            </span>
                        </div>
                        @else
                        <span class="text-info mt-1">* 10~16자의 숫자와 영문 대 소문자 조합으로 사용하세요.</span>
                        @enderror
                    </div>
                </td>
            </tr>
            <tr>
                <th class="required">비밀번호 확인</th>
                <td>
                    <div class="wrap-form">
                        <div class="input-group h30">
                            <input type="password" name="password_confirmation" class="input-box" style="width: 325px" required />
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="required">핸드폰 번호</th>
                <td>
                    <div class="wrap-form">
                        <div class="input-group h30">
                            <select name="phone_part1" class="input-box select text-center" style="width: 100px;" required>
                                <option value="010" {{ old('phone_part1') == '010' ? 'selected' : '' }}>010</option>
                                <option value="011" {{ old('phone_part1') == '011' ? 'selected' : '' }}>011</option>
                                <option value="016" {{ old('phone_part1') == '016' ? 'selected' : '' }}>016</option>
                                <option value="017" {{ old('phone_part1') == '017' ? 'selected' : '' }}>017</option>
                                <option value="018" {{ old('phone_part1') == '018' ? 'selected' : '' }}>018</option>
                                <option value="019" {{ old('phone_part1') == '019' ? 'selected' : '' }}>019</option>
                            </select>
                        </div>
                        -
                        <div class="input-group h30">
                            <input type="text" name="phone_part2" class="input-box text-center" style="width: 100px" maxlength="4" value="{{ old('phone_part2') }}" required />
                        </div>
                        -
                        <div class="input-group h30">
                            <input type="text" name="phone_part3" class="input-box text-center" style="width: 100px" maxlength="4" value="{{ old('phone_part3') }}" required />
                        </div>
                        <input type="hidden" name="phone" id="phone-full">
                    </div>
                    @error('phone')
                    <div class="wrap-form mt-1">
                        <span class="error-message">
                            <span class="error-icon">!</span>
                            {{ $message }}
                        </span>
                    </div>
                    @enderror
                </td>
            </tr>
            <tr>
                <th class="required">이메일</th>
                <td>
                    <div class="wrap-form">
                        <div class="input-group h30">
                            <input type="text" name="email_user" class="input-box" value="{{ old('email_user') }}" required />
                        </div>
                        @
                        <div class="input-group h30">
                            <input type="text" name="email_domain" id="email-domain" class="input-box" value="{{ old('email_domain') }}" required {{ old('email_domain') ? 'readonly' : '' }} />
                        </div>
                        <div class="input-group h30">
                            <div class="select-wrapper">
                                <select class="input-box select" style="width: 160px" onchange="const domainInput = document.getElementById('email-domain'); domainInput.value = this.value; domainInput.readOnly = (this.value !== '');">
                                    <option value="">직접입력</option>
                                    <option value="naver.com" {{ old('email_domain') == 'naver.com' ? 'selected' : '' }}>naver.com</option>
                                    <option value="daum.net" {{ old('email_domain') == 'daum.net' ? 'selected' : '' }}>daum.net</option>
                                    <option value="gmail.com" {{ old('email_domain') == 'gmail.com' ? 'selected' : '' }}>gmail.com</option>
                                    <option value="nate.com" {{ old('email_domain') == 'nate.com' ? 'selected' : '' }}>nate.com</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="email" id="email-full">
                    </div>
                    @error('email')
                    <div class="wrap-form mt-1">
                        <span class="error-message">
                            <span class="error-icon">!</span>
                            {{ $message }}
                        </span>
                    </div>
                    @enderror
                </td>
            </tr>
        </tbody>
    </table>
    <!-- board button -->
    <div class="wrap-board-btn">
        <div class="text-info">표시항목은 필수입력 항목입니다.</div>
        <div class="wrap-btn-right">
            <button type="button" class="btn line small" onclick="location.href='{{ route('HNA_Admag_list_001') }}'">
                <span>취소</span>
            </button>
            <button type="submit" class="btn primary small">
                <span>등록</span>
            </button>
        </div>
    </div>
</form>

<script>
document.getElementById('regi-form').addEventListener('submit', function(e) {
    const p1 = document.querySelector('select[name="phone_part1"]').value;
    const p2 = document.querySelector('input[name="phone_part2"]').value;
    const p3 = document.querySelector('input[name="phone_part3"]').value;
    document.getElementById('phone-full').value = `${p1}-${p2}-${p3}`;

    const eu = document.querySelector('input[name="email_user"]').value;
    const ed = document.getElementById('email-domain').value;
    document.getElementById('email-full').value = `${eu}@${ed}`;
});
</script>
@endsection
