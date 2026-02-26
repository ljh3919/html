@extends('layouts.admin')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
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
    <h2 class="tit01">팝업 관리</h2>
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

<form id="popup-form" action="{{ route('admin.popup.update', $popup->id) }}" method="POST">
    @csrf
    @method('PUT')
    <!-- table -->
    <table class="table board-table vertical-table">
        <tr>
            <th>제목</th>
            <td>
                <div class="wrap-form">
                    <div class="input-group h30" style="width: 100%">
                        <input type="text" name="title" class="input-box" style="min-width: 100%" value="{{ old('title', $popup->title) }}" placeholder="팝업 제목을 입력하세요" />
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th>적용일시</th>
            <td>
                <div class="wrap-calendar">
                    <div class="wrap-form mr-2">
                        <div class="input-group h30">
                            <input type="date" name="start_date" class="input-box" value="{{ old('start_date', $popup->start_at->format('Y-m-d')) }}">
                        </div>
                    </div>
                    <div class="select-wrapper">
                        <select name="start_hour" class="input-box select h30">
                            @for($i=0; $i<24; $i++)
                                <option value="{{ $i }}" {{ old('start_hour', $popup->start_at->hour) == $i ? 'selected' : '' }}>{{ sprintf('%02d', $i) }} 시</option>
                            @endfor
                        </select>
                    </div>
                    <span class="mx-2">~</span>
                    <div class="wrap-form mr-2">
                        <div class="input-group h30">
                            <input type="date" name="end_date" class="input-box" value="{{ old('end_date', $popup->end_at->format('Y-m-d')) }}">
                        </div>
                    </div>
                    <div class="select-wrapper">
                        <select name="end_hour" class="input-box select h30">
                            @for($i=0; $i<24; $i++)
                                <option value="{{ $i }}" {{ old('end_hour', $popup->end_at->hour) == $i ? 'selected' : '' }}>{{ sprintf('%02d', $i) }} 시</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th>노출여부</th>
            <td>
                <div class="custom-control custom-switch mt-1">
                    <input type="checkbox" name="is_visible" class="custom-control-input" id="is_visible" value="1" {{ old('is_visible', $popup->is_visible) ? 'checked' : '' }}>
                    <label class="custom-control-label font-weight-normal" for="is_visible" style="cursor: pointer;">노출함</label>
                </div>
            </td>
        </tr>
        <tr>
            <th>내용</th>
            <td>
                <div class="wrap-form">
                    <div class="input-group textarea">
                        <textarea name="content" id="editor" class="input-box input-box--textarea" placeholder="내용을 입력하세요.">{{ old('content', $popup->content) }}</textarea>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <!-- board button -->
    <div class="wrap-board-btn">
        <div class="wrap-btn-left"></div>
        <div class="wrap-btn-right">
            <button type="button" class="btn line small" onclick="location.href='{{ route('HNA_Popup_Detail_001', $popup->id) }}'">
                <span>취소</span>
            </button>
            <button type="button" class="btn line small" id="popupPreviewBtn" onclick="openPreview()">
                <span>미리보기</span>
            </button>
            <button type="submit" class="btn primary small">
                <span>수정</span>
            </button>
        </div>
    </div>
</form>

<!-- popup preview modal -->
<div class="popup-overlay" id="popupPreviewOverlay" aria-hidden="true">
    <div class="wrap-popup" role="dialog" aria-labelledby="popupPreviewTitle">
        <div class="popup-header">
            <h3 class="popup-tit" id="popupPreviewTitle">팝업 미리보기</h3>
            <button type="button" class="popup-close" id="popupPreviewClose" aria-label="닫기">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                    <path d="M4 28L28 4" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                    <path d="M4 4L28 28" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                </svg>
            </button>
        </div>
        <div class="popup-body">
            <div class="popup-cont" id="popupPreviewContent">
                <!-- Content will be injected here -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$(document).ready(function() {
    $('#editor').summernote({
        placeholder: '팝업 내용을 입력해 주세요.',
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
    // 미리보기 닫기 이벤트
    $('#popupPreviewClose').on('click', function() {
        $('#popupPreviewOverlay').removeClass('active').attr('aria-hidden', 'true');
    });

    $('#popupPreviewOverlay').on('click', function(e) {
        if (e.target === this) {
            $(this).removeClass('active').attr('aria-hidden', 'true');
        }
    });
});

function openPreview() {
    const title = document.querySelector('input[name="title"]').value;
    const content = $('#editor').summernote('code');

    if (!title || content === '<p><br></p>') {
        alert('입력내용을 확인해주세요.');
        return;
    }

    const contentEl = document.getElementById("popupPreviewContent");
    contentEl.innerHTML = `
        <h2 class="tit">${title}</h2>
        <div class="wrap-cont popup-manage">
            ${content}
        </div>
    `;

    const overlay = document.getElementById("popupPreviewOverlay");
    overlay.classList.add("active");
    overlay.setAttribute("aria-hidden", "false");
}

document.getElementById('popup-form').addEventListener('submit', function(e) {
    const title = this.querySelector('input[name="title"]').value.trim();
    const content = $('#editor').summernote('code');
    
    if (!title || content === '<p><br></p>') {
        alert('입력내용을 확인해주세요.');
        e.preventDefault();
    }
});
</script>
@endsection
