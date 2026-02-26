@extends('layouts.admin')

@section('styles')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
    .note-editor.note-lite {
        border-color: #dee2e6;
    }
</style>
@endsection

@section('content')
<!-- title -->
<div class="wrap-tit">
    <h2 class="tit01">자료실</h2>
</div>

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        {{ $errors->first() }}
    </div>
@endif

<form action="{{ route('admin.reference.update', $reference->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <table class="table board-table vertical-table">
        <tr>
            <th class="required">제목</th>
            <td>
                <div class="wrap-form">
                    <div class="input-group h30" style="width: 100%">
                        <input type="text" name="title" class="input-box" style="min-width: 100%" value="{{ old('title', $reference->title) }}" placeholder="자료 제목을 입력하세요" required />
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th class="required">내용</th>
            <td>
                <div class="wrap-form">
                    <div class="input-group textarea no-max-width">
                        <textarea name="content" id="editor" class="input-box input-box--textarea" required>{{ old('content', $reference->content) }}</textarea>
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
                            <input type="text" class="input-box file-name-display" readonly placeholder="새 파일을 선택하세요" />
                        </div>
                        <button type="button" class="btn h30 btn-find-file">
                            <span>파일찾기</span>
                        </button>
                        <input type="file" name="attachments[]" class="file-input-real" style="display: none;">
                        <button type="button" class="btn line icon h30 btn-add-file">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 6V18" stroke="#555555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M18 12H6" stroke="#555555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>

                    <!-- 기존 파일 목록 -->
                    @if($reference->attachments->count() > 0)
                        @foreach($reference->attachments as $attachment)
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
                    • 첨부파일은 최대 3개까지 등록 가능합니다. (개당 10MB)
                </div>
            </td>
        </tr>
    </table>

    <!-- board button -->
    <div class="wrap-board-btn">
        <div class="wrap-btn-left">
            <div class="text-info">표시항목은 필수입력 항목입니다.</div>
        </div>
        <div class="wrap-btn-right">
            <button type="button" class="btn line small" onclick="location.href='{{ route('HNA_Customer_Referenview_001', $reference->id) }}'">
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

    // 파일찾기 버튼 클릭 이벤트
    $(document).on('click', '.btn-find-file', function() {
        $(this).closest('.file-input-group').find('.file-input-real').click();
    });

    // 파일 선택 시 파일명 표시
    $(document).on('change', '.file-input-real', function() {
        const fileName = $(this).val().split('\\').pop();
        $(this).closest('.wrap-find-file').find('.file-name-display').val(fileName);
    });

    container.addEventListener('click', function(e) {
        if (e.target.closest('.btn-add-file')) {
            const currentInputs = container.querySelectorAll('.file-input-group').length;
            const checkedDeleteCount = document.querySelectorAll('.delete-file-checkbox:checked').length;
            const activeFiles = existingFilesCount - checkedDeleteCount + currentInputs;

            if (activeFiles < maxFiles) {
                const newGroup = document.createElement('div');
                newGroup.className = 'wrap-find-file file-input-group';
                newGroup.innerHTML = `
                    <div class="input-group h30 no-max-width" style="width: 400px">
                        <input type="text" class="input-box file-name-display" readonly placeholder="새 파일을 선택하세요" />
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
                const addBtnRow = e.target.closest('.file-input-group');
                addBtnRow.after(newGroup);
            } else {
                alert('첨부파일은 최대 3개까지만 등록 가능합니다.');
            }
        } else if (e.target.closest('.btn-remove-file')) {
            e.target.closest('.file-input-group').remove();
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
            $(this).addClass('active'); // 삭제됨 표시용 클래스 (필요시 CSS 추가)
        } else {
            wrap.find('.file-name').css({
                'text-decoration': 'none',
                'color': '#333'
            });
            $(this).removeClass('active');
        }
    });
});
</script>
@endsection
