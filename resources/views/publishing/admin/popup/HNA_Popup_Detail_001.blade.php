@extends('layouts.publishing_blank')

@section('styles')
<style>
    .table-header-custom {
        background-color: #f8f9fa;
        font-weight: 500;
        vertical-align: middle !important;
        padding-left: 20px !important;
        border-bottom: 1px solid #dee2e6 !important;
    }
    .table-cell-custom {
        padding: 12px 20px !important;
        border-bottom: 1px solid #dee2e6 !important;
    }
    .btn-outline-custom {
        background-color: #fff;
        border: 1px solid #ced4da;
        color: #333;
        font-weight: 500;
    }
    .btn-outline-custom:hover {
        background-color: #f8f9fa;
        color: #000;
    }
</style>
@endsection

@section('content')
<div class="container-fluid text-black">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <div style="font-size: 1.5rem; font-weight: 700; color: #000;">• 팝업 상세</div>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <colgroup>
                        <col style="width: 180px;">
                        <col>
                    </colgroup>
                    <tbody>
                        <tr>
                            <th class="table-header-custom">제목 <span class="text-danger ml-1">*</span></th>
                            <td class="table-cell-custom font-weight-bold">{{ $popup->title }}</td>
                        </tr>
                        <tr>
                            <th class="table-header-custom">적용일자 <span class="text-danger ml-1">*</span></th>
                            <td class="table-cell-custom">
                                {{ $popup->start_at->format('Y-m-d H:i') }} ~ {{ $popup->end_at->format('Y-m-d H:i') }}
                                @php
                                    $status = $popup->status;
                                    $badgeClass = 'badge-secondary';
                                    if ($status == '진행중') $badgeClass = 'badge-success';
                                    elseif ($status == '사용대기') $badgeClass = 'badge-primary';
                                    elseif ($status == '종료') $badgeClass = 'badge-danger';
                                @endphp
                                <span class="badge {{ $badgeClass }} ml-2 px-2 py-1" style="font-weight: 500;">{{ $status }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-header-custom">노출여부 <span class="text-danger ml-1">*</span></th>
                            <td class="table-cell-custom">
                                @if($popup->is_visible)
                                    <span class="text-primary font-weight-bold">노출함</span>
                                @else
                                    <span class="text-danger font-weight-bold">노출안함</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="table-header-custom">작성일</th>
                            <td class="table-cell-custom text-secondary">{{ $popup->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="table-header-custom">내용 <span class="text-danger ml-1">*</span></th>
                            <td class="table-cell-custom">
                                <div class="popup-content-area py-2" style="min-height: 250px; line-height: 1.6;">
                                    {!! $popup->content !!}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end align-items-center mt-4 mb-5">
        <a href="{{ route('HNA_Popup_List_001') }}" class="btn btn-sm btn-outline-custom px-4 py-2 mr-2" style="min-width: 80px;">목록</a>
        <button type="button" class="btn btn-sm btn-outline-custom px-4 py-2 mr-2" style="min-width: 80px;" onclick="deletePopup()">
            삭제 <i class="fas fa-trash-alt ml-1" style="font-size: 0.8rem;"></i>
        </button>
        <a href="{{ route('HNA_Popup_Modi_001', $popup->id) }}" class="btn btn-sm text-white px-4 py-2" style="background-color: #5d401a; border: 1px solid #5d401a; min-width: 80px; font-weight: 500;">수정</a>
    </div>
</div>

<form id="delete-form" action="{{ route('admin.popup.destroy', $popup->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function deletePopup() {
    if (confirm("삭제하시면 데이터를 되돌릴 수 없습니다. 정말 삭제하시겠습니까?")) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endsection
