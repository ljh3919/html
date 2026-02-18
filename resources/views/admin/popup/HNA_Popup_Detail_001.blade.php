@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">관리자사이트 > 팝업 관리 > 상세</h1>
        <div>
            <a href="{{ route('HNA_Popup_Modi_001', $popup->id) }}" class="btn btn-success">수정</a>
            <button type="button" class="btn btn-danger" onclick="if(confirm('정말로 삭제하시겠습니까? 삭제 시 복구가 안됩니다.')) document.getElementById('delete-form').submit();">삭제</button>
            <a href="{{ route('HNA_Popup_List_001') }}" class="btn btn-secondary">목록</a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <colgroup>
                    <col style="width: 150px; background-color: #f8f9fc;">
                    <col>
                </colgroup>
                <tbody>
                    <tr>
                        <th class="py-3 px-4 text-center">제목</th>
                        <td class="py-3 px-4 font-weight-bold">{{ $popup->title }}</td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4 text-center">적용일자</th>
                        <td class="py-3 px-4">
                            {{ $popup->start_at->format('Y-m-d H:i') }} ~ {{ $popup->end_at->format('Y-m-d H:i') }}
                            @php
                                $status = $popup->status;
                                $badgeClass = 'badge-secondary';
                                if ($status == '진행중') $badgeClass = 'badge-success';
                                elseif ($status == '사용대기') $badgeClass = 'badge-primary';
                                elseif ($status == '종료') $badgeClass = 'badge-danger';
                            @endphp
                            <span class="badge {{ $badgeClass }} ml-2">{{ $status }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4 text-center">노출여부</th>
                        <td class="py-3 px-4">
                            <span class="text-{{ $popup->is_visible ? 'primary' : 'danger' }}">
                                {{ $popup->is_visible ? '노출함' : '노출안함' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4 text-center">작성일</th>
                        <td class="py-3 px-4">{{ $popup->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4 text-center align-middle">내용</th>
                        <td class="py-4 px-4">
                            <div class="popup-content-area" style="min-height: 200px; border: 1px solid #eee; padding: 20px; border-radius: 5px;">
                                {!! $popup->content !!}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<form id="delete-form" action="{{ route('admin.popup.destroy', $popup->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection
