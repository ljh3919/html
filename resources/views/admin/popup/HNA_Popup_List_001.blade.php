@extends('layouts.admin')
 
 @section('styles')
 <style>
     /* 페이지네이션 및 테이블 기본 스타일은 admin-common.css에 정의됨 */
 </style>
 @endsection

@section('content')
<!-- title -->
<div class="wrap-tit">
    <h2 class="tit01">팝업 관리</h2>
</div>

<div class="wrap-table-control">
    <div class="wrap-table-control-left"></div>
    <form action="{{ route('HNA_Popup_List_001') }}" method="GET">
        <div class="wrap-table-control-right">
            <div class="input-group h40">
                <div class="select-wrapper">
                    <select name="search_type" class="input-box select" style="width: 160px">
                        <option value="all" {{ $searchType == 'all' ? 'selected' : '' }}>전체</option>
                        <option value="title" {{ $searchType == 'title' ? 'selected' : '' }}>제목</option>
                        <option value="content" {{ $searchType == 'content' ? 'selected' : '' }}>내용</option>
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
            <th scope="col" style="width: 150px" class="ellipsis">진행상황</th>
            <th scope="col" style="width: 50%" class="ellipsis">제목</th>
            <th scope="col" style="width: calc((100% - 60px) / 2)">시작일</th>
            <th scope="col" style="width: calc((100% - 60px) / 2)">종료일</th>
        </tr>
    </thead>
    <tbody>
        @forelse($popups as $popup)
            <tr onclick="location.href='{{ route('HNA_Popup_Detail_001', $popup->id) }}'" style="cursor: pointer;">
                <td style="width: 60px">{{ $popups->total() - ($popups->currentPage() - 1) * $popups->perPage() - $loop->index }}</td>
                <td style="width: 150px">
                    @if($popup->status == '진행중')
                        <span class="text-danger font-weight-bold">진행중</span>
                    @elseif($popup->status == '대기중' || $popup->status == '사용대기')
                        <span class="text-success font-weight-bold">사용대기</span>
                    @else
                        <span class="text-secondary">종료</span>
                    @endif
                </td>
                    <td style="width: 33%" class="ellipsis tal">
                    {{ $popup->title }}
                </td>
                    <td style="width: calc((100% - 60px) / 2)">
                    {{ $popup->start_at->format('Y-m-d H:i') }}
                </td>
                    <td style="width: calc((100% - 60px) / 2)">
                    {{ $popup->end_at->format('Y-m-d H:i') }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="py-5 text-secondary text-center">등록된 팝업이 없습니다.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- board button -->
<div class="wrap-board-btn">
    <div class="wrap-btn-left"></div>
    <div class="wrap-btn-right">
        <button type="button" class="btn primary small" onclick="location.href = '{{ route('HNA_Popup_Regi_001') }}'">
            <span>등록</span>
        </button>
    </div>
</div>

<!-- pager -->
{{ $popups->appends(request()->input())->links('admin.partials.pagination') }}
@endsection
