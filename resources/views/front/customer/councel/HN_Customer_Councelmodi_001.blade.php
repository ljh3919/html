@extends('front.layouts.layout')

@section('title', '1:1 상담 수정')

@section('content')
<main>
  <div class="main">
    <div class="breadcrumb">
      <a href="#" class="item">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="16"
          height="16"
          viewBox="0 0 16 16"
          fill="none"
        >
          <path
            d="M2 5.99992L8 1.33325L14 5.99992V13.3333C14 13.6869 13.8595 14.026 13.6095 14.2761C13.3594 14.5261 13.0203 14.6666 12.6667 14.6666H3.33333C2.97971 14.6666 2.64057 14.5261 2.39052 14.2761C2.14048 14.026 2 13.6869 2 13.3333V5.99992Z"
            stroke="#333333"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
          <path
            d="M6 14.6667V8H10V14.6667"
            stroke="#333333"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
      </a>
      <a href="{{ route('front.notice.index') }}" class="item">고객센터</a>
      <a href="{{ route('front.customer.councel.index') }}" class="item">1:1 상담</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">1:1 상담</h2>
      <div class="tit2-sub">
        “마음을 다해 듣고, 정성을 다해 답하겠습니다.”
      </div>
      <div class="desc">
        말로 다 전하기 어려운 유족분들의 고민과 궁금증을 귀 기울여
        듣겠습니다. 하늘누리가 가족의 마음으로 함께 고민하고 답변해
        드립니다.
      </div>
    </div>
    <div class="wrap-login customer horizontal">
      <div class="login-cont">
        <form action="{{ route('front.customer.councel.update', $inquiry->id) }}" method="POST" class="form-login counsel" id="counselForm">
          @csrf
          @method('PUT')
          <div class="form-tit">작성자</div>
          <div class="input-group">
            <input
              type="text"
              class="input-box"
              value="{{ $inquiry->username }}"
              readonly
              style="background-color:#f5f5f5;"
            />
          </div>
          <div class="form-tit">E-Mail</div>
          <div class="input-group">
            <input
              type="email"
              name="email"
              class="input-box @error('email') input-error @enderror"
              placeholder="E-Mail을 입력해주세요."
              value="{{ old('email', $inquiry->email) }}"
            />
            @error('email')
            <span class="error-message error-m">
              <span class="error-icon">!</span>
              {{ $message }}
            </span>
            @enderror
          </div>
          <div class="form-tit required">제목</div>
          <div class="input-group">
            <input
              type="text"
              name="title"
              id="title"
              class="input-box @error('title') input-error @enderror"
              placeholder="제목을 입력해주세요."
              value="{{ old('title', $inquiry->title) }}"
            />
            @error('title')
            <span class="error-message error-m">
              <span class="error-icon">!</span>
              {{ $message }}
            </span>
            @enderror
          </div>
          <div class="form-tit required">문의내용</div>
          <div class="input-group">
            <textarea
              name="content"
              id="content"
              class="input-box input-box--textarea @error('content') input-error @enderror"
              placeholder="문의내용을 입력하세요."
            >{{ old('content', $inquiry->content) }}</textarea>
            @error('content')
            <span class="error-message error-m">
              <span class="error-icon">!</span>
              {{ $message }}
            </span>
            @enderror
          </div>
        </form>
        <div class="wrap-btn">
          <button type="button" class="btn h56 full" onclick="location.href='{{ route('front.customer.councel.index') }}'">
            <span>취소</span>
          </button>
          <button type="button" class="btn primary h56 full" onclick="validateAndSubmit()">
            <span>수정</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
function validateAndSubmit() {
    const title = document.getElementById('title').value.trim();
    const content = document.getElementById('content').value.trim();
    
    // Remove existing client-side error states
    document.querySelectorAll('.input-error').forEach(el => el.classList.remove('input-error'));
    document.querySelectorAll('.error-m').forEach(el => el.style.display = 'none');

    let hasError = false;
    if (title === '') {
        const titleInput = document.getElementById('title');
        titleInput.classList.add('input-error');
        hasError = true;
    }
    if (content === '') {
        const contentInput = document.getElementById('content');
        contentInput.classList.add('input-error');
        hasError = true;
    }

    if (hasError) {
        alert('필수 입력항목을 확인해주세요.');
        return false;
    }
    
    document.getElementById('counselForm').submit();
}
</script>
@endsection
