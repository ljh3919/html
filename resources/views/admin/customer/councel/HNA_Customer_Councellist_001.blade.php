@extends('layouts.admin')

@section('content')
<!-- title -->
<div class="wrap-tit">
    <h2 class="tit01">1:1 상담 관리</h2>
</div>

<div class="wrap-table-control">
    <div class="wrap-table-control-left"></div>
    <form action="{{ route('HNA_Customer_Councellist_001') }}" method="GET">
        <div class="wrap-table-control-right">
            <div class="input-group h40">
                <div class="select-wrapper">
                    <select name="search_type" class="input-box select" style="width: 160px">
                        <option value="">선택하세요</option>
                        <option value="title" {{ $searchType == 'title' ? 'selected' : '' }}>제목</option>
                        <option value="content" {{ $searchType == 'content' ? 'selected' : '' }}>내용</option>
                        <option value="author" {{ $searchType == 'author' ? 'selected' : '' }}>작성자</option>
                    </select>
                </div>
            </div>
            <div class="wrap-form mx-8">
                <div class="input-group h40">
                    <input type="text" name="search_keyword" class="input-box" style="width: 325px" value="{{ $searchKeyword }}" placeholder="검색어를 입력하세요" />
                </div>
            </div>
            <button type="submit" class="btn primary small">
                <span>검색</span>
            </button>
        </div>
    </form>
</div>

<!-- table -->
<table class="table board-table">
    <thead>
        <tr>
            <th scope="col" style="width: 60px">No</th>
            <th scope="col" style="width: 50%" class="ellipsis tal">제목</th>
            <th scope="col" style="width: calc((100% - 60px) / 2)">상태</th>
            <th scope="col" style="width: calc((100% - 60px) / 2)">작성자 ID</th>
            <th scope="col" style="width: calc((100% - 60px) / 2)">등록일</th>
        </tr>
    </thead>
    <tbody>
        @forelse($inquiries as $inquiry)
        @php
            $hasReply = ($inquiry->status == '답변완료' && $inquiry->reply);
        @endphp
        <tr class="inquiry-row" data-id="{{ $inquiry->id }}" style="cursor: pointer;">
            <td style="width: 60px" {!! $hasReply ? 'rowspan="2"' : '' !!}>{{ $inquiries->total() - ($inquiries->currentPage() - 1) * $inquiries->perPage() - $loop->index }}</td>
            <td style="width: 33%" class="text-left ellipsis tal">
                {{ $inquiry->title }}
            </td>
            <td style="width: calc((100% - 60px) / 2)" class="{{ $inquiry->status == '답변완료' ? 'done' : '' }}">
                {{ $inquiry->status }}
            </td>
            <td style="width: calc((100% - 60px) / 2)" class="text-center">{{ $inquiry->username }}</td>
            <td style="width: calc((100% - 60px) / 2)" class="text-secondary text-center">{{ $inquiry->created_at->format('Y-m-d') }}</td>
        </tr>
        @if($hasReply)
        <tr class="inquiry-row" data-id="{{ $inquiry->id }}" style="cursor: pointer;">
            <td style="width: 33%" class="text-left ellipsis tal reply">
                <span>ㄴ [Re] : {{ $inquiry->reply->title }}</span>
            </td>
            <td style="width: calc((100% - 60px) / 2)" class="done"></td>
            <td style="width: calc((100% - 60px) / 2)" class="text-center text-secondary">관리자</td>
            <td style="width: calc((100% - 60px) / 2)" class="text-secondary text-center">{{ $inquiry->reply->created_at->format('Y-m-d') }}</td>
        </tr>
        @endif
        @empty
        <tr>
            <td colspan="5" class="text-center py-5">검색결과가 없습니다.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="wrap-board-btn" style="min-height: 30px;">
    <div class="wrap-btn-left"></div>
    <div class="wrap-btn-right"></div>
</div>

<!-- pager -->
{{ $inquiries->appends(request()->input())->links('admin.partials.pagination') }}

<form id="delete-form" style="display: none;">
    @csrf
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inquiryRows = document.querySelectorAll('.inquiry-row');

    // 행 클릭 시 상세 페이지 이동
    inquiryRows.forEach(row => {
        row.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            location.href = "{{ route('HNA_Customer_Councelview_001', ':id') }}".replace(':id', id);
        });
    });
});
</script>
@endsection
