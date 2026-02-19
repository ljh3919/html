@extends('layouts.publishing_blank')

@section('content')
<div class="container-fluid">
    <div class="content-title">자료실 관리</div>

    <div class="row align-items-end mb-3">
        <div class="col-md-6">
            <div style="font-size: 0.9rem; color: #5d401a; font-weight: 500;">
                • 총 등록 수 <strong style="color: #5d401a;">{{ number_format($references->total()) }}</strong>
            </div>
        </div>
        <div class="col-md-6">
            <form action="{{ route('HNA_Customer_Referenlist_001') }}" method="GET" class="d-flex justify-content-end">
                <select name="search_type" class="form-control form-control-sm mr-2" style="width: 120px;">
                    <option value="all" {{ ($searchType == 'all' || $searchType == 'title_content') ? 'selected' : '' }}>전체</option>
                    <option value="title" {{ $searchType == 'title' ? 'selected' : '' }}>제목</option>
                    <option value="content" {{ $searchType == 'content' ? 'selected' : '' }}>내용</option>
                    <option value="author" {{ $searchType == 'author' ? 'selected' : '' }}>작성자</option>
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
                            <th>제목</th>
                            <th style="width: 120px;">작성자</th>
                            <th style="width: 120px;">등록일</th>
                            <th style="width: 80px;">파일</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($references as $reference)
                            <tr onclick="location.href='{{ route('HNA_Customer_Referenview_001', $reference->id) }}'" style="cursor: pointer;">
                                <td>{{ $references->total() - ($references->currentPage() - 1) * $references->perPage() - $loop->index }}</td>
                                <td class="text-left px-3">
                                    <div class="text-truncate" style="max-width: 700px;">
                                        {{ $reference->title }}
                                    </div>
                                </td>
                                <td>{{ $reference->author->name }}</td>
                                <td class="text-secondary">{{ $reference->created_at->format('Y-m-d') }}</td>
                                <td>
                                    @if($reference->attachments->count() > 0)
                                        <i class="far fa-file-alt" style="font-size: 1.1rem; color: #5d401a;"></i>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-secondary">검색결과가 없습니다.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('HNA_Customer_Referenrigo_001') }}" class="btn btn-sm text-white px-4" style="background-color: #5d401a;">등록</a>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $references->appends(request()->input())->links('pagination::bootstrap-4') }}
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
