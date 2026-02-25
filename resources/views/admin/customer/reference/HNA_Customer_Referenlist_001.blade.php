@extends('layouts.admin')
 
 @section('styles')
 <style>
     /* 페이지네이션 및 테이블 기본 스타일은 admin-common.css에 정의됨 */
 </style>
 @endsection

@section('content')
<!-- title -->
<div class="wrap-tit">
    <h2 class="tit01">자료실</h2>
</div>

<div class="wrap-table-control">
    <div class="wrap-table-control-left"></div>
    <div class="wrap-table-control-right">
        <form action="{{ route('HNA_Customer_Referenlist_001') }}" method="GET" style="display: flex; align-items: center; gap: 8px;">
            <div class="input-group h40">
                <div class="select-wrapper">
                    <select name="search_type" class="input-box select" style="width: 160px;">
                        <option value="">선택하세요</option>
                        <option value="all" {{ ($searchType == 'all' || $searchType == 'title_content') ? 'selected' : '' }}>전체</option>
                        <option value="title" {{ $searchType == 'title' ? 'selected' : '' }}>제목</option>
                        <option value="content" {{ $searchType == 'content' ? 'selected' : '' }}>내용</option>
                        <option value="author" {{ $searchType == 'author' ? 'selected' : '' }}>작성자</option>
                    </select>
                </div>
            </div>
            <div class="wrap-form mx-8">
                <div class="input-group h40">
                    <input type="text" name="search_keyword" class="input-box" style="width: 325px;" value="{{ $searchKeyword }}" placeholder="검색어를 입력하세요">
                </div>
            </div>
            <button type="submit" class="btn primary small">
                <span>검색</span>
            </button>
        </form>
    </div>
</div>

<!-- table -->
<table class="table board-table">
    <thead>
        <tr>
            <th scope="col" style="width: 50px;">
                <input type="checkbox" id="check-all">
            </th>
            <th scope="col" style="width: 60px;">No</th>
            <th scope="col" style="width: 50%" class="ellipsis tal">제목</th>
            <th scope="col" style="width: calc((100% - 170px) / 2)">작성자</th>
            <th scope="col" style="width: calc((100% - 170px) / 2)">등록일</th>
            <th scope="col" style="width: 60px;">파일</th>
        </tr>
    </thead>
    <tbody>
        @forelse($references as $reference)
            <tr class="reference-row" data-id="{{ $reference->id }}" style="cursor: pointer;">
                <td onclick="event.stopPropagation();">
                    <input type="checkbox" name="ids[]" value="{{ $reference->id }}" class="check-item">
                </td>
                <td>{{ $references->total() - ($references->currentPage() - 1) * $references->perPage() - $loop->index }}</td>
                <td class="tal ellipsis">
                    {{ $reference->title }}
                </td>
                <td>{{ $reference->author->name }}</td>
                <td>{{ $reference->created_at->format('Y-m-d') }}</td>
                <td>
                    @if($reference->attachments->count() > 0)
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#161616" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14 2V8H20" stroke="#161616" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16 13H8" stroke="#161616" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16 17H8" stroke="#161616" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M10 9H9H8" stroke="#161616" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center py-5 text-secondary">검색결과가 없습니다.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="wrap-board-btn h30 mt-3">
    <div class="wrap-btn-left">
        <button type="button" id="btn-delete" class="btn line small" disabled>
            <span>삭제</span>
        </button>
    </div>
    <div class="wrap-btn-right">
        <button type="button" class="btn primary small" onclick="location.href='{{ route('HNA_Customer_Referenrigo_001') }}'">
            <span>등록</span>
        </button>
    </div>
</div>

<!-- pager -->
{{ $references->appends(request()->input())->links('admin.partials.pagination') }}

<script>
document.addEventListener('DOMContentLoaded', function() {
    const referenceRows = document.querySelectorAll('.reference-row');
    const checkAll = document.getElementById('check-all');
    const checkItems = document.querySelectorAll('.check-item');
    const btnDelete = document.getElementById('btn-delete');

    // 행 클릭 시 상세 페이지 이동
    referenceRows.forEach(row => {
        row.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            location.href = "{{ route('HNA_Customer_Referenview_001', ':id') }}".replace(':id', id);
        });
    });

    // 전체 선택
    if (checkAll) {
        checkAll.addEventListener('change', function() {
            checkItems.forEach(item => {
                item.checked = this.checked;
            });
            updateDeleteButton();
        });
    }

    // 개별 선택
    checkItems.forEach(item => {
        item.addEventListener('change', function() {
            updateDeleteButton();
        });
    });

    function updateDeleteButton() {
        const checkedCount = document.querySelectorAll('.check-item:checked').length;
        if (btnDelete) {
            btnDelete.disabled = checkedCount === 0;
        }
    }

    // 선택 삭제 처리
    if (btnDelete) {
        btnDelete.addEventListener('click', function() {
            if (confirm('선택한 항목을 삭제하시겠습니까?')) {
                const ids = Array.from(document.querySelectorAll('.check-item:checked')).map(item => item.value);
                // 삭제 API 호출 로직 (생략 - 필요 시 구현)
            }
        });
    }
});
</script>
@endsection
