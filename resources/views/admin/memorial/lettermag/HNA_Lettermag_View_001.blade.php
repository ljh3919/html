@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">사이버 추모관 > 하늘 편지 관리 > 상세</h1>
        <div>
            <button type="button" class="btn btn-danger" onclick="if(confirm('삭제하시면 데이터를 되돌릴 수 없습니다. 정말 삭제하시겠습니까?')) document.getElementById('delete-form').submit();">삭제</button>
            <a href="{{ route('HNA_Lettermag_List_001') }}" class="btn btn-secondary">목록</a>
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
                            <th>ID</th>
                            <td>{{ $letter->username }}</td>
                        </tr>
                        <tr>
                            <th class="align-middle">내용</th>
                            <td class="py-3">
                                <div style="white-space: pre-wrap; min-height: 150px;">{{ $letter->content }}</div>
                                <div class="text-right text-muted small mt-2">
                                    (작성 가능한 내용은 최대 600자로 제한됩니다.)
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>작성자</th>
                            <td>{{ $letter->author_description }}</td>
                        </tr>
                        <tr>
                            <th>비밀글</th>
                            <td>{{ $letter->is_private == 'Y' ? 'Y' : 'N' }}</td>
                        </tr>
                        <tr>
                            <th>작성일</th>
                            <td>{{ $letter->created_at->format('Y.m.d') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form id="delete-form" action="{{ route('admin.lettermag.destroy', $letter->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection
