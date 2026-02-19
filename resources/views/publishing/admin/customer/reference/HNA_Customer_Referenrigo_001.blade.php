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

    <form action="{{ route('admin.reference.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
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
                                    <input type="text" name="title" class="form-control form-control-sm" value="{{ old('title') }}" placeholder="자료 제목을 입력하세요" required>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-custom">내용 <span class="text-danger ml-1">*</span></th>
                                <td class="table-cell-custom">
                                    <textarea name="content" id="editor" class="form-control" required>{{ old('content') }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-custom">첨부파일</th>
                                <td class="table-cell-custom">
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
                <a href="{{ route('HNA_Customer_Referenlist_001') }}" class="btn btn-sm btn-outline-custom px-4 py-2 mr-2" style="min-width: 80px;">취소</a>
                <button type="submit" class="btn btn-sm text-white px-4 py-2" style="background-color: #5d401a; border: 1px solid #5d401a; min-width: 80px; font-weight: 500;">등록</button>
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
    const maxFiles = 3;

    container.addEventListener('click', function(e) {
        if (e.target.closest('.btn-add-file')) {
            const currentInputs = container.querySelectorAll('.file-input-group').length;
            if (currentInputs < maxFiles) {
                const newGroup = document.createElement('div');
                newGroup.className = 'd-flex align-items-center mb-2 file-input-group';
                newGroup.innerHTML = `
                    <input type="file" name="attachments[]" class="form-control-file w-auto mr-2">
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-file"><i class="fas fa-minus"></i></button>
                `;
                container.appendChild(newGroup);
                updateAddButtonStatus();
            }
        } else if (e.target.closest('.btn-remove-file')) {
            e.target.closest('.file-input-group').remove();
            updateAddButtonStatus();
        }
    });

    function updateAddButtonStatus() {
        const currentInputs = container.querySelectorAll('.file-input-group').length;
        const addBtn = container.querySelector('.btn-add-file');
        if (addBtn) {
            addBtn.disabled = (currentInputs >= maxFiles);
        }
    }
});
</script>
@endsection
