@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">관리자 관리 > 수정</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.admag.update', $admin->id) }}" method="POST" id="modi-form">
                @csrf
                @method('PUT')
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <colgroup>
                            <col style="width: 200px; background-color: #f8f9fc;">
                            <col>
                        </colgroup>
                        <tbody>
                            <tr>
                                <th class="align-middle">이름 <span class="text-danger">*</span></th>
                                <td>
                                    <input type="text" name="name" class="form-control w-50" value="{{ old('name', $admin->name) }}" required>
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle">아이디</th>
                                <td>
                                    <input type="text" class="form-control w-50" value="{{ $admin->username }}" readonly disabled>
                                    <small class="text-muted">아이디는 수정할 수 없습니다.</small>
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle">비밀번호</th>
                                <td>
                                    <input type="password" name="password" class="form-control w-50">
                                    <small class="text-muted">* 변경 시에만 입력하세요. 10~16자의 숫자와 영문 대 소문자 조합.</small>
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle">비밀번호 확인</th>
                                <td>
                                    <input type="password" name="password_confirmation" class="form-control w-50">
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle">핸드폰 번호 <span class="text-danger">*</span></th>
                                <td>
                                    @php
                                        $phoneParts = explode('-', $admin->phone);
                                    @endphp
                                    <div class="d-flex align-items-center">
                                        <select name="phone_part1" class="form-control" style="width: 80px;" required>
                                            <option value="010" {{ ($phoneParts[0] ?? '') == '010' ? 'selected' : '' }}>010</option>
                                            <option value="011" {{ ($phoneParts[0] ?? '') == '011' ? 'selected' : '' }}>011</option>
                                            <option value="016" {{ ($phoneParts[0] ?? '') == '016' ? 'selected' : '' }}>016</option>
                                            <option value="017" {{ ($phoneParts[0] ?? '') == '017' ? 'selected' : '' }}>017</option>
                                            <option value="018" {{ ($phoneParts[0] ?? '') == '018' ? 'selected' : '' }}>018</option>
                                            <option value="019" {{ ($phoneParts[0] ?? '') == '019' ? 'selected' : '' }}>019</option>
                                        </select>
                                        <span class="mx-2">-</span>
                                        <input type="text" name="phone_part2" class="form-control" style="width: 100px;" maxlength="4" value="{{ $phoneParts[1] ?? '' }}" required>
                                        <span class="mx-2">-</span>
                                        <input type="text" name="phone_part3" class="form-control" style="width: 100px;" maxlength="4" value="{{ $phoneParts[2] ?? '' }}" required>
                                        <input type="hidden" name="phone" id="phone-full">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle">이메일 <span class="text-danger">*</span></th>
                                <td>
                                    @php
                                        $emailParts = explode('@', $admin->email);
                                    @endphp
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="email_user" class="form-control" style="width: 150px;" value="{{ $emailParts[0] ?? '' }}" required>
                                        <span class="mx-2">@</span>
                                        <input type="text" name="email_domain" id="email-domain" class="form-control mr-2" style="width: 150px;" value="{{ $emailParts[1] ?? '' }}" required>
                                        <select class="form-control" style="width: 150px;" onchange="document.getElementById('email-domain').value = this.value; if(this.value) document.getElementById('email-domain').readOnly = true; else document.getElementById('email-domain').readOnly = false;">
                                            <option value="">직접입력</option>
                                            <option value="naver.com">naver.com</option>
                                            <option value="daum.net">daum.net</option>
                                            <option value="gmail.com">gmail.com</option>
                                            <option value="nate.com">nate.com</option>
                                        </select>
                                        <input type="hidden" name="email" id="email-full">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-warning px-5">수정</button>
                    <a href="{{ route('HNA_Admag_view_001', $admin->id) }}" class="btn btn-secondary px-5 ml-2">취소</a>
                </div>
                <p class="text-muted mt-3">(* 표시항목은 필수입력 항목입니다.)</p>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('modi-form').addEventListener('submit', function(e) {
    // 핸드폰 번호 조합
    const p1 = document.querySelector('select[name="phone_part1"]').value;
    const p2 = document.querySelector('input[name="phone_part2"]').value;
    const p3 = document.querySelector('input[name="phone_part3"]').value;
    document.getElementById('phone-full').value = `${p1}-${p2}-${p3}`;

    // 이메일 조합
    const eu = document.querySelector('input[name="email_user"]').value;
    const ed = document.getElementById('email-domain').value;
    document.getElementById('email-full').value = `${eu}@${ed}`;
});
</script>
@endsection
