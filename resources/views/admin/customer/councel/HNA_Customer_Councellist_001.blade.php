@extends('layouts.admin')
 
 @section('styles')
 <style>
     /* 페이지네이션 및 테이블 기본 스타일은 admin-common.css에 정의됨 */
 </style>
 @endsection

@section('content')
<div class="container-fluid">
    <div class="content-title">1:1 상담 관리</div>

    <div class="d-flex justify-content-between align-items-end mb-3">
        <div>
            <div style="font-size: 0.9rem; color: #5d401a; font-weight: 500;">
                • 총 등록 수 <strong style="color: #5d401a;">{{ number_format($totalCount) }}</strong>
            </div>
        </div>
        <div>
            <form action="{{ route('HNA_Customer_Councellist_001') }}" method="GET" class="d-flex">
                <select name="search_type" class="form-control form-control-sm mr-2" style="width: 100px;">
                    <option value="title" {{ $searchType == 'title' ? 'selected' : '' }}>제목</option>
                    <option value="content" {{ $searchType == 'content' ? 'selected' : '' }}>내용</option>
                    <option value="author" {{ $searchType == 'author' ? 'selected' : '' }}>작성자</option>
                </select>
                <div class="input-group">
                    <input type="text" name="search_keyword" class="form-control form-control-sm" value="{{ $searchKeyword }}" placeholder="검색어를 입력하세요">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-sm btn-secondary">검색</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered text-center table-admin">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 50px;">
                                <input type="checkbox" id="check-all">
                            </th>
                            <th style="width: 60px;">No</th>
                            <th>제목</th>
                            <th style="width: 100px;">상태</th>
                            <th style="width: 120px;">작성자 ID</th>
                            <th style="width: 120px;">등록일</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inquiries as $inquiry)
                            <tr class="inquiry-row" data-id="{{ $inquiry->id }}" style="cursor: pointer;">
                                <td onclick="event.stopPropagation();">
                                    <input type="checkbox" name="ids[]" value="{{ $inquiry->id }}" class="check-item">
                                </td>
                                <td>{{ $inquiries->total() - ($inquiries->currentPage() - 1) * $inquiries->perPage() - $loop->index }}</td>
                                <td class="text-left">
                                    <div class="text-truncate" style="max-width: 600px;">
                                        {{ $inquiry->title }}
                                    </div>
                                </td>
                                <td>
                                    @if($inquiry->status == '답변완료')
                                        <span class="badge badge-success">답변완료</span>
                                    @else
                                        <span class="badge badge-secondary">미답변</span>
                                    @endif
                                </td>
                                <td>{{ $inquiry->username }}</td>
                                <td>{{ $inquiry->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @if($inquiry->status == '답변완료' && $inquiry->reply)
                                <tr class="inquiry-row" data-id="{{ $inquiry->id }}" style="cursor: pointer; background-color: #f8f9fa;">
                                    <td class="border-top-0"></td>
                                    <td class="border-top-0"></td>
                                    <td class="text-left border-top-0 pl-4">
                                        <span class="text-danger mr-1">↳ [Re]</span>
                                        {{ $inquiry->reply->title }}
                                    </td>
                                    <td class="border-top-0"></td>
                                    <td class="border-top-0 small text-muted">관리자</td>
                                    <td class="border-top-0 small text-muted">{{ $inquiry->reply->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                            <tr>
                                <td colspan="6" class="py-5 text-muted">검색결과가 없습니다.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="btn-area-60">
                <button type="button" id="btn-delete" class="btn btn-sm btn-delete-custom px-3" disabled>
                    삭제 <i class="fas fa-trash-alt ml-1"></i>
                </button>
            </div>

            <div class="pagination-wrap">
                <a href="{{ $inquiries->appends(request()->input())->url(1) }}" class="pag-btn {{ $inquiries->onFirstPage() ? 'disabled' : '' }}">
                    <i class="fas fa-angle-double-left"></i>
                </a>
                <a href="{{ $inquiries->appends(request()->input())->previousPageUrl() }}" class="pag-btn {{ $inquiries->onFirstPage() ? 'disabled' : '' }}">
                    <i class="fas fa-angle-left"></i>
                </a>
                
                @foreach(range(1, $inquiries->lastPage()) as $page)
                    @if($page >= $inquiries->currentPage() - 2 && $page <= $inquiries->currentPage() + 2)
                        <a href="{{ $inquiries->appends(request()->input())->url($page) }}" class="pag-btn {{ $page == $inquiries->currentPage() ? 'active' : '' }}">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                <a href="{{ $inquiries->appends(request()->input())->nextPageUrl() }}" class="pag-btn {{ !$inquiries->hasMorePages() ? 'disabled' : '' }}">
                    <i class="fas fa-angle-right"></i>
                </a>
                <a href="{{ $inquiries->appends(request()->input())->url($inquiries->lastPage()) }}" class="pag-btn {{ !$inquiries->hasMorePages() ? 'disabled' : '' }}">
                    <i class="fas fa-angle-double-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
