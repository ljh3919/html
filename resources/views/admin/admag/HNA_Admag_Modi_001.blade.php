@extends('layouts.admin')

@section('content')
<!-- title -->
<div class="wrap-tit">
    <h2 class="tit01">관리자 관리</h2>
</div>

@if ($errors->any())
    <div class="alert alert-danger border-0 shadow-sm mb-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form id="modi-form" action="{{ route('admin.admag.update', $admin->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <!-- table -->
    <table class="table board-table vertical-table">
        <tbody>
            <tr>
                <th class="required">이름</th>
                <td>
                    <div class="wrap-form">
                        <div class="input-group h30">
                            <input type="text" name="name" class="input-box" style="width: 325px;" value="{{ old('name', $admin->name) }}" required>
                            @error('name')
                            <span class="error-message">
                                <span class="error-icon">!</span>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="required">아이디</th>
                <td>
                    <div class="wrap-form">
                        <div class="input-group h30">
                            <input type="text" class="input-box" style="width: 325px;" value="{{ $admin->username }}" readonly disabled>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="required">비밀번호</th>
                <td>
                    <div class="wrap-form">
                        <div class="input-group h30">
                            <input type="password" name="password" class="input-box" style="width: 325px;" placeholder="*************">
                            @error('password')
                            <span class="error-message">
                                <span class="error-icon">!</span>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <span class="text-info">* 변경 시에만 입력하세요. 10~16자의 숫자와 영문 대 소문자 조합으로 사용하세요.</span>
                </td>
            </tr>
            <tr>
                <th class="required">비밀번호 확인</th>
                <td>
                    <div class="wrap-form">
                        <div class="input-group h30">
                            <input type="password" name="password_confirmation" class="input-box" style="width: 325px;" placeholder="*************">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="required">핸드폰 번호</th>
                <td>
                    <div class="wrap-form">
                        @php
                            $phoneParts = explode('-', $admin->phone);
                        @endphp
                        <div class="input-group h30">
                            <input type="text" name="phone_part1" class="input-box" style="width: 100px;" value="{{ old('phone_part1', $phoneParts[0] ?? '') }}" required>
                        </div>
                        -
                        <div class="input-group h30">
                            <input type="text" name="phone_part2" class="input-box" style="width: 100px;" maxlength="4" value="{{ old('phone_part2', $phoneParts[1] ?? '') }}" required>
                        </div>
                        -
                        <div class="input-group h30">
                            <input type="text" name="phone_part3" class="input-box" style="width: 100px;" maxlength="4" value="{{ old('phone_part3', $phoneParts[2] ?? '') }}" required>
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
                        @php
                            $emailParts = explode('@', $admin->email);
                        @endphp
                        <div class="input-group h30">
                            <input type="text" name="email_user" class="input-box" value="{{ old('email_user', $emailParts[0] ?? '') }}" required>
                        </div>
                        @
                        <div class="input-group h30">
                            <input type="text" name="email_domain" id="email-domain" class="input-box" value="{{ old('email_domain', $emailParts[1] ?? '') }}" required {{ (old('email_domain', $emailParts[1] ?? '') != '') ? 'readonly' : '' }}>
                        </div>
                        <div class="input-group h30">
                            <div class="select-wrapper">
                                <select class="input-box select" style="width: 160px;" onchange="const domainInput = document.getElementById('email-domain'); domainInput.value = this.value; domainInput.readOnly = (this.value !== '');">
                                    <option value="">직접입력</option>
                                    <option value="naver.com" {{ old('email_domain', $emailParts[1] ?? '') == 'naver.com' ? 'selected' : '' }}>naver.com</option>
                                    <option value="daum.net" {{ old('email_domain', $emailParts[1] ?? '') == 'daum.net' ? 'selected' : '' }}>daum.net</option>
                                    <option value="gmail.com" {{ old('email_domain', $emailParts[1] ?? '') == 'gmail.com' ? 'selected' : '' }}>gmail.com</option>
                                    <option value="nate.com" {{ old('email_domain', $emailParts[1] ?? '') == 'nate.com' ? 'selected' : '' }}>nate.com</option>
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
            <button type="button" class="btn line" onclick="location.href='{{ route('HNA_Admag_view_001', $admin->id) }}'">
                <span>취소</span>
            </button>
            <button type="submit" class="btn primary">
                <span>수정</span>
            </button>
        </div>
    </div>
</form>

<script>
document.getElementById('modi-form').addEventListener('submit', function(e) {
    const eu = document.querySelector('input[name="email_user"]').value;
    const ed = document.getElementById('email-domain').value;
    document.getElementById('email-full').value = `${eu}@${ed}`;
    
    const p1 = document.querySelector('input[name="phone_part1"]').value;
    const p2 = document.querySelector('input[name="phone_part2"]').value;
    const p3 = document.querySelector('input[name="phone_part3"]').value;
    document.getElementById('phone-full').value = `${p1}-${p2}-${p3}`;
});
</script>
@endsection
