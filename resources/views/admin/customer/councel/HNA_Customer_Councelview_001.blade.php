@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">관리자사이트 > 고객센터 > 1:1 상담 관리 > 상세</h1>
        <div>
            @if($inquiry->status == '미답변')
                <a href="{{ route('HNA_Customer_Replyrigo_001', $inquiry->id) }}" class="btn btn-primary">답변</a>
            @else
                <a href="{{ route('HNA_Customer_Replymodi_001', $inquiry->id) }}" class="btn btn-primary">답변수정</a>
            @endif
            <button type="button" class="btn btn-danger" onclick="if(confirm('삭제하시면 데이터를 되돌릴 수 없습니다. 정말 삭제하시겠습니까?')) document.getElementById('delete-form').submit();">삭제</button>
            <a href="{{ route('HNA_Customer_Councellist_001') }}" class="btn btn-secondary">목록</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- 문의글 영역 -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-light">
            <h6 class="m-0 font-weight-bold text-primary">고객 문의 내용</h6>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <colgroup>
                    <col style="width: 150px; background-color: #f8f9fc;">
                    <col>
                </colgroup>
                <tbody>
                    <tr>
                        <th class="py-3 px-4">제목</th>
                        <td class="py-3 px-4 font-weight-bold">{{ $inquiry->title }}</td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4">작성자 ID</th>
                        <td class="py-3 px-4">{{ $inquiry->username }}</td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4">E-Mail</th>
                        <td class="py-3 px-4">{{ $inquiry->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4">작성일</th>
                        <td class="py-3 px-4">{{ $inquiry->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4 align-middle">내용</th>
                        <td class="py-4 px-4">
                            <div class="content-area" style="min-height: 100px;">
                                {!! nl2br(e($inquiry->content)) !!}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- 답변 영역 -->
    @if($inquiry->reply)
    <div class="card shadow mb-4 border-left-success">
        <div class="card-header py-3 bg-white d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">관리자 답변</h6>
            <span class="text-muted small">답변일: {{ $inquiry->reply->created_at->format('Y.m.d H:i') }}</span>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <colgroup>
                    <col style="width: 150px; background-color: #f8f9fc;">
                    <col>
                </colgroup>
                <tbody>
                    <tr>
                        <th class="py-3 px-4">답변 제목</th>
                        <td class="py-3 px-4 font-weight-bold text-success">{{ $inquiry->reply->title }}</td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4 align-middle">답변 내용</th>
                        <td class="py-4 px-4">
                            <div class="reply-area" style="min-height: 100px;">
                                {!! nl2br(e($inquiry->reply->content)) !!}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4 align-middle">첨부파일</th>
                        <td class="py-3 px-4">
                            @forelse($inquiry->reply->attachments as $attachment)
                                <div class="mb-1">
                                    <a href="{{ route('admin.inquiry.download', $attachment->id) }}" class="text-primary">
                                        <i class="fas fa-paperclip mr-1"></i> {{ $attachment->original_name }}
                                    </a>
                                </div>
                            @empty
                                <span class="text-muted">첨부파일 없음</span>
                            @endforelse
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

<form id="delete-form" action="{{ route('admin.inquiry.destroy', $inquiry->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection
