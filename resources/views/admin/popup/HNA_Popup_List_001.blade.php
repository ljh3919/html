@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">관리자사이트 > 팝업 관리 > 목록</h1>
        <a href="{{ route('HNA_Popup_Regi_001') }}" class="btn btn-primary">등록</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    총 등록 수 : <strong>{{ number_format($totalCount) }}</strong>
                </div>
                <form action="{{ route('HNA_Popup_List_001') }}" method="GET" class="form-inline">
                    <select name="search_type" class="form-control mr-2">
                        <option value="title" {{ $searchType == 'title' ? 'selected' : '' }}>제목</option>
                        <option value="content" {{ $searchType == 'content' ? 'selected' : '' }}>내용</option>
                    </select>
                    <input type="text" name="search_keyword" class="form-control mr-2" value="{{ $searchKeyword }}" placeholder="검색어를 입력하세요">
                    <button type="submit" class="btn btn-dark">검색</button>
                    @if($searchKeyword)
                        <a href="{{ route('HNA_Popup_List_001') }}" class="btn btn-outline-secondary ml-2">초기화</a>
                    @endif
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th class="text-center" style="width: 120px;">진행상황</th>
                            <th>제목</th>
                            <th class="text-center" style="width: 200px;">시작일</th>
                            <th class="text-center" style="width: 200px;">종료일</th>
                            <th class="text-center" style="width: 100px;">노출여부</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($popups as $popup)
                            <tr onclick="location.href='{{ route('HNA_Popup_Detail_001', $popup->id) }}'" style="cursor: pointer;">
                                <td class="text-center">{{ $popups->firstItem() + $loop->index }}</td>
                                <td class="text-center">
                                    @php
                                        $status = $popup->status;
                                        $badgeClass = 'badge-secondary';
                                        if ($status == '진행중') $badgeClass = 'badge-success';
                                        elseif ($status == '사용대기') $badgeClass = 'badge-primary';
                                        elseif ($status == '종료') $badgeClass = 'badge-danger';
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                                </td>
                                <td>{{ $popup->title }}</td>
                                <td class="text-center">{{ $popup->start_at->format('Y-m-d H:i') }}</td>
                                <td class="text-center">{{ $popup->end_at->format('Y-m-d H:i') }}</td>
                                <td class="text-center">
                                    <span class="text-{{ $popup->is_visible ? 'primary' : 'danger' }}">
                                        {{ $popup->is_visible ? 'O' : 'X' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">등록된 팝업이 없습니다.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $popups->appends(request()->input())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
