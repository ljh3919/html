@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">관리자사이트 > 고객센터 > 1:1 상담 관리 > 답변수정</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- 원본 문의 정보 (ReadOnly) -->
    <div class="card shadow mb-4 bg-light">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-2 font-weight-bold">제목</div>
                <div class="col-md-10">{{ $inquiry->title }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-2 font-weight-bold">내용</div>
                <div class="col-md-10" style="white-space: pre-wrap;">{{ $inquiry->content }}</div>
            </div>
            <div class="row">
                <div class="col-md-2 font-weight-bold">작성자 ID</div>
                <div class="col-md-4">{{ $inquiry->username }}</div>
                <div class="col-md-2 font-weight-bold">작성일</div>
                <div class="col-md-4">{{ $inquiry->created_at->format('Y-m-d') }}</div>
            </div>
        </div>
    </div>

    <!-- 답변 수정 폼 -->
    <div class="card shadow mb-4 border-left-success">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-success">답변 수정</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.inquiry.reply.update', $inquiry->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label font-weight-bold">답변 제목 <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" value="{{ old('title', $inquiry->reply->title) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label font-weight-bold">답변 <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea name="content" id="editor" class="form-control" rows="10">{{ old('content', $inquiry->reply->content) }}</textarea>
                        <p class="text-muted small mt-2">웹 에디터 영역</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label font-weight-bold">첨부파일</label>
                    <div class="col-sm-10">
                        <!-- 기존 파일 목록 -->
                        @if($inquiry->reply->attachments->count() > 0)
                            <div class="mb-3">
                                @foreach($inquiry->reply->attachments as $attachment)
                                    <div class="d-flex align-items-center mb-1">
                                        <span class="mr-2">{{ $attachment->original_name }}</span>
                                        <div class="custom-control custom-checkbox ml-2">
                                            <input type="checkbox" name="delete_attachments[]" value="{{ $attachment->id }}" class="custom-control-input" id="del_file_{{ $attachment->id }}">
                                            <label class="custom-control-label text-danger" for="del_file_{{ $attachment->id }}" style="cursor: pointer;">삭제</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- 신규 파일 업로드 -->
                        <div id="file-input-container">
                            <div class="d-flex align-items-center mb-2 file-input-group">
                                <input type="file" name="attachments[]" class="form-control-file w-auto mr-2">
                                <button type="button" class="btn btn-sm btn-outline-primary btn-add-file"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <p class="text-muted small mt-2">첨부파일은 최대 3개까지 등록 가능합니다.</p>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-success px-5 mr-2">수정</button>
                    <a href="{{ route('HNA_Customer_Councelview_001', $inquiry->id) }}" class="btn btn-secondary px-5">취소</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const title = form.querySelector('input[name="title"]').value.trim();
        const content = form.querySelector('textarea[name="content"]').value.trim();
        if (!title || !content) {
            alert('입력항목을 다시한번 확인해주세요.');
            e.preventDefault();
        }
    });

    const container = document.getElementById('file-input-container');
    const existingFilesCount = {{ $inquiry->reply->attachments->count() }};
    const maxFiles = 3;

    container.addEventListener('click', function(e) {
        if (e.target.closest('.btn-add-file')) {
            const currentInputs = container.querySelectorAll('.file-input-group').length;
            const checkedDeleteCount = document.querySelectorAll('input[name="delete_attachments[]"]:checked').length;
            const activeFiles = existingFilesCount - checkedDeleteCount + currentInputs;

            if (activeFiles < maxFiles) {
                const newGroup = document.createElement('div');
                newGroup.className = 'd-flex align-items-center mb-2 file-input-group';
                newGroup.innerHTML = `
                    <input type="file" name="attachments[]" class="form-control-file w-auto mr-2">
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-file"><i class="fas fa-minus"></i></button>
                `;
                container.appendChild(newGroup);
                updateAddButtonStatus();
            } else {
                alert('첨부파일은 최대 3개까지만 등록 가능합니다.');
            }
        } else if (e.target.closest('.btn-remove-file')) {
            e.target.closest('.file-input-group').remove();
            updateAddButtonStatus();
        }
    });

    function updateAddButtonStatus() {}
});
</script>
@endsection
