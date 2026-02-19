@extends('layouts.publishing_blank')

@section('content')
<div class="container-fluid">
    <div class="content-title pb-2">고인 관리</div>

    <div class="row align-items-end mb-3">
        <div class="col-md-6">
            <div style="font-size: 0.9rem; color: #5d401a; font-weight: 500;">
                • 총 고인등록 수 <strong style="color: #5d401a;">{{ number_format($totalCount) }}</strong>명
            </div>
        </div>
        <div class="col-md-6">
            <form action="{{ route('HNA_Deadmag_List_001') }}" method="GET" class="d-flex justify-content-end">
                <select name="search_type" class="form-control form-control-sm mr-2" style="width: 150px;">
                    <option value="name" {{ $searchType == 'name' ? 'selected' : '' }}>고인명</option>
                    <option value="dead_code" {{ $searchType == 'dead_code' ? 'selected' : '' }}>고인코드번호</option>
                </select>
                <input type="text" name="search_keyword" class="form-control form-control-sm mr-2" style="width: 200px;" value="{{ $searchKeyword }}">
                <button type="submit" class="btn btn-sm text-white px-3" style="background-color: #5d401a;">검색</button>
            </form>
        </div>
    </div>

    <div class="card border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="deadTable" width="100%" cellspacing="0">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th style="width: 50px;">
                                <input type="checkbox" id="check-all">
                            </th>
                            <th>고인코드번호</th>
                            <th>고인명</th>
                            <th>구분</th>
                            <th>안치장소</th>
                            <th>기일</th>
                            <th>등록일</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($deads as $dead)
                            <tr class="dead-row" data-id="{{ $dead->id }}" style="cursor: pointer;">
                                <td onclick="event.stopPropagation();">
                                    <input type="checkbox" name="ids[]" value="{{ $dead->id }}" class="check-item">
                                </td>
                                <td class="text-secondary">{{ $dead->dead_code }}</td>
                                <td>故 {{ $dead->name }}</td>
                                <td>{{ $dead->category }}</td>
                                <td>
                                    @if($dead->category === '하늘누리관')
                                        {{ $dead->location_hall }}관 {{ $dead->location_row }}열 {{ $dead->location_num }}번
                                    @else
                                        {{ $dead->location_area }}구역 {{ $dead->location_row }}열 {{ $dead->location_num }}번
                                    @endif
                                </td>
                                <td>{{ $dead->death_date->format('Y-m-d') }}</td>
                                <td class="text-secondary">{{ $dead->created_at->format('Y-m-d') }}</td>
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
                <button type="button" id="btn-delete" class="btn btn-sm btn-outline-secondary px-3" disabled>
                    삭제 <i class="fas fa-trash-alt ml-1"></i>
                </button>
                <div class="d-flex">
                    <a href="{{ route('HNA_Deadmag_Regi_001') }}" class="btn btn-sm text-white px-4" style="background-color: #5d401a;">고인 등록</a>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $deads->appends(request()->input())->links('pagination::bootstrap-4') }}
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
    const deadRows = document.querySelectorAll('.dead-row');

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

            fetch("{{ route('admin.deadmag.massDestroy') }}", {
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
    deadRows.forEach(row => {
        row.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            location.href = "{{ route('HNA_Deadmag_View_001', ':id') }}".replace(':id', id);
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
