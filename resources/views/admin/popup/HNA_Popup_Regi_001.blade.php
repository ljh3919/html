@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">관리자사이트 > 팝업 관리 > 등록</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form id="popup-form" action="{{ route('admin.popup.store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label font-weight-bold">제목 <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="팝업 제목을 입력하세요">
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label font-weight-bold">적용일시 <span class="text-danger">*</span></label>
                    <div class="col-sm-10 d-flex align-items-center">
                        <input type="date" name="start_date" class="form-control w-auto mr-2" value="{{ old('start_date', now()->format('Y-m-d')) }}">
                        <select name="start_hour" class="form-control w-auto mr-3">
                            @for($i=0; $i<24; $i++)
                                <option value="{{ $i }}" {{ old('start_hour') == $i ? 'selected' : '' }}>{{ sprintf('%02d', $i) }} 시</option>
                            @endfor
                        </select>
                        <span class="mr-3">~</span>
                        <input type="date" name="end_date" class="form-control w-auto mr-2" value="{{ old('end_date', now()->addDays(7)->format('Y-m-d')) }}">
                        <select name="end_hour" class="form-control w-auto">
                            @for($i=0; $i<24; $i++)
                                <option value="{{ $i }}" {{ old('end_hour', 23) == $i ? 'selected' : '' }}>{{ sprintf('%02d', $i) }} 시</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label font-weight-bold">내용 <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea name="content" id="content" class="form-control" rows="10" placeholder="팝업 내용을 입력하세요">{{ old('content') }}</textarea>
                        @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label font-weight-bold">노출여부</label>
                    <div class="col-sm-10">
                        <div class="custom-control custom-switch mt-2">
                            <input type="checkbox" name="is_visible" class="custom-control-input" id="is_visible" checked>
                            <label class="custom-control-label" for="is_visible">노출함</label>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button type="button" class="btn btn-info px-5 mr-2" onclick="openPreview()">미리보기</button>
                    <button type="submit" class="btn btn-primary px-5 mr-2">등록</button>
                    <a href="{{ route('HNA_Popup_List_001') }}" class="btn btn-secondary px-5">취소</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title">미리보기</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <iframe name="preview_iframe" id="preview_iframe" style="width: 100%; height: 600px; border: none;"></iframe>
            </div>
            <div class="modal-footer border-top-0 justify-content-center">
                <button type="button" class="btn btn-secondary px-5" data-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>

<script>
function openPreview() {
    const title = document.querySelector('input[name="title"]').value;
    const content = document.querySelector('textarea[name="content"]').value;

    if (!title || !content) {
        alert('입력내용을 확인해주세요.');
        return;
    }

    // Modal show using jQuery (standard in SB Admin 2 / Bootstrap 4)
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
    const content = this.querySelector('textarea[name="content"]').value.trim();
    
    if (!title || !content) {
        alert('입력내용을 확인해주세요.');
        e.preventDefault();
    }
});
</script>
@endsection
