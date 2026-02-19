@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="font-weight-bold">상담 수정하기</h2>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-5">
            <form action="{{ route('front.inquiry.update', $inquiry->id) }}" method="POST" id="modify-form">
                @csrf
                @method('PUT')
                <div class="form-group row border-bottom pb-3">
                    <label class="col-sm-2 col-form-label font-weight-bold">작성자</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control-plaintext" value="{{ $member->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row border-bottom pb-3">
                    <label class="col-sm-2 col-form-label font-weight-bold">E-Mail <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" value="{{ old('email', $inquiry->email) }}" required>
                    </div>
                </div>

                <div class="form-group row border-bottom pb-3">
                    <label class="col-sm-2 col-form-label font-weight-bold">제목 <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" value="{{ old('title', $inquiry->title) }}" required>
                    </div>
                </div>

                <div class="form-group row border-bottom pb-3">
                    <label class="col-sm-2 col-form-label font-weight-bold">문의내용 <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea name="content" class="form-control" rows="10" required>{{ old('content', $inquiry->content) }}</textarea>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <a href="{{ route('HN_Customer_Councelview_001', $inquiry->id) }}" class="btn btn-outline-dark px-5 mr-2">취선</a>
                    <button type="submit" class="btn btn-dark px-5">수정</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#modify-form').on('submit', function(e) {
        let title = $('input[name="title"]').val();
        let content = $('textarea[name="content"]').val();

        if(!title || !content) {
            alert('입력항목을 다시한번 확인해주세요.');
            e.preventDefault();
        }
    });
</script>
@endpush
