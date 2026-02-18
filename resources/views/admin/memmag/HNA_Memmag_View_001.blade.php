@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">회원 관리 > 상세</h1>
        <div>
            <a href="{{ route('HNA_Memmag_Modi_001', $member->id) }}" class="btn btn-primary">수정</a>
            <button type="button" class="btn btn-danger" onclick="if(confirm('정말 삭제하시겠습니까?')) document.getElementById('delete-form').submit();">삭제</button>
            <a href="{{ route('HNA_Memmag_List_001') }}" class="btn btn-secondary">목록</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <colgroup>
                        <col style="width: 200px; background-color: #f8f9fc;">
                        <col>
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>이름</th>
                            <td>{{ $member->name }}</td>
                        </tr>
                        <tr>
                            <th>아이디</th>
                            <td>{{ $member->username }}</td>
                        </tr>
                        <tr>
                            <th>휴대전화 번호</th>
                            <td>{{ $member->phone }}</td>
                        </tr>
                        <tr>
                            <th>이메일</th>
                            <td>{{ $member->email }}</td>
                        </tr>
                        <tr>
                            <th>등록일</th>
                            <td>{{ $member->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>최근 수정일</th>
                            <td>{{ $member->updated_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form id="delete-form" action="{{ route('admin.memmag.destroy', $member->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection
