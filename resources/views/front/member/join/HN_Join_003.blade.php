@extends('front.layouts.layout')

@section('title', '회원가입')

@section('content')
<main>
  <div class="main">
    <div class="breadcrumb">
      <a href="{{ route('front.index') ?? '#' }}" class="item">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" style="width: 16px; height: 16px;">
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
      <a href="{{ route('front.join01') ?? '#' }}" class="item">회원가입</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">회원가입</h2>
      <div class="tit2-sub">
        회원가입을 하시면 하늘편지와 같은 온라인 추모관 및 다양한 서비스를
        이용하실 수 있습니다.
      </div>
    </div>
    <div class="wrap-step">
      <div class="item done">
        <div class="step">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M3.42773 9.85714L8.57059 15L17.5706 6" stroke="#CCC" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <span class="text">1. 약관동의</span>
      </div>
      <div class="item done">
        <div class="step">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M3.42773 9.85714L8.57059 15L17.5706 6" stroke="#CCC" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <span class="text">2. 정보입력</span>
      </div>
      <div class="item active">
        <div class="step">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="20"
            height="20"
            viewBox="0 0 20 20"
            fill="none"
          >
            <path
              d="M3.42773 9.85714L8.57059 15L17.5706 6"
              stroke="#65451E"
              stroke-width="3"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>
        <span class="text">3. 가입완료</span>
      </div>
    </div>
    <div class="form-box">
      <div class="tit"><strong id="registeredName">회원</strong>님 반갑습니다.</div>
      <p>정상적으로 하늘누리 온라인 회원에 가입되셨습니다.</p>
      <p>지금부터 하늘누리의 모든 서비스를 이용하실 수 있습니다.</p>
    </div>
    <div class="wrap-btn-bottom">
      <button type="button" class="btn primary h56" onclick="location.href='{{ route('front.index') ?? '#' }}'">
        <span>메인 화면으로 가기</span>
      </button>
    </div>
  </div>
</main>
@endsection

@push('scripts')
<script>
  (function() {
    var urlParams = new URLSearchParams(window.location.search);
    var userName = urlParams.get('name');
    if (userName) {
      document.getElementById('registeredName').innerText = userName;
    }
  })();
</script>
@endpush
