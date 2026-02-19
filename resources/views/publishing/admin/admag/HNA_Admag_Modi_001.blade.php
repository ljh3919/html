@extends('layouts.admin')

@section('styles')
<style>
    .table-header-custom {
        background-color: #f8f9fa;
        font-weight: 500;
        vertical-align: middle !important;
        padding-left: 20px !important;
        border-bottom: 1px solid #dee2e6 !important;
    }
    .table-cell-custom {
        padding: 12px 20px !important;
        border-bottom: 1px solid #dee2e6 !important;
    }
    .btn-outline-custom {
        background-color: #fff;
        border: 1px solid #ced4da;
        color: #333;
        font-weight: 500;
    }
    .btn-outline-custom:hover {
        background-color: #f8f9fa;
        color: #000;
    }
</style>
@endsection

@section('content')
<div class="container-fluid text-black">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <div style="font-size: 1.5rem; font-weight: 700; color: #000;">• 관리자 관리</div>
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

    <div class="card border-0">
        <div class="card-body p-0">
            <form id="modi-form" action="{{ route('admin.admag.update', $admin->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <colgroup>
                            <col style="width: 180px;">
                            <col>
                        </colgroup>
                        <tbody>
                            <tr>
                                <th class="table-header-custom">이름 <span class="text-danger ml-1">*</span></th>
                                <td class="table-cell-custom">
                                    <input type="text" name="name" class="form-control form-control-sm" style="width: 300px;" value="{{ old('name', $admin->name) }}" required>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-custom">아이디</th>
                                <td class="table-cell-custom">
                                    <input type="text" class="form-control form-control-sm bg-light" style="width: 300px; border: 1px solid #ced4da;" value="{{ $admin->username }}" readonly disabled>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-custom">비밀번호</th>
                                <td class="table-cell-custom py-3">
                                    <input type="password" name="password" class="form-control form-control-sm" style="width: 300px;" placeholder="*************">
                                    <small class="text-secondary mt-1 d-block" style="font-size: 0.8rem;">* 변경 시에만 입력하세요. 10~16자의 숫자와 영문 대 소문자 조합으로 사용하세요.</small>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-custom">비밀번호 확인</th>
                                <td class="table-cell-custom">
                                    <input type="password" name="password_confirmation" class="form-control form-control-sm" style="width: 300px;" placeholder="*************">
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-custom">핸드폰 번호 <span class="text-danger ml-1">*</span></th>
                                <td class="table-cell-custom">
                                    @php
                                        $phoneParts = explode('-', $admin->phone);
                                    @endphp
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="phone_part1" class="form-control form-control-sm text-center" style="width: 100px;" value="{{ $phoneParts[0] ?? '' }}" required>
                                        <span class="mx-1 text-secondary">-</span>
                                        <input type="text" name="phone_part2" class="form-control form-control-sm text-center" style="width: 100px;" maxlength="4" value="{{ $phoneParts[1] ?? '' }}" required>
                                        <span class="mx-1 text-secondary">-</span>
                                        <input type="text" name="phone_part3" class="form-control form-control-sm text-center" style="width: 100px;" maxlength="4" value="{{ $phoneParts[2] ?? '' }}" required>
                                        <input type="hidden" name="phone" id="phone-full">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-custom">이메일 <span class="text-danger ml-1">*</span></th>
                                <td class="table-cell-custom">
                                    @php
                                        $emailParts = explode('@', $admin->email);
                                    @endphp
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="email_user" class="form-control form-control-sm" style="width: 200px;" value="{{ $emailParts[0] ?? '' }}" required>
                                        <span class="mx-2 text-secondary">@</span>
                                        <input type="text" name="email_domain" id="email-domain" class="form-control form-control-sm mr-2" style="width: 200px;" value="{{ $emailParts[1] ?? '' }}" required>
                                        <select class="form-control form-control-sm" style="width: 150px;" onchange="document.getElementById('email-domain').value = this.value; if(this.value) document.getElementById('email-domain').readOnly = true; else document.getElementById('email-domain').readOnly = false;">
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

                <div class="d-flex justify-content-between align-items-center mt-4 mb-5">
                    <p class="text-danger small mb-0 mr-auto">* 표시항목은 필수입력 항목입니다.</p>
                    <div class="d-flex">
                        <a href="{{ route('HNA_Admag_view_001', $admin->id) }}" class="btn btn-sm btn-outline-custom px-4 py-2 mr-2" style="min-width: 80px;">취소</a>
                        <button type="submit" class="btn btn-sm text-white px-4 py-2" style="background-color: #5d401a; border: 1px solid #5d401a; min-width: 80px; font-weight: 500;">수정</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
            </form>
        </div>
    </div>
</div>

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
