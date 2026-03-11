@extends('layouts.admin')
 
 @section('styles')
 <style>
     /* 페이지네이션 및 테이블 기본 스타일은 admin-common.css에 정의됨 */
 </style>
 @endsection

@section('content')
    <!-- title -->
    <div class="wrap-tit">
        <h2 class="tit01">브로슈어 신청 관리</h2>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="wrap-table-control">
        <div class="wrap-table-control-left">
            <button type="button" 
                    onclick="location.href='{{ route('HNA_Brochure_Applicationlist_001', ['status_filter' => '전체']) }}'"
                    class="btn {{ $statusFilter == '전체' ? 'primary' : 'line' }} small">
                <span>전체</span>
            </button>
            <button type="button" 
                    onclick="location.href='{{ route('HNA_Brochure_Applicationlist_001', ['status_filter' => '발송완료']) }}'"
                    class="btn {{ $statusFilter == '발송완료' ? 'primary' : 'line' }} small">
                <span>발송완료</span>
            </button>
            <button type="button" 
                    onclick="location.href='{{ route('HNA_Brochure_Applicationlist_001', ['status_filter' => '미발송']) }}'"
                    class="btn {{ $statusFilter == '미발송' ? 'primary' : 'line' }} small">
                <span>미발송</span>
            </button>
        </div>
        <form action="{{ route('HNA_Brochure_Applicationlist_001') }}" method="GET">
            <input type="hidden" name="status_filter" value="{{ $statusFilter }}">
            <div class="wrap-table-control-right">
            <div class="input-group h40">
                <div class="select-wrapper">
                    <select name="search_type" class="input-box select" style="width: 160px;">
                        <option value="" {{ $searchType == '' ? 'selected' : '' }}>선택하세요</option>
                        <option value="member_id" {{ $searchType == 'member_id' ? 'selected' : '' }}>신청자 ID</option>
                        <option value="name" {{ $searchType == 'name' ? 'selected' : '' }}>신청자</option>
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
            </div>
        </form>
    </div>

    <!-- table -->
    <form id="batch-form" action="{{ route('admin.brochure.send') }}" method="POST" style="margin-top: 10px;">
        @csrf
        <table class="table board-table">
            <thead>
                <tr>
                    <th scope="col" style="width: 60px">
                        <label class="checkbox-item">
                            <input type="checkbox" id="check-all" class="checkbox-input" />
                        </label>
                    </th>
                    <th scope="col" style="width: 60px">No</th>
                    <th scope="col" style="width: calc((100% - 60px) / 5)">신청자 ID</th>
                    <th scope="col" style="width: calc((100% - 60px) / 5)">신청자</th>
                    <th scope="col" style="width: calc((100% - 60px) / 5)">이메일</th>
                    <th scope="col" style="width: calc((100% - 60px) / 5)">신청일</th>
                    <th scope="col" style="width: calc((100% - 60px) / 5)">상태</th>
                    <th scope="col" style="width: 150px">발송</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $app)
                    <tr>
                        <td>
                            <label class="checkbox-item">
                                <input type="checkbox" name="ids[]" value="{{ $app->id }}" class="checkbox-input check-item" />
                            </label>
                        </td>
                        <td>{{ $applications->total() - ($applications->currentPage() - 1) * $applications->perPage() - $loop->index }}</td>
                        <td class="ellipsis">{{ $app->member_id ?? '-' }}</td>
                        <td>{{ $app->name }}</td>
                        <td class="text-secondary">{{ $app->email }}</td>
                        <td class="text-secondary">{{ $app->created_at->format('Y-m-d') }}</td>
                        <td class="{{ $app->status == '발송완료' ? 'done' : '' }}">
                            {{ $app->status }}
                        </td>
                        <td>
                            @if($app->status == '미발송')
                                <button type="button" class="btn line small" onclick="sendIndividual({{ $app->id }})">
                                    <span>발송</span>
                                </button>
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
    </form>

    <!-- board button -->
    <div class="wrap-board-btn">
        <div class="wrap-btn-left"></div>
        <div class="wrap-btn-right">
            <button type="button" class="btn primary small" onclick="submitBatchSend()">
                <span>발송하기</span>
            </button>
        </div>
    </div>

    <!-- pager -->
    {{ $applications->appends(request()->input())->links('admin.partials.pagination') }}

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('check-all');
    const checkItems = document.querySelectorAll('.check-item');

    if (checkAll) {
        checkAll.addEventListener('change', function() {
            checkItems.forEach(item => item.checked = this.checked);
        });
    }

    checkItems.forEach(item => {
        item.addEventListener('change', function() {
            if (checkAll) checkAll.checked = Array.from(checkItems).every(i => i.checked);
        });
    });
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
        
        // 기존 체크 해제
        const existingChecked = form.querySelectorAll('input[name="ids[]"]:checked');
        existingChecked.forEach(el => el.checked = false);
        
        // 해당 id 체크
        const target = form.querySelector(`input[value="${id}"]`);
        if (target) {
            target.checked = true;
        } else {
            // hidden input fallback
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'ids[]';
            hiddenInput.value = id;
            form.appendChild(hiddenInput);
        }
        
        form.submit();
    }
}
</script>
@endsection

