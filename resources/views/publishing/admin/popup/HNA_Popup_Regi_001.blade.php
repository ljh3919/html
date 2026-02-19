@extends('layouts.publishing_blank')

@section('styles')
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
    .modal-header-custom {
        background-color: #5d401a;
        color: #fff;
        border-bottom: none;
        padding: 15px 25px;
    }
    .modal-header-custom .close {
        color: #fff;
        opacity: 0.8;
        padding: 1.5rem 1.5rem;
        margin: -1.5rem -1.5rem -1.5rem auto;
    }
    .modal-header-custom .close:hover {
        opacity: 1;
    }
</style>
@endsection

@section('content')
<div class="container-fluid text-black">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <div style="font-size: 1.5rem; font-weight: 700; color: #000;">• 팝업 관리</div>
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
            <form id="popup-form" action="{{ route('admin.popup.store') }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <colgroup>
                            <col style="width: 200px;">
                            <col>
                        </colgroup>
                        <tbody>
                            <tr>
                                <th class="table-header-custom">제목 <span class="text-danger">*</span></th>
                                <td class="table-cell-custom">
                                    <input type="text" name="title" class="form-control form-control-sm" value="{{ old('title') }}" placeholder="팝업 제목을 입력하세요">
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-custom">적용일시 <span class="text-danger">*</span></th>
                                <td class="table-cell-custom">
                                    <div class="d-flex align-items-center">
                                        <input type="date" name="start_date" class="form-control form-control-sm w-auto mr-2" value="{{ old('start_date', now()->format('Y-m-d')) }}">
                                        <select name="start_hour" class="form-control form-control-sm w-auto mr-3">
                                            @for($i=0; $i<24; $i++)
                                                <option value="{{ $i }}" {{ old('start_hour') == $i ? 'selected' : '' }}>{{ sprintf('%02d', $i) }} 시</option>
                                            @endfor
                                        </select>
                                        <span class="mr-3">~</span>
                                        <input type="date" name="end_date" class="form-control form-control-sm w-auto mr-2" value="{{ old('end_date', now()->addDays(7)->format('Y-m-d')) }}">
                                        <select name="end_hour" class="form-control form-control-sm w-auto">
                                            @for($i=0; $i<24; $i++)
                                                <option value="{{ $i }}" {{ old('end_hour', 23) == $i ? 'selected' : '' }}>{{ sprintf('%02d', $i) }} 시</option>
                                            @endfor
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-custom">내용 <span class="text-danger">*</span></th>
                                <td class="table-cell-custom p-3" style="background-color: #fcfcfc;">
                                    <textarea name="content" id="editor" class="form-control">{{ old('content') }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-custom">노출여부</th>
                                <td class="table-cell-custom">
                                    <div class="custom-control custom-switch mt-1">
                                        <input type="checkbox" name="is_visible" class="custom-control-input" id="is_visible" checked>
                                        <label class="custom-control-label font-weight-normal" for="is_visible" style="cursor: pointer;">노출함</label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 mb-5">
                    <p class="text-danger small mb-0 mr-auto">* 표시항목은 필수입력 항목입니다.</p>
                    <div class="d-flex">
                        <a href="{{ route('HNA_Popup_List_001') }}" class="btn btn-sm btn-outline-custom px-4 py-2 mr-2" style="min-width: 80px;">취소</a>
                        <button type="button" class="btn btn-sm btn-outline-custom px-4 py-2 mr-2" style="min-width: 80px;" onclick="openPreview()">미리보기</button>
                        <button type="submit" class="btn btn-sm text-white px-4 py-2" style="background-color: #5d401a; border: 1px solid #5d401a; min-width: 80px; font-weight: 500;">등록</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 500px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title font-weight-bold" style="font-size: 1.1rem;">팝업 미리보기</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0 bg-white">
                <iframe name="preview_iframe" id="preview_iframe" style="width: 100%; height: 600px; border: none;"></iframe>
            </div>
            <div class="modal-footer border-top-0 justify-content-center pb-4 bg-white">
                <button type="button" class="btn btn-sm btn-outline-custom px-4" data-dismiss="modal" style="min-width: 80px;">닫기</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
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
});

function openPreview() {
    const title = document.querySelector('input[name="title"]').value;
    const content = $('#editor').summernote('code');

    if (!title || content === '<p><br></p>') {
        alert('입력내용을 확인해주세요.');
        return;
    }

    $('#previewModal').modal('show');

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("admin.popup.preview") }}';
    form.target = 'preview_iframe';

    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    form.appendChild(csrfToken);

    const titleInput = document.createElement('input');
    titleInput.type = 'hidden';
    titleInput.name = 'title';
    titleInput.value = title;
    form.appendChild(titleInput);

    const contentInput = document.createElement('input');
    contentInput.type = 'hidden';
    contentInput.name = 'content';
    contentInput.value = content;
    form.appendChild(contentInput);

    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
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

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
$(document).ready(function() {
    // Summernote 초기화
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
});

function openPreview() {
    const title = document.querySelector('input[name="title"]').value;
    const content = $('#editor').summernote('code');

    if (!title || content === '<p><br></p>') {
        alert('입력내용을 확인해주세요.');
        return;
    }

    $('#previewModal').modal('show');

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("admin.popup.preview") }}';
    form.target = 'preview_iframe';

    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    form.appendChild(csrfToken);

    const titleInput = document.createElement('input');
    titleInput.type = 'hidden';
    titleInput.name = 'title';
    titleInput.value = title;
    form.appendChild(titleInput);

    const contentInput = document.createElement('input');
    contentInput.type = 'hidden';
    contentInput.name = 'content';
    contentInput.value = content;
    form.appendChild(contentInput);

    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
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
