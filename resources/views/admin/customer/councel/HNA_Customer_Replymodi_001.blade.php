@extends('layouts.admin')

@section('styles')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<style>
    .note-editor.note-frame {
        border-color: #dee2e6;
    }
    .note-editor.note-frame .note-statusbar {
        border-top-color: #dee2e6;
    }
</style>
@endsection

@section('content')
<!-- title -->
<div class="wrap-tit">
    <h2 class="tit01">1:1 상담 관리</h2>
</div>

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        {{ $errors->first() }}
    </div>
@endif

<!-- Original Inquiry Info (ReadOnly) -->
<table class="table board-table vertical-table mb-4">
    <tr>
        <th>문의 제목</th>
        <td>{{ $inquiry->title }}</td>
    </tr>
    <tr>
        <th>문의 내용</th>
        <td>
            <div style="white-space: pre-wrap; line-height: 1.6;">{{ $inquiry->content }}</div>
        </td>
    </tr>
    <tr>
        <th>작성자 ID</th>
        <td>{{ $inquiry->username }}</td>
    </tr>
    <tr>
        <th>이메일</th>
        <td>{{ $inquiry->email ?? '-' }}</td>
    </tr>
    <tr>
        <th>작성일</th>
        <td class="text-secondary">{{ $inquiry->created_at->format('Y-m-d H:i') }}</td>
    </tr>
</table>

<h3 class="tit3">답변</h3>

<form action="{{ route('admin.inquiry.reply.update', $inquiry->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <table class="table board-table vertical-table">
        <tr>
            <th class="required">답변 제목</th>
            <td>
                <div class="wrap-form">
                    <div class="input-group h30" style="width: 100%">
                        <input type="text" name="title" class="input-box" style="min-width: 100%" value="{{ old('title', $inquiry->reply->title) }}" required />
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th class="required">답변</th>
            <td>
                <div class="wrap-form">
                    <textarea name="content" id="editor" class="input-box" required>{{ old('content', $inquiry->reply->content) }}</textarea>
                </div>
            </td>
        </tr>
        <tr>
            <th>첨부파일</th>
            <td>
                <!-- Existing Files -->
                @if($inquiry->reply->attachments->count() > 0)
                    <div class="mb-3">
                        @foreach($inquiry->reply->attachments as $attachment)
                            <div class="wrap-file mb-1">
                                <span class="text-dark">{{ $attachment->original_name }}</span>
                                <label class="checkbox-item ml-4" style="color: #ff4d4f;">
                                    <input type="checkbox" name="delete_attachments[]" value="{{ $attachment->id }}" class="checkbox-input" />
                                    <span class="ml-1">삭제</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- New File Uploads -->
                <div id="file-input-container">
                    <div class="wrap-find-file mb-2 file-input-group">
                        <div class="input-group h30" style="width: 400px">
                            <input type="text" class="input-box file-name-display" style="min-width: 100%" readonly placeholder="새 파일을 선택하세요" />
                        </div>
                        <label class="btn h30" style="cursor: pointer;">
                            <span>파일찾기</span>
                            <input type="file" name="attachments[]" class="file-input-real" style="display: none;">
                        </label>
                        <button type="button" class="btn line icon h30 btn-add-file">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 6V18" stroke="#555555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M18 12H6" stroke="#555555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="text-secondary mt-2" style="font-size: 0.85rem;">
                    • 첨부파일은 최대 3개까지 등록 가능합니다. (개당 10MB)
                </div>
            </td>
        </tr>
    </table>

    <!-- board button -->
    <div class="wrap-board-btn">
        <div class="wrap-btn-left"></div>
        <div class="wrap-btn-right">
            <button type="button" class="btn line small" onclick="location.href='{{ route('HNA_Customer_Councelview_001', $inquiry->id) }}'">
                <span>취소</span>
            </button>
            <button type="submit" class="btn primary small">
                <span>수정</span>
            </button>
        </div>
    </div>
</form>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
$(document).ready(function() {
    $('#editor').summernote({
        placeholder: '답변 내용을 입력해주세요.',
        tabsize: 2,
        height: 400,
        lang: 'ko-KR',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    const container = document.getElementById('file-input-container');
    const existingFilesCount = {{ $inquiry->reply->attachments->count() }};
    const maxFiles = 3;

    // 파일 선택 시 파일명 표시
    $(document).on('change', '.file-input-real', function() {
        const fileName = $(this).val().split('\\').pop();
        $(this).closest('.wrap-find-file').find('.file-name-display').val(fileName);
    });

    container.addEventListener('click', function(e) {
        if (e.target.closest('.btn-add-file')) {
            const currentInputs = container.querySelectorAll('.file-input-group').length;
            const checkedDeleteCount = document.querySelectorAll('input[name="delete_attachments[]"]:checked').length;
            const activeFiles = existingFilesCount - checkedDeleteCount + currentInputs;

            if (activeFiles < maxFiles) {
                const newGroup = document.createElement('div');
                newGroup.className = 'wrap-find-file mb-2 file-input-group';
                newGroup.innerHTML = `
                    <div class="input-group h30" style="width: 400px">
                        <input type="text" class="input-box file-name-display" style="min-width: 100%" readonly placeholder="새 파일을 선택하세요" />
                    </div>
                    <label class="btn h30" style="cursor: pointer;">
                        <span>파일찾기</span>
                        <input type="file" name="attachments[]" class="file-input-real" style="display: none;">
                    </label>
                    <button type="button" class="btn line icon h30 btn-remove-file">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M5 19L19 5" stroke="#161616" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
                            <path d="M5 5L19 19" stroke="#161616" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
                        </svg>
                    </button>
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

    function updateAddButtonStatus() {
        // Option to disable add button if limit reached
    }
});
</script>
@endsection
