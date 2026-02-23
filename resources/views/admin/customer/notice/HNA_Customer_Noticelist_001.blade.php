@extends('layouts.admin')
 
 @section('styles')
 <style>
     /* 페이지네이션 및 테이블 기본 스타일은 admin-common.css에 정의됨 */
 </style>
 @endsection

@section('content')
<div class="container-fluid">
    <div class="content-title pb-2">공지사항 관리</div>

    <div class="d-flex justify-content-between align-items-end mb-3">
        <div>
            <div style="font-size: 0.9rem; color: #5d401a; font-weight: 500;">
                • 총 등록 수 <strong style="color: #5d401a;">{{ number_format($totalCount) }}</strong>
            </div>
        </div>
        <div>
            <form action="{{ route('HNA_Customer_Noticelist_001') }}" method="GET" class="d-flex">
                <select name="search_type" class="form-control form-control-sm mr-2" style="width: 150px;">
                    <option value="all" {{ $searchType == 'all' ? 'selected' : '' }}>전체</option>
                    <option value="title" {{ $searchType == 'title' ? 'selected' : '' }}>제목</option>
                    <option value="content" {{ $searchType == 'content' ? 'selected' : '' }}>내용</option>
                </select>
                <input type="text" name="search_keyword" class="form-control form-control-sm mr-2" style="width: 200px;" value="{{ $searchKeyword }}" placeholder="검색어를 입력하세요">
                <button type="submit" class="btn btn-sm text-white px-3" style="background-color: #5d401a;">검색</button>
            </form>
        </div>
    </div>

    <div class="card border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered text-center table-admin">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th style="width: 50px;">
                                <input type="checkbox" id="check-all">
                            </th>
                            <th style="width: 80px;">No</th>
                            <th>제목</th>
                            <th style="width: 120px;">작성자</th>
                            <th style="width: 120px;">등록일</th>
                            <th style="width: 100px;">조회수</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notices as $notice)
                            <tr class="notice-row" data-id="{{ $notice->id }}" style="cursor: pointer;">
                                <td onclick="event.stopPropagation();">
                                    <input type="checkbox" name="ids[]" value="{{ $notice->id }}" class="check-item">
                                </td>
                                <td>{{ $notices->total() - ($notices->currentPage() - 1) * $notices->perPage() - $loop->index }}</td>
                                <td class="text-left py-2 px-3">
                                    <div class="text-truncate" style="max-width: 600px;">
                                        {{ $notice->title }}
                                    </div>
                                </td>
                                <td>{{ $notice->author->name }}</td>
                                <td class="text-secondary">{{ $notice->created_at->format('Y-m-d') }}</td>
                                <td class="text-secondary">{{ number_format($notice->view_count) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-secondary">검색결과가 없습니다.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="btn-area-60">
                <button type="button" id="btn-delete" class="btn btn-sm btn-delete-custom px-3" disabled>
                    삭제 <i class="fas fa-trash-alt ml-1"></i>
                </button>
                <a href="{{ route('HNA_Customer_Noticeregi_001') }}" class="btn btn-sm btn-register-custom px-4">등록</a>
            </div>

            <div class="pagination-wrap">
                <a href="{{ $notices->appends(request()->input())->url(1) }}" class="pag-btn {{ $notices->onFirstPage() ? 'disabled' : '' }}">
                    <i class="fas fa-angle-double-left"></i>
                </a>
                <a href="{{ $notices->appends(request()->input())->previousPageUrl() }}" class="pag-btn {{ $notices->onFirstPage() ? 'disabled' : '' }}">
                    <i class="fas fa-angle-left"></i>
                </a>
                
                @foreach(range(1, $notices->lastPage()) as $page)
                    @if($page >= $notices->currentPage() - 2 && $page <= $notices->currentPage() + 2)
                        <a href="{{ $notices->appends(request()->input())->url($page) }}" class="pag-btn {{ $page == $notices->currentPage() ? 'active' : '' }}">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                <a href="{{ $notices->appends(request()->input())->nextPageUrl() }}" class="pag-btn {{ !$notices->hasMorePages() ? 'disabled' : '' }}">
                    <i class="fas fa-angle-right"></i>
                </a>
                <a href="{{ $notices->appends(request()->input())->url($notices->lastPage()) }}" class="pag-btn {{ !$notices->hasMorePages() ? 'disabled' : '' }}">
                    <i class="fas fa-angle-double-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<form id="delete-form" style="display: none;">
    @csrf
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('check-all');
    const checkItems = document.querySelectorAll('.check-item');
    const btnDelete = document.getElementById('btn-delete');
    const noticeRows = document.querySelectorAll('.notice-row');

    // 전체 선택
    if (checkAll) {
        checkAll.addEventListener('change', function() {
            checkItems.forEach(item => {
                item.checked = this.checked;
            });
            toggleDeleteButton();
        });
    }

    // 개별 선택 시 삭제 버튼 상태 변경
    checkItems.forEach(item => {
        item.addEventListener('change', function() {
            const allChecked = Array.from(checkItems).every(i => i.checked);
            if (checkAll) checkAll.checked = allChecked;
            toggleDeleteButton();
        });
    });

    function toggleDeleteButton() {
        const anyChecked = Array.from(checkItems).some(i => i.checked);
        if (btnDelete) btnDelete.disabled = !anyChecked;
    }

    // 삭제 버튼 클릭
    if (btnDelete) {
        btnDelete.addEventListener('click', function() {
            if (confirm("삭제하시면 데이터를 되돌릴 수 없습니다. 정말 삭제하시겠습니까?")) {
                const selectedIds = Array.from(document.querySelectorAll('.check-item:checked')).map(i => i.value);
                
                fetch("{{ route('admin.notice.massDestroy') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({ ids: selectedIds })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('삭제 중 오류가 발생했습니다.');
                    }
                });
            }
        });
    }

    // 행 클릭 시 상세 페이지 이동
    noticeRows.forEach(row => {
        row.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            location.href = "{{ route('HNA_Customer_Noticeview_001', ':id') }}".replace(':id', id);
        });
    });
});
</script>

@endsection
