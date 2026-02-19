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
        <div style="font-size: 1.5rem; font-weight: 700; color: #000;">• 하늘편지 관리</div>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <colgroup>
                        <col style="width: 180px;">
                        <col>
                    </colgroup>
                    <tbody>
                        <tr>
                            <th class="table-header-custom">아이디 <span class="text-danger ml-1">*</span></th>
                            <td class="table-cell-custom">{{ $letter->username }}</td>
                        </tr>
                        <tr>
                            <th class="table-header-custom">내용 <span class="text-danger ml-1">*</span></th>
                            <td class="table-cell-custom py-3">
                                <div class="text-secondary mb-2" style="font-size: 0.9rem;">작성 가능한 글의 숫자는 600자로 제한 합니다.</div>
                                <div style="white-space: pre-wrap; min-height: 150px; font-size: 0.95rem; color: #333; line-height: 1.6;">{{ $letter->content }}</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-header-custom">작성자 <span class="text-danger ml-1">*</span></th>
                            <td class="table-cell-custom">{{ $letter->author_description }}</td>
                        </tr>
                        <tr>
                            <th class="table-header-custom">비밀글 여부 <span class="text-danger ml-1">*</span></th>
                            <td class="table-cell-custom">
                                @if($letter->is_private == 'Y')
                                    <span class="text-danger font-weight-bold">비밀글</span>
                                @else
                                    <span class="text-primary">공개글</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="table-header-custom">작성일</th>
                            <td class="table-cell-custom text-secondary">{{ $letter->created_at->format('Y-m-d') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end align-items-center mt-4 mb-5">
        <a href="{{ route('HNA_Lettermag_List_001') }}" class="btn btn-sm btn-outline-custom px-4 py-2 mr-2" style="min-width: 80px;">목록</a>
        <button type="button" class="btn btn-sm btn-outline-custom px-4 py-2 mr-2" style="min-width: 80px;" onclick="deleteLetter()">
            삭제 <i class="fas fa-trash-alt ml-1" style="font-size: 0.8rem;"></i>
        </button>
    </div>
</div>

<form id="delete-form" action="{{ route('admin.lettermag.destroy', $letter->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function deleteLetter() {
    if (confirm("삭제하시면 데이터를 되돌릴 수 없습니다. 정말 삭제하시겠습니까?")) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endsection
