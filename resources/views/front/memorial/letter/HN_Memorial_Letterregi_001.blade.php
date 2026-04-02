@extends('front.layouts.layout')

@section('title', '사이버추모관 - 하늘편지 작성')

@section('content')
<main>
  <div class="main counsel">
    <div class="breadcrumb">
      <a href="{{ route('front.index') }}" class="item">
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
      <a href="#" class="item">사이버 추모관</a>
      <a href="#" class="item">하늘편지</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">하늘편지</h2>
      <div class="tit2-sub">"닿지 못한 마음이 하늘에 닿는 곳"</div>
      <div class="desc">
        @if(request()->dead_name)
          <strong>故 {{ request()->dead_name }}님</strong>께 차마 다 전하지 못한 말들이 구름을 타고 그리운 이에게 전해집니다.<br>
        @else
          차마 다 전하지 못한 말들이 구름을 타고 그리운 이에게 전해집니다.
        @endif
        당신의 진심을 담아 따뜻한 안부를 띄워주세요.
      </div>
    </div>
    <div class="wrap-login customer horizontal">
      <div class="login-cont myinfo">
        <form id="letterForm" action="{{ route('front.memorial.letterstore') }}" method="POST" class="form-login counsel">
          @csrf
          <div class="form-tit">비밀글</div>
          <div class="input-group">
            <label class="checkbox-item">
              <input type="checkbox" name="is_private" value="1" class="checkbox-input client" />
            </label>
          </div>
          <div class="form-tit required">작성자</div>
          <div class="input-group">
            <input
              type="text"
              name="author_description"
              id="author_description"
              class="input-box"
              placeholder="작성자를 입력해주세요."
              maxlength="50"
            />
          </div>
          <div class="form-tit required">내용</div>
          <div class="input-group">
            <textarea
              name="content"
              id="content"
              class="input-box input-box--textarea"
              placeholder="내용을 입력하세요."
              maxlength="600"
            ></textarea>
            <div class="message">
              * 600자 이내로 작성하실 수 있습니다.
            </div>
          </div>
        </form>
          <div class="wrap-btn">
            <button type="button" onclick="location.href='{{ route('front.memorial.letterlist') }}'" class="btn h56 full">
              <span>목록</span>
            </button>
            <button type="submit" form="letterForm" class="btn primary h56 full">
              <span>작성완료</span>
            </button>
          </div>
      </div>
    </div>
  </div>
</main>

<script>
  (function() {
    const form = document.getElementById('letterForm');
    const author_description = document.getElementById('author_description');
    const content = document.getElementById('content');

    if (form) {
      form.addEventListener('submit', function(e) {
        if (!author_description.value.trim()) {
          e.preventDefault();
          commonModal.show('알림', '작성자를 입력해주세요.', () => {
            author_description.focus();
          });
          return;
        }
        if (!content.value.trim()) {
          e.preventDefault();
          commonModal.show('알림', '내용을 입력해주세요.', () => {
            content.focus();
          });
          return;
        }
      });
    }
  })();
</script>
@endsection
