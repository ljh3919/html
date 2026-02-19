@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="content-title">팝업 관리</div>

    <div class="row align-items-end mb-3">
        <div class="col-md-6">
            <div style="font-size: 0.9rem; color: #5d401a; font-weight: 500;">
                • 총 등록 수 <strong style="color: #5d401a;">{{ number_format($popups->total()) }}</strong>
            </div>
        </div>
        <div class="col-md-6">
            <form action="{{ route('HNA_Popup_List_001') }}" method="GET" class="d-flex justify-content-end">
                <select name="search_type" class="form-control form-control-sm mr-2" style="width: 120px;">
                    <option value="all" {{ $searchType == 'all' ? 'selected' : '' }}>전체</option>
                    <option value="title" {{ $searchType == 'title' ? 'selected' : '' }}>제목</option>
                    <option value="content" {{ $searchType == 'content' ? 'selected' : '' }}>내용</option>
                </select>
                <input type="text" name="search_keyword" class="form-control form-control-sm mr-2" style="width: 200px;" value="{{ $searchKeyword }}" placeholder="검색어를 입력하세요">
                <button type="submit" class="btn btn-sm text-white px-3" style="background-color: #5d401a;">검색</button>
            </form>
        </div>
    </div>

    <div class="card border-0 mb-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered text-center mb-0" style="font-size: 0.9rem;">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th style="width: 100px;">진행상황</th>
                            <th>제목</th>
                            <th style="width: 160px;">시작일</th>
                            <th style="width: 160px;">종료일</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($popups as $popup)
                            <tr onclick="location.href='{{ route('HNA_Popup_Detail_001', $popup->id) }}'" style="cursor: pointer;">
                                <td>{{ $popups->total() - ($popups->currentPage() - 1) * $popups->perPage() - $loop->index }}</td>
                                <td>
                                    @if($popup->status == '진행중')
                                        <span class="text-danger font-weight-bold">진행중</span>
                                    @elseif($popup->status == '대기중')
                                        <span class="text-success font-weight-bold">대기중</span>
                                    @else
                                        <span class="text-secondary">종료</span>
                                    @endif
                                </td>
                                <td class="text-left px-3">
                                    <div class="text-truncate" style="max-width: 600px;">
                                        {{ $popup->title }}
                                    </div>
                                </td>
                                <td class="text-secondary">{{ $popup->start_at->format('Y-m-d H:i') }}</td>
                                <td class="text-secondary">{{ $popup->end_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-secondary">등록된 팝업이 없습니다.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('HNA_Popup_Regi_001') }}" class="btn btn-sm text-white px-4" style="background-color: #5d401a;">등록</a>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $popups->appends(request()->input())->links('pagination::bootstrap-4') }}
    </div>
</div>

<style>
.pagination .page-item.active .page-link {
    background-color: #5d401a;
    border-color: #5d401a;
    color: #fff;
    font-weight: bold;
}
.pagination .page-link {
    color: #333;
}
</style>
@endsection
