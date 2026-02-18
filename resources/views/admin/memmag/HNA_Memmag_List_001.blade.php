@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">회원 관리 > 목록</h1>
        <div>
            <a href="{{ route('HNA_Memmag_Regi_001') }}" class="btn btn-primary">신규 회원 등록</a>
            <button type="button" id="btn-delete" class="btn btn-danger" disabled>삭제</button>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <span class="mr-3">회원 수 : <strong>{{ number_format($totalCount) }}</strong> 명</span>
            </div>
        </div>
        <div class="col-md-6">
            <form action="{{ route('HNA_Memmag_List_001') }}" method="GET" class="form-inline justify-content-end">
                <select name="search_type" class="form-control mr-2">
                    <option value="username" {{ $searchType == 'username' ? 'selected' : '' }}>아이디</option>
                    <option value="name" {{ $searchType == 'name' ? 'selected' : '' }}>이름</option>
                    <option value="email" {{ $searchType == 'email' ? 'selected' : '' }}>이메일</option>
                </select>
                <input type="text" name="search_keyword" class="form-control mr-2" value="{{ $searchKeyword }}" placeholder="검색어를 입력하세요">
                <button type="submit" class="btn btn-dark">검색</button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="memberTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" style="width: 40px;">
                                <input type="checkbox" id="check-all">
                            </th>
                            <th class="text-center" style="width: 50px;">번호</th>
                            <th>아이디</th>
                            <th>이름</th>
                            <th>휴대전화번호</th>
                            <th>E-mail</th>
                            <th class="text-center">등록일</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $member)
                            <tr class="member-row" data-id="{{ $member->id }}" style="cursor: pointer;">
                                <td class="text-center" onclick="event.stopPropagation();">
                                    <input type="checkbox" name="ids[]" value="{{ $member->id }}" class="check-item">
                                </td>
                                <td class="text-center">{{ $members->firstItem() + $loop->index }}</td>
                                <td>{{ $member->username }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->phone }}</td>
                                <td>{{ $member->email }}</td>
                                <td class="text-center">{{ $member->created_at->format('Y-m-d') }}</td>
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
                {{ $members->links('pagination::bootstrap-4') }}
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
    const memberRows = document.querySelectorAll('.member-row');

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
            
            fetch("{{ route('admin.memmag.massDestroy') }}", {
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
    memberRows.forEach(row => {
        row.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            location.href = "{{ route('HNA_Memmag_View_001', ':id') }}".replace(':id', id);
        });
    });
});
</script>

<style>
.pagination .page-item.active .page-link {
    font-weight: bold;
}
</style>
@endsection
