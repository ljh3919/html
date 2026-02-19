@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="font-weight-bold">나의 상담 상세</h2>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
            <h4 class="font-weight-bold">{{ $inquiry->title }}</h4>
            <div class="text-muted small">
                <span>작성자: {{ $inquiry->username }}</span> | 
                <span>등록일: {{ $inquiry->created_at->format('Y.m.d') }}</span> |
                <span>E-Mail: {{ $inquiry->email }}</span>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="p-3 bg-light rounded mb-4" style="min-height: 200px; white-space: pre-wrap;">{{ $inquiry->content }}</div>

            @if($inquiry->status === '답변완료' && $inquiry->reply)
            <div class="border-top pt-4">
                <div class="d-flex align-items-center mb-3">
                    <span class="badge badge-success mr-2">답변</span>
                    <h5 class="m-0 font-weight-bold">관리자 답변입니다.</h5>
                    <span class="ml-auto text-muted small">{{ $inquiry->reply->created_at->format('Y.m.d') }}</span>
                </div>
                <div class="p-3 border rounded bg-white mb-3" style="min-height: 150px; white-space: pre-wrap;">{{ $inquiry->reply->content }}</div>
                
                @if($inquiry->reply->attachments->count() > 0)
                <div class="small">
                    <strong>첨부파일:</strong>
                    @foreach($inquiry->reply->attachments as $file)
                    <a href="{{ route('admin.inquiry.download', $file->id) }}" class="text-primary ml-2">
                        <i class="fas fa-file-download mr-1"></i>{{ $file->original_name }}
                    </a>
                    @endforeach
                </div>
                @endif
            </div>
            @endif

            <div class="text-center mt-5">
                <a href="{{ route('HN_Customer_Councellist_001') }}" class="btn btn-outline-dark px-4 mr-2">목록</a>
                @if($inquiry->status !== '답변완료')
                <a href="{{ route('HN_Customer_Councelmodi_001', $inquiry->id) }}" class="btn btn-dark px-4 mr-2">수정</a>
                <form action="{{ route('front.inquiry.destroy', $inquiry->id) }}" method="POST" class="d-inline" onsubmit="return confirm('삭제하시면 되돌릴 수 없습니다. 정말 삭제하시겠습니까?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">삭제</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
