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
        <div style="font-size: 1.5rem; font-weight: 700; color: #000;">• 공지사항 관리</div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0">
        <div class="card-body p-0">
            <form action="{{ route('admin.notice.store') }}" method="POST" enctype="multipart/form-data" id="noticeForm">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <colgroup>
                            <col style="width: 180px;">
                            <col>
                        </colgroup>
                        <tbody>
                            <tr>
                                <th class="table-header-custom">제목 <span class="text-danger ml-1">*</span></th>
                                <td class="table-cell-custom">
                                    <input type="text" name="title" class="form-control form-control-sm" value="{{ old('title') }}" placeholder="공지사항 제목을 입력하세요" required>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-custom">내용 <span class="text-danger ml-1">*</span></th>
                                <td class="table-cell-custom">
                                    <textarea name="content" id="editor" class="form-control">{{ old('content') }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-custom">첨부파일</th>
                                <td class="table-cell-custom">
                                    <div id="file-input-container">
                                        <div class="d-flex align-items-center mb-2 file-input-group">
                                            <input type="text" class="form-control form-control-sm mr-2 file-name-display" readonly style="width: 300px; background-color: #fff;">
                                            <input type="file" name="attachments[]" class="file-input-hidden" style="display: none;">
                                            <button type="button" class="btn btn-sm btn-secondary px-3 btn-find-file mr-2" style="background-color: #6c757d; border-color: #6c757d;">파일찾기</button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary btn-add-file" style="border-radius: 4px; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div id="selected-files-list" class="mt-2">
                                        {{-- 선택된 파일들이 여기에 리스트업됩니다 --}}
                                    </div>
                                    <p class="text-muted small mt-2 mb-0">첨부파일은 최대 3개까지 등록 가능합니다.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 mb-5">
                    <p class="text-danger small mb-0 mr-auto">* 표시항목은 필수입력 항목입니다.</p>
                    <div class="d-flex">
                        <a href="{{ route('HNA_Customer_Noticelist_001') }}" class="btn btn-sm btn-outline-custom px-4 py-2 mr-2" style="min-width: 80px;">취소</a>
                        <button type="submit" class="btn btn-sm text-white px-4 py-2" style="background-color: #5d401a; border: 1px solid #5d401a; min-width: 80px; font-weight: 500;">등록</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Summernote 초기화
    $('#editor').summernote({
        placeholder: '내용을 입력해 주세요.',
        tabsize: 2,
        height: 400,
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

    // 초기 파일찾기 이벤트 연결
    setupFileInputGroup(container.querySelector('.file-input-group'));

    function setupFileInputGroup(group) {
        const fileInput = group.querySelector('.file-input-hidden');
        const findBtn = group.querySelector('.btn-find-file');
        const nameDisplay = group.querySelector('.file-name-display');

        if (findBtn && fileInput) {
            findBtn.addEventListener('click', () => fileInput.click());
            fileInput.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    nameDisplay.value = this.files[0].name;
                }
            });
        }
    }

    container.addEventListener('click', function(e) {
        if (e.target.closest('.btn-add-file')) {
            const currentInputs = container.querySelectorAll('.file-input-group').length;
            if (currentInputs < maxFiles) {
                const newGroup = document.createElement('div');
                newGroup.className = 'd-flex align-items-center mb-2 file-input-group';
                newGroup.innerHTML = `
                    <input type="text" class="form-control form-control-sm mr-2 file-name-display" readonly style="width: 300px; background-color: #fff;">
                    <input type="file" name="attachments[]" class="file-input-hidden" style="display: none;">
                    <button type="button" class="btn btn-sm btn-secondary px-3 btn-find-file mr-2" style="background-color: #6c757d; border-color: #6c757d;">파일찾기</button>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-file" style="border-radius: 4px; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;"><i class="fas fa-minus"></i></button>
                `;
                container.appendChild(newGroup);
                setupFileInputGroup(newGroup);
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
