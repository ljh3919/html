@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">관리자사이트 > 고객센터 > 자료실 > 목록</h1>
        <a href="{{ route('HNA_Customer_Referenrigo_001') }}" class="btn btn-primary">등록</a>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <span class="mr-3">총 등록 수 : <strong>{{ number_format($totalCount) }}</strong></span>
        </div>
        <div class="col-md-6">
            <form action="{{ route('HNA_Customer_Referenlist_001') }}" method="GET" class="form-inline justify-content-end">
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
                            <th class="text-center" style="width: 120px;">작성자</th>
                            <th class="text-center" style="width: 120px;">등록일</th>
                            <th class="text-center" style="width: 80px;">파일</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($references as $reference)
                            <tr onclick="location.href='{{ route('HNA_Customer_Referenview_001', $reference->id) }}'" style="cursor: pointer;">
                                <td class="text-center">{{ $references->firstItem() + $loop->index }}</td>
                                <td>{{ $reference->title }}</td>
                                <td class="text-center">{{ $reference->author->name }}</td>
                                <td class="text-center">{{ $reference->created_at->format('Y-m-d') }}</td>
                                <td class="text-center">
                                    @if($reference->attachments->count() > 0)
                                        <i class="fas fa-file-download text-primary"></i>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">검색결과가 없습니다.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $references->appends(request()->input())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
