@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">관리자사이트 > 고객센터 > 공지사항 관리 > 상세</h1>
        <div>
            <a href="{{ route('HNA_Customer_Noticemodi_001', $notice->id) }}" class="btn btn-primary">수정</a>
            <button type="button" class="btn btn-danger" onclick="if(confirm('삭제하시면 데이터를 되돌릴 수 없습니다. 정말 삭제하시겠습니까?')) document.getElementById('delete-form').submit();">삭제</button>
            <a href="{{ route('HNA_Customer_Noticelist_001') }}" class="btn btn-secondary">목록</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <colgroup>
                    <col style="width: 150px; background-color: #f8f9fc;">
                    <col>
                </colgroup>
                <tbody>
                    <tr>
                        <th class="py-3 px-4">제목</th>
                        <td class="py-3 px-4 font-weight-bold">{{ $notice->title }}</td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4">작성자</th>
                        <td class="py-3 px-4">{{ $notice->author->name }}</td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4">등록일</th>
                        <td class="py-3 px-4">{{ $notice->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4">조회수</th>
                        <td class="py-3 px-4">{{ number_format($notice->view_count) }}</td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4 align-middle">내용</th>
                        <td class="py-4 px-4">
                            <div class="content-area" style="min-height: 200px; line-height: 1.6;">
                                {!! nl2br(e($notice->content)) !!}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="py-3 px-4 align-middle">첨부파일</th>
                        <td class="py-3 px-4">
                            @forelse($notice->attachments as $attachment)
                                <div class="mb-2">
                                    <a href="{{ route('admin.notice.download', $attachment->id) }}" class="text-primary mr-2">
                                        <i class="fas fa-download mr-1"></i> {{ $attachment->original_name }}
                                    </a>
                                    <span class="badge badge-light">다운로드</span>
                                </div>
                            @empty
                                <span class="text-muted">첨부된 파일이 없습니다.</span>
                            @endforelse
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<form id="delete-form" action="{{ route('admin.notice.destroy', $notice->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection
