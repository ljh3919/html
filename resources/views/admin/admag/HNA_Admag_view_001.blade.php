@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">관리자 관리 > 상세</h1>
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
                            <td>{{ $admin->name }}</td>
                        </tr>
                        <tr>
                            <th>아이디</th>
                            <td>{{ $admin->username }}</td>
                        </tr>
                        <tr>
                            <th>비밀번호</th>
                            <td>****************</td>
                        </tr>
                        <tr>
                            <th>핸드폰 번호</th>
                            <td>{{ $admin->phone }}</td>
                        </tr>
                        <tr>
                            <th>이메일</th>
                            <td>{{ $admin->email }}</td>
                        </tr>
                        <tr>
                            <th>등록일</th>
                            <td>{{ $admin->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('HNA_Admag_Modi_001', $admin->id) }}" class="btn btn-warning px-5">수정</a>
                <button type="button" class="btn btn-danger px-5 ml-2" onclick="deleteAdmin()">삭제</button>
                <a href="{{ route('HNA_Admag_list_001') }}" class="btn btn-secondary px-5 ml-2">목록</a>
            </div>
        </div>
    </div>
</div>

<form id="delete-form" action="{{ route('admin.admag.destroy', $admin->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function deleteAdmin() {
    if (confirm("삭제하시면 데이터를 되돌릴 수 없습니다. 정말 삭제하시겠습니까?")) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endsection
