@extends('front.layouts.layout')

@section('title', '로그인')

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
      <a href="{{ route('front.login') ?? '#' }}" class="item">로그인</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">로그인</h2>
      <h3 class="tit3">하늘누리 추모공원</h3>
    </div>
    <div class="wrap-login customer">
      <div class="login-cont">
        <form action="" class="form-login" id="loginForm" onsubmit="return validateLogin()">
          <div class="form-tit">아이디</div>
          <div class="input-group">
            <input
              type="text"
              name="userid"
              id="userId"
              class="input-box"
              placeholder="아이디를 입력해주세요."
            />
          </div>
          <div class="form-tit">비밀번호</div>
          <div class="input-group">
            <input
              type="password"
              name="password"
              id="userPw"
              class="input-box"
              placeholder="비밀번호를 입력해주세요."
            />
          </div>
          <div class="wrap-btn">
            <button type="submit" class="btn primary h56 full">
              <span>로그인</span>
            </button>
          </div>
        </form>
        <div class="wrap-find">
          <button class="btn empty" id="popupJoinBtn" onclick="location.href='{{ route('front.join01') ?? '#' }}'">회원가입</button>
          <button class="btn empty" id="popupFindIdBtn" onclick="location.href='{{ route('front.findid') ?? '#' }}'">아이디 찾기</button>
          <button class="btn empty" id="popupFindPasswordBtn" onclick="location.href='{{ route('front.findpassword') ?? '#' }}'">비밀번호 찾기</button>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@push('scripts')
<script>
  function validateLogin() {
    var userId = document.getElementById('userId').value.trim();
    var userPw = document.getElementById('userPw').value.trim();

    if (!userId || !userPw) {
      commonModal.show("알림", "ID, 비밀번호를 확인하시고 다시 로그인 해주시기 바랍니다.");
      return false;
    }
    
    fetch("{{ route('front.login.post') }}", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": "{{ csrf_token() }}",
        "Accept": "application/json"
      },
      body: JSON.stringify({
        username: userId,
        password: userPw
      })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        location.href = data.redirect;
      } else {
        commonModal.show("알림", data.message || "ID, 비밀번호를 확인하시고 다시 로그인 해주시기 바랍니다.");
      }
    })
    .catch(error => {
      console.error('Error:', error);
      commonModal.show("알림", "로그인 처리 중 오류가 발생했습니다.");
    });

    return false;
  }
</script>
@endpush
