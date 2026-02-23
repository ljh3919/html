@extends('layouts.admin')
 
 @section('styles')
 <style>
     /* 페이지네이션 및 테이블 기본 스타일은 admin-common.css에 정의됨 */
 </style>
 @endsection

@section('content')
<div class="container-fluid">
    <div class="content-title">브로슈어 신청 관리</div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-end mb-3">
        <div class="d-flex border-0 shadow-none">
            <a href="{{ route('HNA_Brochure_Applicationlist_001', ['status_filter' => '전체']) }}" 
               class="btn btn-sm mr-2 {{ $statusFilter == '전체' ? 'text-white' : 'btn-outline-secondary' }}"
               style="{{ $statusFilter == '전체' ? 'background-color: #5d401a;' : '' }}">전체</a>
            <a href="{{ route('HNA_Brochure_Applicationlist_001', ['status_filter' => '발송완료']) }}" 
               class="btn btn-sm mr-2 {{ $statusFilter == '발송완료' ? 'text-white' : 'btn-outline-secondary' }}"
               style="{{ $statusFilter == '발송완료' ? 'background-color: #5d401a;' : '' }}">발송완료</a>
            <a href="{{ route('HNA_Brochure_Applicationlist_001', ['status_filter' => '미발송']) }}" 
               class="btn btn-sm {{ $statusFilter == '미발송' ? 'text-white' : 'btn-outline-secondary' }}"
               style="{{ $statusFilter == '미발송' ? 'background-color: #5d401a;' : '' }}">미발송</a>
        </div>
        <div>
            <form action="{{ route('HNA_Brochure_Applicationlist_001') }}" method="GET" class="d-flex align-items-center">
                <input type="hidden" name="status_filter" value="{{ $statusFilter }}">
                <select name="search_type" class="form-control form-control-sm mr-2" style="width: 120px;">
                    <option value="member_id" {{ $searchType == 'member_id' ? 'selected' : '' }}>신청자 ID</option>
                    <option value="name" {{ $searchType == 'name' ? 'selected' : '' }}>신청자</option>
                </select>
                <input type="text" name="search_keyword" class="form-control form-control-sm mr-2" style="width: 200px;" value="{{ $searchKeyword }}" placeholder="검색어를 입력하세요">
                <button type="submit" class="btn btn-sm text-white px-3" style="background-color: #5d401a;">검색</button>
            </form>
        </div>
    </div>

    <div class="card border-0">
        <div class="card-body p-0">
            <form id="batch-form" action="{{ route('admin.brochure.send') }}" method="POST">
                @csrf
                <div class="table-responsive">
                     <table class="table table-bordered text-center table-admin">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th style="width: 50px;">
                                    <input type="checkbox" id="check-all">
                                </th>
                                <th style="width: 60px;">No</th>
                                <th style="width: 160px;">신청자 ID</th>
                                <th style="width: 160px;">신청자</th>
                                <th style="width: 200px;">신청일</th>
                                <th>이메일</th>
                                <th style="width: 120px;">상태</th>
                                <th style="width: 100px;">발송</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($applications as $app)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="ids[]" value="{{ $app->id }}" class="check-item">
                                    </td>
                                    <td>{{ $applications->total() - ($applications->currentPage() - 1) * $applications->perPage() - $loop->index }}</td>
                                    <td>{{ $app->member_id ?? '-' }}</td>
                                    <td class="text-left px-3">{{ $app->name }}</td>
                                    <td class="text-secondary">{{ $app->created_at->format('Y-m-d') }}</td>
                                    <td class="text-left px-3 text-secondary">{{ $app->email }}</td>
                                    <td>
                                        @if($app->status == '발송완료')
                                            <span class="text-success font-weight-bold">발송완료</span>
                                        @else
                                            <span class="text-dark">미발송</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($app->status == '미발송')
                                            <button type="button" class="btn btn-sm btn-outline-secondary px-2" style="font-size: 0.8rem;" onclick="sendIndividual({{ $app->id }})">발송</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-secondary">신청 내역이 없습니다.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>

            <div class="btn-area-60">
                <button type="button" id="btn-delete" class="btn btn-sm btn-delete-custom px-3" disabled>
                    삭제 <i class="fas fa-trash-alt ml-1"></i>
                </button>
                <button type="button" class="btn btn-sm btn-register-custom px-4" onclick="submitBatchSend()">발송하기</button>
            </div>

            <div class="pagination-wrap">
                <a href="{{ $applications->appends(request()->input())->url(1) }}" class="pag-btn {{ $applications->onFirstPage() ? 'disabled' : '' }}">
                    <i class="fas fa-angle-double-left"></i>
                </a>
                <a href="{{ $applications->appends(request()->input())->previousPageUrl() }}" class="pag-btn {{ $applications->onFirstPage() ? 'disabled' : '' }}">
                    <i class="fas fa-angle-left"></i>
                </a>
                
                @foreach(range(1, $applications->lastPage()) as $page)
                    @if($page >= $applications->currentPage() - 2 && $page <= $applications->currentPage() + 2)
                        <a href="{{ $applications->appends(request()->input())->url($page) }}" class="pag-btn {{ $page == $applications->currentPage() ? 'active' : '' }}">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                <a href="{{ $applications->appends(request()->input())->nextPageUrl() }}" class="pag-btn {{ !$applications->hasMorePages() ? 'disabled' : '' }}">
                    <i class="fas fa-angle-right"></i>
                </a>
                <a href="{{ $applications->appends(request()->input())->url($applications->lastPage()) }}" class="pag-btn {{ !$applications->hasMorePages() ? 'disabled' : '' }}">
                    <i class="fas fa-angle-double-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('check-all');
    const checkItems = document.querySelectorAll('.check-item');
    const btnDelete = document.getElementById('btn-delete');

    if (checkAll) {
        checkAll.addEventListener('change', function() {
            checkItems.forEach(item => item.checked = this.checked);
            toggleDeleteButton();
        });
    }

    checkItems.forEach(item => {
        item.addEventListener('change', function() {
            if (checkAll) checkAll.checked = Array.from(checkItems).every(i => i.checked);
            toggleDeleteButton();
        });
    });

    function toggleDeleteButton() {
        if (btnDelete) btnDelete.disabled = !Array.from(checkItems).some(i => i.checked);
    }
});

function submitBatchSend() {
    const selected = document.querySelectorAll('.check-item:checked');
    if (selected.length === 0) {
        alert('발송할 항목을 선택해주세요.');
        return;
    }
    if (confirm('선택한 ' + selected.length + '건의 브로슈어를 발송하시겠습니까?')) {
        document.getElementById('batch-form').submit();
    }
}

function sendIndividual(id) {
    if (confirm('브로슈어를 발송하시겠습니까?')) {
        const form = document.getElementById('batch-form');
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'ids[]';
        hiddenInput.value = id;
        
        // Clear existing ids
        const existingChecked = form.querySelectorAll('input[name="ids[]"]:checked');
        existingChecked.forEach(el => el.checked = false);
        
        form.appendChild(hiddenInput);
        form.submit();
    }
}
</script>

@endsection

