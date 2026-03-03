@extends('frontend.layouts.layout')

@section('title', '비밀번호 변경')

@section('content')
<main>
  <div class="main">
    <div class="breadcrumb">
      <a href="{{ route('frontend.index') ?? '#' }}" class="item">
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
      <a href="{{ route('frontend.myinfo') ?? '#' }}" class="item">나의 정보</a>
      <a href="{{ route('frontend.change_password') ?? '#' }}" class="item">비밀번호 변경</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">비밀번호 변경</h2>
    </div>
    <div class="wrap-login customer">
      <div class="login-cont">
        <form action="" class="form-login" id="changePasswordForm" onsubmit="return validateChangePassword()">
          <div class="form-tit required">기존 비밀번호</div>
          <div class="input-group">
            <input
              type="password"
              id="currentPassword"
              class="input-box"
              placeholder="기존 비밀번호를 입력하세요"
            />
          </div>
          <div class="form-tit required">변경 비밀번호</div>
          <div class="input-group">
            <input
              type="password"
              id="newPassword"
              class="input-box"
              placeholder="변경 비밀번호를 입력해주세요."
            />
          </div>
          <div class="form-tit required">변경 비밀번호 확인</div>
          <div class="input-group">
            <input
              type="password"
              id="newPasswordConfirm"
              class="input-box"
              placeholder="변경 비밀번호를 입력해주세요."
            />
          </div>
          <div class="wrap-btn">
            <button type="button" class="btn h56 full" onclick="history.back()">
              <span>취소</span>
            </button>
            <button type="submit" class="btn primary h56 full">
              <span>확인</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<script>
  function validateChangePassword() {
    var currentPw = document.getElementById('currentPassword').value;
    var newPw = document.getElementById('newPassword').value;
    var newPwConfirm = document.getElementById('newPasswordConfirm').value;

    if (!currentPw || !newPw || !newPwConfirm) {
      commonModal.show("알림", "모든 항목을 입력해 주세요.");
      return false;
    }

    if (newPw !== newPwConfirm) {
      commonModal.show("알림", "변경 할 비밀번호가 일치하지 않습니다.");
      return false;
    }

    // Complexity check: 8~16 chars
    if (newPw.length < 8 || newPw.length > 16) {
      commonModal.show("알림", "비밀번호는 최소 8자리에서 최대 16자리여야 합니다.");
      return false;
    }

    fetch("{{ route('frontend.change_password.post') }}", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        "Accept": "application/json"
      },
      body: JSON.stringify({
        current_password: currentPw,
        password: newPw,
        password_confirmation: newPwConfirm
      })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        commonModal.show("알림", data.message, function() {
          location.href = data.redirect;
        });
      } else {
        commonModal.show("알림", data.message || "비밀번호 변경 중 오류가 발생했습니다.");
      }
    })
    .catch(error => {
      console.error('Error:', error);
      commonModal.show("알림", "네트워크 오류가 발생했습니다.");
    });

    return false;
  }
</script>
      </div>
    </div>
  </div>
</main>
@endsection
