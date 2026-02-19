@extends('layouts.publishing_blank')

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
        <div style="font-size: 1.5rem; font-weight: 700; color: #000;">• 자료실 관리</div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.reference.update', $reference->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card border-0 mt-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <colgroup>
                            <col style="width: 200px;">
                            <col>
                        </colgroup>
                        <tbody>
                            <tr>
                                <th class="table-header-custom">제목 <span class="text-danger ml-1">*</span></th>
                                <td class="table-cell-custom">
                                    <input type="text" name="title" class="form-control form-control-sm" value="{{ old('title', $reference->title) }}" placeholder="자료 제목을 입력하세요" required>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-custom">내용 <span class="text-danger ml-1">*</span></th>
                                <td class="table-cell-custom">
                                    <textarea name="content" id="editor" class="form-control" required>{{ old('content', $reference->content) }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-custom">첨부파일</th>
                                <td class="table-cell-custom">
                                    <!-- 기존 파일 목록 -->
                                    @if($reference->attachments->count() > 0)
                                        <div class="mb-3">
                                            @foreach($reference->attachments as $attachment)
                                                <div class="d-flex align-items-center mb-1">
                                                    <span class="mr-2 text-dark">{{ $attachment->original_name }}</span>
                                                    <div class="custom-control custom-checkbox ml-2">
                                                        <input type="checkbox" name="delete_attachments[]" value="{{ $attachment->id }}" class="custom-control-input" id="del_file_{{ $attachment->id }}">
                                                        <label class="custom-control-label text-danger" for="del_file_{{ $attachment->id }}" style="cursor: pointer; font-size: 0.85rem;">삭제</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- 신규 파일 업로드 -->
                                    <div id="file-input-container">
                                        <div class="d-flex align-items-center mb-2 file-input-group">
                                            <input type="file" name="attachments[]" class="form-control-file w-auto mr-2">
                                            <button type="button" class="btn btn-sm btn-outline-secondary btn-add-file"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <p class="text-muted mb-0" style="font-size: 0.85rem;">• 첨부파일은 최대 3개까지 등록 가능합니다. (개당 10MB)</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4 mb-5">
            <p class="text-danger small mb-0 mr-auto">* 표시항목은 필수입력 항목입니다.</p>
            <div class="d-flex">
                <a href="{{ route('HNA_Customer_Referenview_001', $reference->id) }}" class="btn btn-sm btn-outline-custom px-4 py-2 mr-2" style="min-width: 80px;">취소</a>
                <button type="submit" class="btn btn-sm text-white px-4 py-2" style="background-color: #5d401a; border: 1px solid #5d401a; min-width: 80px; font-weight: 500;">수정</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
$(document).ready(function() {
    $('#editor').summernote({
        placeholder: '자료 내용을 입력해주세요.',
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
    const existingFilesCount = {{ $reference->attachments->count() }};
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

    function updateAddButtonStatus() {
        // Optional: dynamic update of add button status
    }
});
</script>
@endsection
