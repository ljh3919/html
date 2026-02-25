@extends('layouts.admin')

@section('content')
<!-- title -->
<div class="wrap-tit">
    <h2 class="tit01">1:1 상담 관리</h2>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- inquiry table -->
<table class="table board-table vertical-table">
    <tr>
        <th>제목</th>
        <td class="font-weight-bold">{{ $inquiry->title }}</td>
    </tr>
    <tr>
        <th>내용</th>
        <td>
            <div style="white-space: pre-wrap; line-height: 1.6;">{!! nl2br(e($inquiry->content)) !!}</div>
        </td>
    </tr>
    <tr>
        <th>작성자 ID</th>
        <td>{{ $inquiry->username }}</td>
    </tr>
    <tr>
        <th>E-Mail</th>
        <td>{{ $inquiry->email ?? '-' }}</td>
    </tr>
    <tr>
        <th>작성일</th>
        <td class="text-secondary">{{ $inquiry->created_at->format('Y-m-d H:i') }}</td>
    </tr>
</table>

@if($inquiry->reply)
    <h3 class="tit3">답변</h3>
    <!-- reply table -->
    <table class="table board-table vertical-table">
        <tr>
            <th>제목</th>
            <td class="font-weight-bold text-primary">{{ $inquiry->reply->title }}</td>
        </tr>
        <tr>
            <th>답변 내용</th>
            <td>
                <div class="reply-content" style="line-height: 1.6;">
                    {!! $inquiry->reply->content !!}
                </div>
            </td>
        </tr>
        <tr>
            <th>첨부파일</th>
            <td>
                @forelse($inquiry->reply->attachments as $attachment)
                    <div class="wrap-file mb-1">
                        <a href="{{ route('admin.inquiry.download', $attachment->id) }}" class="text-dark">
                            {{ $attachment->original_name }}
                        </a>
                    </div>
                @empty
                    <span class="text-secondary">첨부된 파일이 없습니다.</span>
                @endforelse
            </td>
        </tr>
        <tr>
            <th>답변일</th>
            <td class="text-secondary">{{ $inquiry->reply->created_at->format('Y-m-d H:i') }}</td>
        </tr>
    </table>
@endif

<!-- board button -->
<div class="wrap-board-btn">
    <div class="wrap-btn-left"></div>
    <div class="wrap-btn-right">
        <button type="button" class="btn line small" onclick="location.href='{{ route('HNA_Customer_Councellist_001') }}'">
            <span>목록</span>
        </button>
        <button type="button" class="btn line small" onclick="deleteInquiry()">
            <span>삭제</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M19.1119 3.78009H13.7778C13.7778 3.29279 13.3801 2.89844 12.8886 2.89844H11.1113C10.6187 2.89844 10.2221 3.29279 10.2221 3.78009H4.88804C4.39657 3.78009 4 4.17448 4 4.66179C4 5.14795 4.39772 5.54344 4.88804 5.54344H19.1119C19.6034 5.54344 20 5.14795 20 4.66179C20.0011 4.17562 19.6034 3.78009 19.1119 3.78009Z" fill="#4A4A4A" />
                <path d="M17.2722 8.48992L16.4013 17.9696C16.3978 18.0081 16.3956 18.0456 16.3944 18.0852H7.60642C7.60527 18.0467 7.60294 18.0093 7.59951 17.9696L6.72864 8.48992H17.2722ZM17.3351 6.6767H6.6669C5.68626 6.6767 4.88845 7.46547 4.88845 8.43894L5.77768 18.1351C5.77768 19.1074 6.5732 19.8984 7.55612 19.8984H16.4447C17.4265 19.8984 18.2231 19.1086 18.2231 18.1351L19.1123 8.43894C19.1123 7.46547 18.3157 6.6767 17.3351 6.6767Z" fill="#4A4A4A" />
                <path d="M12.0006 17.065C11.6851 17.065 11.4291 16.8111 11.4291 16.4984V10.372C11.4291 10.0592 11.6851 9.80533 12.0006 9.80533C12.316 9.80533 12.572 10.0592 12.572 10.372V16.4984C12.572 16.8111 12.316 17.065 12.0006 17.065Z" fill="#4A4A4A" />
                <path d="M9.51043 17.0645C9.22013 17.0645 8.97096 16.8457 8.94238 16.5533L8.33548 10.4269C8.30576 10.1153 8.53553 9.83766 8.8487 9.80819C9.16186 9.78439 9.44416 10.0054 9.47388 10.317L10.0808 16.4434C10.1105 16.7551 9.88073 17.0327 9.56757 17.0633C9.54814 17.0633 9.52986 17.0645 9.51043 17.0645Z" fill="#4A4A4A" />
                <path d="M14.491 17.0645C14.7813 17.0645 15.0304 16.8457 15.059 16.5533L15.6659 10.4269C15.6956 10.1153 15.4659 9.83766 15.1528 9.80819C14.8396 9.78439 14.5573 10.0054 14.5276 10.317L13.9207 16.4434C13.891 16.7551 14.1207 17.0327 14.4338 17.0633C14.4533 17.0633 14.4727 17.0645 14.491 17.0645Z" fill="#4A4A4A" />
            </svg>
        </button>
        @if($inquiry->status == '미답변')
            <button type="button" class="btn primary small" onclick="location.href='{{ route('HNA_Customer_Replyrigo_001', $inquiry->id) }}'">
                <span>답변</span>
            </button>
        @else
            <button type="button" class="btn primary small" onclick="location.href='{{ route('HNA_Customer_Replymodi_001', $inquiry->id) }}'">
                <span>답변 수정</span>
            </button>
        @endif
    </div>
</div>

<form id="delete-form" action="{{ route('admin.inquiry.destroy', $inquiry->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function deleteInquiry() {
    if (confirm("삭제하시면 데이터를 되돌릴 수 없습니다. 정말 삭제하시겠습니까?")) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endsection
