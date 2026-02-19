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
        <div style="font-size: 1.5rem; font-weight: 700; color: #000;">• 공지사항 관리</div>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-3">
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
                            <th class="table-header-custom">제목 <span class="text-danger ml-1">*</span></th>
                            <td class="table-cell-custom font-weight-bold">{{ $notice->title }}</td>
                        </tr>
                        <tr>
                            <th class="table-header-custom">작성자 <span class="text-danger ml-1">*</span></th>
                            <td class="table-cell-custom">{{ $notice->author->name }}</td>
                        </tr>
                        <tr>
                            <th class="table-header-custom">등록일</th>
                            <td class="table-cell-custom text-secondary">{{ $notice->created_at->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <th class="table-header-custom">조회수</th>
                            <td class="table-cell-custom text-secondary">{{ number_format($notice->view_count) }}</td>
                        </tr>
                        <tr>
                            <th class="table-header-custom">내용 <span class="text-danger ml-1">*</span></th>
                            <td class="table-cell-custom">
                                <div class="content-area py-2" style="min-height: 300px; line-height: 1.6;">
                                    {!! $notice->content !!}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-header-custom">첨부파일</th>
                            <td class="table-cell-custom">
                                @forelse($notice->attachments as $attachment)
                                    <div class="mb-2">
                                        <a href="{{ route('admin.notice.download', $attachment->id) }}" class="text-dark mr-2" style="text-decoration: underline;">
                                            {{ $attachment->original_name }}
                                        </a>
                                    </div>
                                @empty
                                    <span class="text-secondary" style="font-size: 0.9rem;">첨부된 파일이 없습니다.</span>
                                @endforelse
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end align-items-center mt-4 mb-5">
        <a href="{{ route('HNA_Customer_Noticelist_001') }}" class="btn btn-sm btn-outline-custom px-4 py-2 mr-2" style="min-width: 80px;">목록</a>
        <button type="button" class="btn btn-sm btn-outline-custom px-4 py-2 mr-2" style="min-width: 80px;" onclick="if(confirm('삭제하시면 데이터를 되돌릴 수 없습니다. 정말 삭제하시겠습니까?')) document.getElementById('delete-form').submit();">
            삭제 <i class="fas fa-trash-alt ml-1" style="font-size: 0.8rem;"></i>
        </button>
        <a href="{{ route('HNA_Customer_Noticemodi_001', $notice->id) }}" class="btn btn-sm text-white px-4 py-2" style="background-color: #5d401a; border: 1px solid #5d401a; min-width: 80px; font-weight: 500;">수정</a>
    </div>
</div>

<form id="delete-form" action="{{ route('admin.notice.destroy', $notice->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection
