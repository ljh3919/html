@extends('front.layouts.layout')

@section('title', '사이버추모관 - 하늘편지 상세')

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
        차마 다 전하지 못한 말들이 구름을 타고 그리운 이에게 전해집니다.
        당신의 진심을 담아 따뜻한 안부를 띄워주세요.
      </div>
    </div>
  </div>
  <div class="main">
    <div class="wrap-notice-lists">
      <div class="wrap-counsel">
        <div class="wrap-counsel-text">
          <div class="wrap-counsel-text-body letter">
            <div style="white-space: pre-wrap;">{{ $letter->content }}</div>
            <div class="wrap-writer">
              <div class="item">
                <div class="label">작성자</div>
                <div class="name">{{ $letter->author_description }}</div>
              </div>
              <div class="item">
                <div class="label">작성일</div>
                <div class="name">{{ $letter->created_at->format('Y-m-d') }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="wrap-btn">
        <button type="button" onclick="location.href='{{ route('front.memorial.letterlist') }}'" class="btn primary h56">
          <span>목록</span>
        </button>
        @if(auth()->guard('member')->check() && auth()->guard('member')->user()->username === $letter->username)
        <button type="button" onclick="deleteLetter()" class="btn line h56">
          <span>삭제</span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
          >
            <path
              d="M19.1119 3.78107H13.7778C13.7778 3.29377 13.3801 2.89941 12.8886 2.89941H11.1113C10.6187 2.89941 10.2221 3.29377 10.2221 3.78107H4.88804C4.39657 3.78107 4 4.17546 4 4.66276C4 5.14893 4.39772 5.54442 4.88804 5.54442H19.1119C19.6034 5.54442 20 5.14893 20 4.66276C20.0011 4.17659 19.6034 3.78107 19.1119 3.78107Z"
              fill="#4A4A4A"
            />
            <path
              d="M17.2722 8.49089L16.4013 17.9706C16.3978 18.0091 16.3956 18.0465 16.3944 18.0862H7.60642C7.60527 18.0477 7.60294 18.0102 7.59951 17.9706L6.72864 8.49089H17.2722ZM17.3351 6.67768H6.6669C5.68626 6.67768 4.88845 7.46645 4.88845 8.43992L5.77768 18.1361C5.77768 19.1084 6.5732 19.8994 7.55612 19.8994H16.4447C17.4265 19.8994 18.2231 19.1095 18.2231 18.1361L19.1123 8.43992C19.1123 7.46645 18.3157 6.67768 17.3351 6.67768Z"
              fill="#4A4A4A"
            />
            <path
              d="M12.0006 17.066C11.6851 17.066 11.4291 16.8121 11.4291 16.4993V10.3729C11.4291 10.0602 11.6851 9.80631 12.0006 9.80631C12.316 9.80631 12.572 10.0602 12.572 10.3729V16.4993C12.572 16.8121 12.316 17.066 12.0006 17.066Z"
              fill="#4A4A4A"
            />
            <path
              d="M9.51043 17.0654C9.22013 17.0654 8.97096 16.8467 8.94238 16.5543L8.33548 10.4279C8.30576 10.1163 8.53553 9.83863 8.8487 9.80917C9.16186 9.78537 9.44416 10.0064 9.47388 10.318L10.0808 16.4444C10.1105 16.756 9.88073 17.0337 9.56757 17.0643C9.54814 17.0643 9.52986 17.0654 9.51043 17.0654Z"
              fill="#4A4A4A"
            />
            <path
              d="M14.491 17.0654C14.7813 17.0654 15.0304 16.8467 15.059 16.5543L15.6659 10.4279C15.6956 10.1163 15.4659 9.83863 15.1528 9.80917C14.8396 9.78537 14.5573 10.0064 14.5276 10.318L13.9207 16.4444C13.891 16.756 14.1207 17.0337 14.4338 17.0643C14.4533 17.0643 14.4727 17.0654 14.491 17.0654Z"
              fill="#4A4A4A"
            />
          </svg>
        </button>
        <button type="button" onclick="location.href='{{ route('front.memorial.letteredit', $letter->id) }}'" class="btn primary h56">
          <span>수정</span>
        </button>
        <form id="deleteForm" action="{{ route('front.memorial.letterdelete', $letter->id) }}" method="POST" style="display: none;">
          @csrf
          @method('DELETE')
        </form>
        @endif
      </div>
    </div>
  </div>
</main>

<script>
  function deleteLetter() {
    commonModal.show('확인', '삭제하시겠습니까?', (isConfirm) => {
      if (isConfirm) {
        document.getElementById('deleteForm').submit();
      }
    }, true);
  }
</script>
@endsection
