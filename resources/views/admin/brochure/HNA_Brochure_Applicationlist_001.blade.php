@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">관리자사이트 > 브로슈어 신청 > 목록</h1>
        <button type="button" class="btn btn-primary" onclick="submitBatchSend()">발송하기</button>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <span class="mr-3">전체 : <strong>{{ number_format($totalCount) }}</strong> 건</span>
                    <form action="{{ route('HNA_Brochure_Applicationlist_001') }}" method="GET" class="form-inline" id="filter-form">
                        <select name="status_filter" class="form-control mr-2" onchange="document.getElementById('filter-form').submit()">
                            <option value="전체" {{ $statusFilter == '전체' ? 'selected' : '' }}>전체</option>
                            <option value="발송완료" {{ $statusFilter == '발송완료' ? 'selected' : '' }}>발송완료</option>
                            <option value="미발송" {{ $statusFilter == '미발송' ? 'selected' : '' }}>미발송</option>
                        </select>
                        <select name="search_type" class="form-control mr-2">
                            <option value="member_id" {{ $searchType == 'member_id' ? 'selected' : '' }}>신청자 ID</option>
                            <option value="name" {{ $searchType == 'name' ? 'selected' : '' }}>신청자 이름</option>
                        </select>
                        <input type="text" name="search_keyword" class="form-control mr-2" value="{{ $searchKeyword }}" placeholder="검색어를 입력하세요">
                        <button type="submit" class="btn btn-dark">검색</button>
                        @if($searchKeyword || ($statusFilter && $statusFilter !== '전체'))
                            <a href="{{ route('HNA_Brochure_Applicationlist_001') }}" class="btn btn-outline-secondary ml-2">초기화</a>
                        @endif
                    </form>
                </div>
            </div>

            <form id="batch-form" action="{{ route('admin.brochure.send') }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" style="width: 40px;">
                                    <input type="checkbox" id="check-all">
                                </th>
                                <th class="text-center" style="width: 60px;">No</th>
                                <th class="text-center">신청자 ID</th>
                                <th class="text-center">신청자 이름</th>
                                <th class="text-center">신청자 E-Mail</th>
                                <th class="text-center">신청일</th>
                                <th class="text-center">상태</th>
                                <th class="text-center" style="width: 100px;">발송</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($applications as $app)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="ids[]" value="{{ $app->id }}" class="check-item">
                                    </td>
                                    <td class="text-center">{{ $applications->firstItem() + $loop->index }}</td>
                                    <td class="text-center">{{ $app->member_id ?? '-' }}</td>
                                    <td class="text-center">{{ $app->name }}</td>
                                    <td class="text-center">{{ $app->email }}</td>
                                    <td class="text-center">{{ $app->created_at->format('Y-m-d') }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $app->status == '발송완료' ? 'badge-success' : 'badge-secondary' }}">
                                            {{ $app->status }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="sendIndividual({{ $app->id }})">발송</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">신청 내역이 없습니다.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>

            <div class="mt-4 d-flex justify-content-center">
                {{ $applications->appends(request()->input())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('check-all').addEventListener('change', function() {
    const isChecked = this.checked;
    document.querySelectorAll('.check-item').forEach(item => {
        item.checked = isChecked;
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
