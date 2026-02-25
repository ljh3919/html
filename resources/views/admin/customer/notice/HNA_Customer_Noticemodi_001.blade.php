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
        <div class="alert alert-danger border-0 shadow-sm mb-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.notice.update', $notice->id) }}" method="POST" enctype="multipart/form-data" id="noticeForm">
        @csrf
        @method('PUT')
        <table class="table board-table vertical-table">
            <tbody>
                <tr>
                    <th class="required">제목</th>
                    <td>
                        <div class="wrap-form">
                            <div class="input-group h30" style="width: 100%">
                                <input type="text" name="title" class="input-box" style="min-width: 100%" value="{{ old('title', $notice->title) }}" placeholder="공지사항 제목을 입력하세요" required />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="required">내용</th>
                    <td>
                    <div class="wrap-form">
                        <div class="input-group textarea">
                            <textarea name="content" id="editor" class="input-box input-box--textarea" required>{{ old('content', $notice->content) }}</textarea>
                        </div>
                    </div>
                    </td>
                </tr>
                <tr>
                    <th>첨부파일</th>
                    <td>
                        <div id="file-input-container">
                            <!-- 신규 파일 업로드 -->
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

                            <!-- 기존 파일 목록 -->
                            @if($notice->attachments->count() > 0)
                                @foreach($notice->attachments as $attachment)
                                    <div class="wrap-file">
                                        <span class="file-name">{{ $attachment->original_name }}</span>
                                        <div class="wrap-file-delete">
                                            <input type="checkbox" name="delete_attachments[]" value="{{ $attachment->id }}" class="delete-file-checkbox" style="display: none;" />
                                            <button type="button" class="btn line icon h30 btn-delete-existing-file" title="파일 삭제">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M5 19L19 5" stroke="#161616" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
                                                    <path d="M5 5L19 19" stroke="#161616" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="text-info">
                            • 첨부파일은 최대 3개까지 등록 가능합니다. (기존 파일 포함, 개당 10MB)
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- board button -->
        <div class="wrap-board-btn">
            <div class="text-info">표시항목은 필수입력 항목입니다.</div>
            <div class="wrap-btn-right">
                <button type="button" class="btn line small" onclick="location.href='{{ route('HNA_Customer_Noticeview_001', $notice->id) }}'">
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
    const existingFilesCount = {{ $notice->attachments->count() }};
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

    container.addEventListener('click', function (e) {
        if (e.target.closest('.btn-add-file')) {
            const currentInputs = container.querySelectorAll('.file-input-group').length;
            const checkedDeleteCount = document.querySelectorAll('.delete-file-checkbox:checked').length;
            const activeFiles = existingFilesCount - checkedDeleteCount + currentInputs;

            if (activeFiles < maxFiles) {
                const newGroup = document.createElement('div');
                newGroup.className = 'wrap-find-file file-input-group';
                newGroup.innerHTML = `
                    <div class="input-group h30 no-max-width" style="width: 400px">
                        <input type="text" class="input-box file-name-display" readonly placeholder="파일을 선택하세요" />
                    </div>
                    <button type="button" class="btn h30 btn-find-file">
                        <span>파일찾기</span>
                    </button>
                    <input type="file" name="attachments[]" class="file-input-real" style="display: none;">
                    <button type="button" class="btn line icon h30 btn-remove-file">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M5 19L19 5" stroke="#161616" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
                            <path d="M5 5L19 19" stroke="#161616" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
                        </svg>
                    </button>
                `;
                container.appendChild(newGroup);
                setupFileInputGroup(newGroup); // Setup the new group
                updateAddButtonStatus();
            } else {
                alert('첨부파일은 최대 3개까지만 등록 가능합니다.');
            }
        } else if (e.target.closest('.btn-remove-file')) {
            e.target.closest('.file-input-group').remove();
            updateAddButtonStatus();
        }
    });

    // 기존 파일 삭제 버튼 클릭 처리
    $(document).on('click', '.btn-delete-existing-file', function() {
        const wrap = $(this).closest('.wrap-file');
        const checkbox = wrap.find('.delete-file-checkbox');
        const isChecked = checkbox.prop('checked');
        
        checkbox.prop('checked', !isChecked);
        
        if (!isChecked) {
            wrap.find('.file-name').css({
                'text-decoration': 'line-through',
                'color': '#adb5bd'
            });
            $(this).addClass('active');
        } else {
            wrap.find('.file-name').css({
                'text-decoration': 'none',
                'color': '#333'
            });
            $(this).removeClass('active');
        }
        updateAddButtonStatus(); // Update status after toggling delete
    });

    function updateAddButtonStatus() {
        // 이 함수는 단순히 현재 추가된 input 그룹의 개수와 기존 파일의 개수를 고려하여 alert를 띄울지 판단하는 용도로 사용됩니다.
        // (Note: The original function comment is kept as per instructions, but the logic for enabling/disabling the add button would go here if needed.)
    }
});
</script>
@endsection
