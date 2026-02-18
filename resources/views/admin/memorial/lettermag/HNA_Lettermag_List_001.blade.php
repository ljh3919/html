@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">사이버 추모관 > 하늘 편지 관리 > 목록</h1>
        <div>
            <button type="button" id="btn-delete" class="btn btn-danger" disabled>삭제</button>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <span class="mr-3">총 등록 수 : <strong>{{ number_format($totalCount) }}</strong></span>
            </div>
        </div>
        <div class="col-md-6">
            <form action="{{ route('HNA_Lettermag_List_001') }}" method="GET" class="form-inline justify-content-end">
                <select name="search_type" class="form-control mr-2">
                    <option value="username" {{ $searchType == 'username' ? 'selected' : '' }}>ID</option>
                    <option value="content" {{ $searchType == 'content' ? 'selected' : '' }}>내용</option>
                </select>
                <input type="text" name="search_keyword" class="form-control mr-2" value="{{ $searchKeyword }}" placeholder="검색어를 입력하세요">
                <button type="submit" class="btn btn-dark">검색</button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="letterTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" style="width: 40px;">
                                <input type="checkbox" id="check-all">
                            </th>
                            <th class="text-center" style="width: 50px;">No</th>
                            <th class="text-center">ID</th>
                            <th>내용</th>
                            <th class="text-center">작성자</th>
                            <th class="text-center">비밀글</th>
                            <th class="text-center">등록일</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($letters as $letter)
                            <tr class="letter-row" data-id="{{ $letter->id }}" style="cursor: pointer;">
                                <td class="text-center" onclick="event.stopPropagation();">
                                    <input type="checkbox" name="ids[]" value="{{ $letter->id }}" class="check-item">
                                </td>
                                <td class="text-center">{{ $letters->firstItem() + $loop->index }}</td>
                                <td class="text-center">{{ $letter->username }}</td>
                                <td class="text-truncate" style="max-width: 300px;">{{ $letter->content }}</td>
                                <td class="text-center">{{ $letter->author_description }}</td>
                                <td class="text-center">{{ $letter->is_private }}</td>
                                <td class="text-center">{{ $letter->created_at->format('Y.m.d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">검색결과가 없습니다.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
@endsection
