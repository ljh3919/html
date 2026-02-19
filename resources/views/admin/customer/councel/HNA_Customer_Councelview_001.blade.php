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
    .reply-header-custom {
        background-color: #fcf9f6;
        font-weight: 500;
        color: #5d401a;
        vertical-align: middle !important;
        padding-left: 20px !important;
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
        <div style="font-size: 1.5rem; font-weight: 700; color: #000;">• 1:1 상담 관리</div>
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
                            <td class="table-cell-custom font-weight-bold">{{ $inquiry->title }}</td>
                        </tr>
                        <tr>
                            <th class="table-header-custom">작성자 ID <span class="text-danger ml-1">*</span></th>
                            <td class="table-cell-custom">{{ $inquiry->username }}</td>
                        </tr>
                        <tr>
                            <th class="table-header-custom">이메일 <span class="text-danger ml-1">*</span></th>
                            <td class="table-cell-custom">{{ $inquiry->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="table-header-custom">작성일</th>
                            <td class="table-cell-custom text-secondary">{{ $inquiry->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="table-header-custom">문의 내용 <span class="text-danger ml-1">*</span></th>
                            <td class="table-cell-custom">
                                <div class="content-area py-2" style="min-height: 150px; line-height: 1.6;">
                                    {!! nl2br(e($inquiry->content)) !!}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($inquiry->reply)
    <div class="card border-0 mb-4" style="border-top: 2px solid #5d401a !important;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <colgroup>
                        <col style="width: 180px;">
                        <col>
                    </colgroup>
                    <tbody>
                        <tr>
                            <th class="reply-header-custom">답변 제목 <span class="text-danger ml-1">*</span></th>
                            <td class="table-cell-custom font-weight-bold" style="color: #5d401a;">{{ $inquiry->reply->title }}</td>
                        </tr>
                        <tr>
                            <th class="reply-header-custom">답변일</th>
                            <td class="table-cell-custom text-secondary">{{ $inquiry->reply->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="reply-header-custom">답변 내용 <span class="text-danger ml-1">*</span></th>
                            <td class="table-cell-custom">
                                <div class="reply-area py-2" style="min-height: 150px; line-height: 1.6;">
                                    {!! $inquiry->reply->content !!}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="reply-header-custom">첨부파일</th>
                            <td class="table-cell-custom">
                                @forelse($inquiry->reply->attachments as $attachment)
                                    <div class="mb-1">
                                        <a href="{{ route('admin.inquiry.download', $attachment->id) }}" class="text-dark" style="text-decoration: underline;">
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
    @endif

    <div class="d-flex justify-content-end align-items-center mt-4 mb-5">
        <a href="{{ route('HNA_Customer_Councellist_001') }}" class="btn btn-sm btn-outline-custom px-4 py-2 mr-2" style="min-width: 80px;">목록</a>
        <button type="button" class="btn btn-sm btn-outline-custom px-4 py-2 mr-2" style="min-width: 80px;" onclick="if(confirm('삭제하시면 데이터를 되돌릴 수 없습니다. 정말 삭제하시겠습니까?')) document.getElementById('delete-form').submit();">
            삭제 <i class="fas fa-trash-alt ml-1" style="font-size: 0.8rem;"></i>
        </button>
        @if($inquiry->status == '미답변')
            <a href="{{ route('HNA_Customer_Replyrigo_001', $inquiry->id) }}" class="btn btn-sm text-white px-4 py-2" style="background-color: #5d401a; border: 1px solid #5d401a; min-width: 80px; font-weight: 500;">답변 등록</a>
        @else
            <a href="{{ route('HNA_Customer_Replymodi_001', $inquiry->id) }}" class="btn btn-sm text-white px-4 py-2" style="background-color: #5d401a; border: 1px solid #5d401a; min-width: 80px; font-weight: 500;">답변 수정</a>
        @endif
    </div>
</div>

<form id="delete-form" action="{{ route('admin.inquiry.destroy', $inquiry->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection
