@extends('layouts.admin')

@section('styles')
<!-- include summernote lite css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')
    <!-- title -->
    <div class="wrap-tit">
        <h2 class="tit01">공지사항 관리</h2>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('admin.notice.store') }}" method="POST" enctype="multipart/form-data" id="noticeForm">
        @csrf
        <table class="table board-table vertical-table">
            <tbody>
                <tr>
                    <th class="required">제목</th>
                    <td>
                        <div class="wrap-form">
                            <div class="input-group h30" style="width: 100%">
                                <input type="text" name="title" class="input-box" style="min-width: 100%" value="{{ old('title') }}" placeholder="공지사항 제목을 입력하세요" required />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="required">내용</th>
                    <td>
                    <div class="wrap-form">
                        <div class="input-group textarea">
                            <textarea name="content" id="editor" class="input-box input-box--textarea" required>{{ old('content') }}</textarea>
                        </div>
                    </div>
                    </td>
                </tr>
                <tr>
                    <th>첨부파일</th>
                    <td>
                        <div id="file-input-container">
                            <div class="wrap-find-file file-input-group">
                                <div class="input-group h30 no-max-width" style="width: 400px">
                                    <input type="text" class="input-box file-name-display" readonly placeholder="파일을 선택하세요" />
                                </div>
                                <button type="button" class="btn h30 btn-find-file">
                                    <span>파일찾기</span>
                                </button>
                                <input type="file" name="attachments[]" class="file-input-real" style="display: none;" />
                                <button type="button" class="btn line icon h30 btn-add-file">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M12 6V18" stroke="#555555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M18 12H6" stroke="#555555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="text-info">
                            • 첨부파일은 최대 3개까지 등록 가능합니다. (개당 10MB)
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- board button -->
        <div class="wrap-board-btn">
            <div class="text-info">표시항목은 필수입력 항목입니다.</div>
            <div class="wrap-btn-right">
                <button type="button" class="btn line small" onclick="location.href='{{ route('HNA_Customer_Noticelist_001') }}'">
                    <span>취소</span>
                </button>
                <button type="submit" class="btn primary small">
                    <span>등록</span>
                </button>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$(document).ready(function() {
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

    // 파일찾기 버튼 클릭 시 실제 input 트리거
    $(document).on('click', '.btn-find-file', function() {
        $(this).next('.file-input-real').click();
    });

    function setupFileInputGroup(group) {
        const fileInput = group.querySelector('.file-input-real');
        const nameDisplay = group.querySelector('.file-name-display');

        if (fileInput && nameDisplay) {
            fileInput.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    nameDisplay.value = this.files[0].name;
                }
            });
        }
    }

    // 초기 그룹 설정
    setupFileInputGroup(container.querySelector('.file-input-group'));

    container.addEventListener('click', function(e) {
        if (e.target.closest('.btn-add-file')) {
            const currentInputs = container.querySelectorAll('.file-input-group').length;
            if (currentInputs < maxFiles) {
                const newGroup = document.createElement('div');
                newGroup.className = 'wrap-find-file file-input-group';
                newGroup.innerHTML = `
                    <div class="input-group h30" style="width: 400px">
                        <input type="text" class="input-box file-name-display" style="min-width: 100%" readonly placeholder="파일을 선택하세요" />
                    </div>
                    <button type="button" class="btn h30 btn-find-file">
                        <span>파일찾기</span>
                    </button>
                    <input type="file" name="attachments[]" class="file-input-real" style="display: none;" />
                    <button type="button" class="btn line icon h30 btn-remove-file">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M5 19L19 5" stroke="#161616" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
                            <path d="M5 5L19 19" stroke="#161616" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
                        </svg>
                    </button>
                `;
                const addBtnRow = e.target.closest('.file-input-group');
                addBtnRow.after(newGroup);
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
