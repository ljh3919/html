@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="content-title">하늘편지 관리</div>

    <div class="d-flex justify-content-between align-items-end mb-3">
        <div>
            <div style="font-size: 0.9rem; color: #5d401a; font-weight: 500;">
                • 총 등록 수 <strong style="color: #5d401a;">{{ number_format($totalCount) }}</strong>
            </div>
        </div>
        <div>
            <form action="{{ route('HNA_Lettermag_List_001') }}" method="GET" class="d-flex">
                <select name="search_type" class="form-control form-control-sm mr-2" style="width: 150px;">
                    <option value="username" {{ $searchType == 'username' ? 'selected' : '' }}>아이디</option>
                    <option value="content" {{ $searchType == 'content' ? 'selected' : '' }}>내용</option>
                    <option value="author" {{ $searchType == 'author' ? 'selected' : '' }}>작성자</option>
                </select>
                <input type="text" name="search_keyword" class="form-control form-control-sm mr-2" style="width: 200px;" value="{{ $searchKeyword }}" placeholder="검색어를 입력하세요">
                <button type="submit" class="btn btn-sm text-white px-4" style="background-color: #5d401a;">검색</button>
            </form>
        </div>
    </div>

    <div class="card border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered text-center mb-0" id="letterTable" width="100%" cellspacing="0" style="font-size: 0.9rem;">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th style="width: 50px;">
                                <input type="checkbox" id="check-all">
                            </th>
                            <th style="width: 80px;">No</th>
                            <th style="width: 120px;">아이디</th>
                            <th>내용</th>
                            <th style="width: 150px;">작성자</th>
                            <th style="width: 120px;">비밀글</th>
                            <th style="width: 150px;">등록일</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($letters as $letter)
                            <tr class="letter-row" data-id="{{ $letter->id }}" style="cursor: pointer;">
                                <td onclick="event.stopPropagation();">
                                    <input type="checkbox" name="ids[]" value="{{ $letter->id }}" class="check-item">
                                </td>
                                <td>{{ $letters->total() - ($letters->currentPage() - 1) * $letters->perPage() - $loop->index }}</td>
                                <td class="text-secondary">{{ $letter->username }}</td>
                                <td class="text-left py-2 px-3">
                                    <div class="text-truncate" style="max-width: 600px;">
                                        {{ $letter->content }}
                                    </div>
                                </td>
                                <td>{{ $letter->author_description }}</td>
                                <td class="text-secondary">{{ $letter->is_private == 'Y' ? 'Y' : '' }}</td>
                                <td class="text-secondary">{{ $letter->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-secondary">검색결과가 없습니다.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <button type="button" id="btn-delete" class="btn btn-sm btn-outline-secondary px-3" style="border-color: #ced4da; color: #333;" disabled>
                    삭제 <i class="fas fa-trash-alt ml-1"></i>
                </button>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $letters->appends(request()->input())->links('pagination::bootstrap-4') }}
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
    const letterRows = document.querySelectorAll('.letter-row');

    // 전체 선택
    checkAll.addEventListener('change', function() {
        checkItems.forEach(item => {
            item.checked = this.checked;
        });
        toggleDeleteButton();
    });

    // 개별 선택 시 삭제 버튼 상태 변경
    checkItems.forEach(item => {
        item.addEventListener('change', function() {
            const allChecked = Array.from(checkItems).every(i => i.checked);
            checkAll.checked = allChecked;
            toggleDeleteButton();
        });
    });

    function toggleDeleteButton() {
        const anyChecked = Array.from(checkItems).some(i => i.checked);
        btnDelete.disabled = !anyChecked;
    }

    // 삭제 버튼 클릭
    btnDelete.addEventListener('click', function() {
        if (confirm("삭제하시면 데이터를 되돌릴 수 없습니다. 정말 삭제하시겠습니까?")) {
            const selectedIds = Array.from(document.querySelectorAll('.check-item:checked')).map(i => i.value);
            
            fetch("{{ route('admin.lettermag.massDestroy') }}", {
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

    // 행 클릭 시 상세 페이지 이동
    letterRows.forEach(row => {
        row.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            location.href = "{{ route('HNA_Lettermag_View_001', ':id') }}".replace(':id', id);
        });
    });
});
</script>

<style>
.pagination .page-item .page-link {
    color: #333;
    border: none;
    margin: 0 2px;
    border-radius: 50% !important;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
}
.pagination .page-item.active .page-link {
    background-color: #3e2a0f !important;
    color: #fff !important;
    font-weight: bold;
}
.pagination .page-item.disabled .page-link {
    color: #ccc;
    background: transparent;
}
</style>
@endsection
