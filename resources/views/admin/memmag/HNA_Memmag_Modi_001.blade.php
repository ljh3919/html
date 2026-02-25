@extends('layouts.admin')

@section('content')
<!-- title -->
<div class="wrap-tit">
    <h2 class="tit01">회원 관리</h2>
</div>

<form id="modi-form" action="{{ route('admin.memmag.update', $member->id) }}" method="POST">
    @csrf
    @method('PUT')
    <!-- table -->
    <table class="table board-table vertical-table">
        <tr>
            <th>아이디</th>
            <td>{{ $member->username }}</td>
        </tr>
        <tr>
            <th class="required">이름</th>
            <td>
                <div class="wrap-form">
                    <div class="input-group h30">
                        <input type="text" name="name" class="input-box @error('name') error @enderror" style="width: 325px" value="{{ old('name', $member->name) }}" required />
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
            <th class="required">휴대전화 번호</th>
            <td>
                @php
                    $phoneParts = explode('-', old('phone', $member->phone));
                @endphp
                <div class="wrap-form">
                    <div class="input-group h30">
                        <select name="phone_part1" class="input-box select" style="width: 100px;" required>
                            <option value="010" {{ ($phoneParts[0] ?? '') == '010' ? 'selected' : '' }}>010</option>
                            <option value="011" {{ ($phoneParts[0] ?? '') == '011' ? 'selected' : '' }}>011</option>
                            <option value="016" {{ ($phoneParts[0] ?? '') == '016' ? 'selected' : '' }}>016</option>
                            <option value="017" {{ ($phoneParts[0] ?? '') == '017' ? 'selected' : '' }}>017</option>
                            <option value="018" {{ ($phoneParts[0] ?? '') == '018' ? 'selected' : '' }}>018</option>
                            <option value="019" {{ ($phoneParts[0] ?? '') == '019' ? 'selected' : '' }}>019</option>
                        </select>
                    </div>
                    <span class="mx-1">-</span>
                    <div class="input-group h30">
                        <input type="text" name="phone_part2" class="input-box" style="width: 100px" maxlength="4" value="{{ $phoneParts[1] ?? '' }}" required />
                    </div>
                    <span class="mx-1">-</span>
                    <div class="input-group h30">
                        <input type="text" name="phone_part3" class="input-box" style="width: 100px" maxlength="4" value="{{ $phoneParts[2] ?? '' }}" required />
                    </div>
                    <input type="hidden" name="phone" id="phone-full">
                </div>
                @error('phone')
                <div class="wrap-form mt-1">
                    <div class="input-group">
                        <span class="error-message">
                            <span class="error-icon">!</span>
                            {{ $message }}
                        </span>
                    </div>
                </div>
                @enderror
            </td>
        </tr>
        <tr>
            <th class="required">이메일</th>
            <td>
                @php
                    $emailFull = old('email', $member->email);
                    $emailParts = explode('@', $emailFull);
                @endphp
                <div class="wrap-form">
                    <div class="input-group h30">
                        <input type="text" name="email_user" class="input-box" value="{{ $emailParts[0] ?? '' }}" required />
                    </div>
                    <span class="mx-1">@</span>
                    <div class="input-group h30">
                        <input type="text" name="email_domain" id="email-domain" class="input-box" value="{{ $emailParts[1] ?? '' }}" required />
                    </div>
                    <div class="input-group h30 mx-1">
                        <div class="select-wrapper">
                            <select class="input-box select" style="width: 160px" onchange="document.getElementById('email-domain').value = this.value; if(this.value) document.getElementById('email-domain').readOnly = true; else document.getElementById('email-domain').readOnly = false;">
                                <option value="">직접입력</option>
                                <option value="naver.com" {{ ($emailParts[1] ?? '') == 'naver.com' ? 'selected' : '' }}>naver.com</option>
                                <option value="daum.net" {{ ($emailParts[1] ?? '') == 'daum.net' ? 'selected' : '' }}>daum.net</option>
                                <option value="gmail.com" {{ ($emailParts[1] ?? '') == 'gmail.com' ? 'selected' : '' }}>gmail.com</option>
                                <option value="nate.com" {{ ($emailParts[1] ?? '') == 'nate.com' ? 'selected' : '' }}>nate.com</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="email" id="email-full">
                </div>
                @error('email')
                <div class="wrap-form mt-1">
                    <div class="input-group">
                        <span class="error-message">
                            <span class="error-icon">!</span>
                            {{ $message }}
                        </span>
                    </div>
                </div>
                @enderror
            </td>
        </tr>
        <tr>
            <th>등록일</th>
            <td>{{ $member->created_at->format('Y-m-d') }}</td>
        </tr>
    </table>
    <!-- board button -->
    <div class="wrap-board-btn">
        <div class="text-info">표시항목은 필수입력 항목입니다.</div>
        <div class="wrap-btn-right">
            <button type="button" class="btn line small" onclick="location.href='{{ route('HNA_Memmag_View_001', $member->id) }}'">
                <span>취소</span>
            </button>
            <button type="submit" class="btn primary small">
                <span>수정</span>
            </button>
        </div>
    </div>
</form>

<script>
document.getElementById('modi-form').addEventListener('submit', function(e) {
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
