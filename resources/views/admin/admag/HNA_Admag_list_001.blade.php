@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">관리자 관리 > 목록</h1>
        <div>
            <a href="{{ route('HNA_Admag_Regi_001') }}" class="btn btn-primary">신규 관리자 등록</a>
            <button type="button" id="btn-delete" class="btn btn-danger" disabled>삭제</button>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="adminTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" style="width: 40px;">
                                <input type="checkbox" id="check-all">
                            </th>
                            <th class="text-center" style="width: 50px;">번호</th>
                            <th>이름</th>
                            <th>아이디</th>
                            <th>핸드폰 번호</th>
                            <th>E-mail</th>
                            <th class="text-center">등록일</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $admin)
                            <tr class="admin-row" data-id="{{ $admin->id }}" style="cursor: pointer;">
                                <td class="text-center" onclick="event.stopPropagation();">
                                    <input type="checkbox" name="ids[]" value="{{ $admin->id }}" class="check-item">
                                </td>
                                <td class="text-center">{{ $admins->firstItem() + $loop->index }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->username }}</td>
                                <td>{{ $admin->phone }}</td>
                                <td>{{ $admin->email }}</td>
                                <td class="text-center">{{ $admin->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">등록된 관리자가 없습니다.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $admins->links('pagination::bootstrap-4') }}
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
    const adminRows = document.querySelectorAll('.admin-row');

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
            
            fetch("{{ route('admin.admag.massDestroy') }}", {
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
    adminRows.forEach(row => {
        row.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            location.href = "{{ route('HNA_Admag_view_001', ':id') }}".replace(':id', id);
        });
    });
});
</script>

<style>
/* 설계서 기준 폰트 굵기 처리 등 추가 스타일이 필요할 경우 작성 */
.pagination .page-item.active .page-link {
    font-weight: bold;
}
</style>
@endsection
