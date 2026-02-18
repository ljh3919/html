@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">관리자사이트 > 고객센터 > 자료실 > 등록</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.reference.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row border-bottom pb-4">
                    <label class="col-sm-2 col-form-label font-weight-bold">제목 <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="자료 제목을 입력하세요">
                    </div>
                </div>

                <div class="form-group row border-bottom pb-4">
                    <label class="col-sm-2 col-form-label font-weight-bold">내용 <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea name="content" id="editor" class="form-control" rows="10">{{ old('content') }}</textarea>
                        <p class="text-muted small mt-2">웹 에디터 영역</p>
                    </div>
                </div>

                <div class="form-group row border-bottom pb-4">
                    <label class="col-sm-2 col-form-label font-weight-bold">첨부파일</label>
                    <div class="col-sm-10">
                        <div id="file-input-container">
                            <div class="d-flex align-items-center mb-2 file-input-group">
                                <input type="file" name="attachments[]" class="form-control-file w-auto mr-2">
                                <button type="button" class="btn btn-sm btn-outline-primary btn-add-file"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <p class="text-muted small mt-2">첨부파일은 최대 3개까지 등록 가능합니다.</p>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary px-5 mr-2">등록</button>
                    <a href="{{ route('HNA_Customer_Referenlist_001') }}" class="btn btn-secondary px-5">취소</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
