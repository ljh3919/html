@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">관리자사이트 > 고객센터 > 1:1 상담 관리 > 목록</h1>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <span class="mr-3">총 등록 수 : <strong>{{ number_format($totalCount) }}</strong></span>
        </div>
        <div class="col-md-6">
            <form action="{{ route('HNA_Customer_Councellist_001') }}" method="GET" class="form-inline justify-content-end">
                <select name="search_type" class="form-control mr-2">
                    <option value="title_content" {{ $searchType == 'title_content' ? 'selected' : '' }}>제목+내용</option>
                    <option value="author" {{ $searchType == 'author' ? 'selected' : '' }}>작성자</option>
                </select>
                <input type="text" name="search_keyword" class="form-control mr-2" value="{{ $searchKeyword }}" placeholder="검색어를 입력하세요">
                <button type="submit" class="btn btn-dark">검색</button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th>제목</th>
                            <th class="text-center" style="width: 120px;">상태</th>
                            <th class="text-center" style="width: 120px;">작성자 ID</th>
                            <th class="text-center" style="width: 120px;">등록일</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inquiries as $inquiry)
                            <tr onclick="location.href='{{ route('HNA_Customer_Councelview_001', $inquiry->id) }}'" style="cursor: pointer;">
                                <td class="text-center">{{ $inquiries->firstItem() + $loop->index }}</td>
                                <td>{{ $inquiry->title }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $inquiry->status == '답변완료' ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $inquiry->status }}
                                    </span>
                                </td>
                                <td class="text-center">{{ $inquiry->username }}</td>
                                <td class="text-center">{{ $inquiry->created_at->format('Y.m.d') }}</td>
                            </tr>
                            @if($inquiry->status == '답변완료' && $inquiry->reply)
                                <tr onclick="location.href='{{ route('HNA_Customer_Councelview_001', $inquiry->id) }}'" style="cursor: pointer; background-color: #f8f9fc;">
                                    <td class="text-center border-top-0"></td>
                                    <td class="border-top-0">
                                        <span class="text-primary mr-2">﹄[Re] :</span> {{ $inquiry->reply->title }}
                                    </td>
                                    <td class="text-center border-top-0"></td>
                                    <td class="text-center border-top-0 text-muted">관리자</td>
                                    <td class="text-center border-top-0 text-muted">{{ $inquiry->reply->created_at->format('Y.m.d') }}</td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">검색결과가 없습니다.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $inquiries->appends(request()->input())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
