@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="font-weight-bold">1:1 상담하기</h2>
        <p class="text-muted">무엇이든 물어보세요. 가족의 마음으로 정성껏 답변해 드리겠습니다.</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-5">
            <form action="{{ route('front.inquiry.store') }}" method="POST" id="inquiry-form">
                @csrf
                <div class="form-group row border-bottom pb-3">
                    <label class="col-sm-2 col-form-label font-weight-bold">작성자</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control-plaintext" value="{{ $member->name }}" readonly>
                    </div>
                </div>

                <div class="form-group row border-bottom pb-3">
                    <label class="col-sm-2 col-form-label font-weight-bold">E-Mail <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" value="{{ old('email', $member->email) }}" required>
                    </div>
                </div>

                <div class="form-group row border-bottom pb-3">
                    <label class="col-sm-2 col-form-label font-weight-bold">제목 <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" placeholder="제목을 입력하세요" value="{{ old('title') }}" required>
                    </div>
                </div>

                <div class="form-group row border-bottom pb-3">
                    <label class="col-sm-2 col-form-label font-weight-bold">문의내용 <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea name="content" class="form-control" rows="10" placeholder="상담 내용을 입력하세요" required>{{ old('content') }}</textarea>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <a href="{{ route('HN_Customer_Councellist_001') }}" class="btn btn-outline-dark px-5 mr-2">취소</a>
                    <button type="submit" class="btn btn-dark px-5">작성완료</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#inquiry-form').on('submit', function(e) {
        let title = $('input[name="title"]').val();
        let content = $('textarea[name="content"]').val();
        let email = $('input[name="email"]').val();

        if(!title || !content || !email) {
            alert('입력 내용을 확인해 주시기 바랍니다.');
            e.preventDefault();
        }
    });
</script>
@endpush
