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
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="20"
            height="20"
            viewBox="0 0 20 20"
            fill="none"
          >
            <path
              d="M3.42773 9.85714L8.57059 15L17.5706 6"
              stroke="#CCC"
              stroke-width="3"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>
        <span class="text">1. 약관동의</span>
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
        <span class="text">2. 정보입력</span>
      </div>
      <div class="item">
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
              stroke="#CCC"
              stroke-width="3"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>
        <span class="text">3. 가입완료</span>
      </div>
    </div>
    <form id="joinForm" class="form-box">
      <div class="input-group">
        <label class="input-label required">아이디</label>
        <div class="wrap-form-set">
          <input
            type="text"
            class="input-box"
            id="userId"
            name="userId"
            placeholder="아이디를 입력하세요"
          />
          <button type="button" class="btn h44" id="btnIdCheck">
            <span>중복확인</span>
          </button>
        </div>
        <span class="error-message" id="id-error" style="display:block;">
          <span class="error-icon">!</span>
          ID는 알파벳 영문 소문자 4자리에서 12자리까지 입력이 가능합니다.
        </span>
      </div>
      <div class="input-group">
        <label class="input-label required">이름</label>
        <div class="wrap-form-set">
          <input
            type="text"
            class="input-box"
            id="userName"
            name="userName"
            placeholder="이름을 입력하세요"
          />
        </div>
        <span class="error-message" id="name-error" style="display:none;">
          <span class="error-icon">!</span>
          한글 이름 5자리까지 입력이 가능합니다.
        </span>
      </div>
      <div class="input-group">
        <label class="input-label required">휴대전화</label>
        <div class="wrap-form-set">
          <div class="wrap-cell">
            <input type="text" class="input-box" id="userPhone1" name="userPhone1" maxlength="3" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />-
            <input type="text" class="input-box" id="userPhone2" name="userPhone2" maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />-
            <input type="text" class="input-box" id="userPhone3" name="userPhone3" maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
          </div>
          <button type="button" class="btn h44" id="btnRequestSms">
            <span>인증번호 요청</span>
          </button>
        </div>
        <span class="error-message" id="phone-error" style="display:none;">
          <span class="error-icon">!</span>
          '-'를 제외한 숫자만 입력이 가능합니다.
        </span>
      </div>
      <div class="input-group" id="smsVerificationGroup">
        <label class="input-label required">인증번호</label>
        <div class="wrap-form-set">
          <div style="position: relative; flex: 1; width: 100%;">
            <input
              type="text"
              class="input-box"
              id="smsCode"
              placeholder="인증번호를 입력하세요"
              disabled
            />
            <span id="smsTimer" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #FF0000; font-weight: bold; display: none;">01:00</span>
          </div>
          <button type="button" class="btn sma h44" id="btnVerifySms" disabled>
            <span>인증확인</span>
          </button>
        </div>
        <span class="error-message" id="sms-error" style="display:none;">
          <span class="error-icon">!</span>
          인증번호가 올바르지 않습니다. 확인 후 다시 입력해주시기 바랍니다.
        </span>
      </div>
      <div class="input-group">
        <label class="input-label required">이메일</label>
        <div class="wrap-email-inputs">
          <div class="wrap-form-set">
            <input
              type="text"
              class="input-box"
              id="userEmail1"
              name="userEmail1"
              placeholder="이메일을 입력하세요"
            />@
            <input
              type="text"
              id="userEmail2"
              name="userEmail2"
              class="input-box"
              placeholder="도메인을 입력하세요"
            />
          </div>
          <div class="select-wrapper">
            <select id="emailDomainSelect" class="input-box select">
              <option value="">직접입력</option>
              <option value="naver.com">naver.com</option>
              <option value="daum.net">daum.net</option>
              <option value="google.com">google.com</option>
            </select>
          </div>
        </div>
      </div>
      <div class="input-group">
        <label class="input-label required">비밀번호</label>
        <div class="wrap-form-set">
          <input
            type="password"
            class="input-box"
            id="userPw"
            name="userPw"
            placeholder="비밀번호를 입력하세요"
          />
        </div>
        <span class="error-message" id="pw-error" style="display:block;">
          <span class="error-icon">!</span>
          8자리 이상 16자리 이하 알파벳, 숫자, 특수기호의 조합으로 작성하셔야 합니다.
        </span>
      </div>
      <div class="input-group">
        <label class="input-label required">비밀번호 확인</label>
        <div class="wrap-form-set">
          <input
            type="password"
            class="input-box"
            id="userPwConfirm"
            placeholder="비밀번호를 다시 입력하세요"
          />
        </div>
        <span class="error-message" id="pwconfirm-error" style="display:none;">
          <span class="error-icon">!</span>
          일치하는 비밀번호를 입력하세요.
        </span>
      </div>
    </form>
    <div class="wrap-btn-bottom">
      <button type="button" class="btn primary h56" onclick="validateForm()">
        <span>확인</span>
      </button>
    </div>
  </div>
</main>
@endsection

@push('scripts')
<script>
  (function() {
    var emailDomainSelect = document.getElementById('emailDomainSelect');
    var userEmail2 = document.getElementById('userEmail2');

    if (emailDomainSelect && userEmail2) {
      emailDomainSelect.addEventListener('change', function() {
        if (this.value) {
          userEmail2.value = this.value;
          userEmail2.readOnly = true;
        } else {
          userEmail2.value = '';
          userEmail2.readOnly = false;
        }
      });
    }

    var isIdChecked = false;
    var isSmsVerified = false;
    var timerInterval = null;

    // 아이디 중복확인
    window.checkId = function() {
      var userId = document.getElementById('userId').value.trim();
      var idRegex = /^[a-z0-9]{4,12}$/;
      
      if (!idRegex.test(userId)) {
        commonModal.show("알림", "ID는 알파벳 영문 소문자 4자리에서 12자리까지 입력이 가능합니다.");
        return;
      }

      fetch("{{ route('front.check_id') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}",
          "Accept": "application/json"
        },
        body: JSON.stringify({ userId: userId })
      })
      .then(response => response.json())
      .then(data => {
        commonModal.show("알림", data.message);
        if (data.success) {
          isIdChecked = true;
          document.getElementById('userId').readOnly = true;
          document.getElementById('btnIdCheck').disabled = true;
        } else {
          isIdChecked = false;
        }
      });
    };

    // SMS 인증번호 요청
    window.requestSmsCode = function() {
      var phone1 = document.getElementById('userPhone1').value.trim();
      var phone2 = document.getElementById('userPhone2').value.trim();
      var phone3 = document.getElementById('userPhone3').value.trim();
      var phone = phone1 + phone2 + phone3;
      
      if (!phone1 || !phone2 || !phone3) {
        commonModal.show("알림", "휴대전화를 입력 후 인증번호요청을 해주시기 바랍니다.");
        return;
      }

      fetch("{{ route('front.send_sms') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}",
          "Accept": "application/json"
        },
        body: JSON.stringify({ phone: phone })
      })
      .then(response => response.json())
      .then(data => {
        commonModal.show("알림", data.message);
        if (data.success) {
          document.getElementById('smsCode').disabled = false;
          document.getElementById('btnVerifySms').disabled = false;
          document.getElementById('smsTimer').style.display = "block";
          startTimer(60);
        }
      })
      .catch(error => {
        console.error('Error:', error);
        commonModal.show("알림", "서버 통신 중 오류가 발생했습니다.");
      });
    };

    function startTimer(seconds) {
      clearInterval(timerInterval);
      var timeLeft = seconds;
      var display = document.getElementById('smsTimer');
      
      function updateDisplay() {
        var min = Math.floor(timeLeft / 60);
        var sec = timeLeft % 60;
        display.textContent = (min < 10 ? "0" + min : min) + ":" + (sec < 10 ? "0" + sec : sec);
      }

      updateDisplay();
      timerInterval = setInterval(function() {
        timeLeft--;
        if (timeLeft < 0) {
          clearInterval(timerInterval);
          display.textContent = "만료";
          alert("인증 시간이 만료되었습니다. 다시 시도해주세요.");
          document.getElementById('smsCode').disabled = true;
          document.getElementById('btnVerifySms').disabled = true;
        } else {
          updateDisplay();
        }
      }, 1000);
    }

    window.verifySmsCode = function() {
      var phone1 = document.getElementById('userPhone1').value.trim();
      var phone2 = document.getElementById('userPhone2').value.trim();
      var phone3 = document.getElementById('userPhone3').value.trim();
      var phone = phone1 + phone2 + phone3;
      var inputCode = document.getElementById('smsCode').value.trim();
      
      if (!inputCode) {
          commonModal.show("알림", "인증번호를 입력해주세요.");
          return;
      }

      fetch("{{ route('front.verify_sms') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}",
          "Accept": "application/json"
        },
        body: JSON.stringify({ phone: phone, code: inputCode })
      })
      .then(response => response.json())
      .then(data => {
        commonModal.show("알림", data.message);
        if (data.success) {
          isSmsVerified = true;
          clearInterval(timerInterval);
          document.getElementById('smsTimer').style.display = "none";
          document.getElementById('smsCode').readOnly = true;
          document.getElementById('btnVerifySms').disabled = true;
          document.getElementById('userPhone1').readOnly = true;
          document.getElementById('userPhone2').readOnly = true;
          document.getElementById('userPhone3').readOnly = true;
          document.getElementById('btnRequestSms').disabled = true;
        }
      })
      .catch(error => {
        console.error('Error:', error);
        commonModal.show("알림", "서버 검증 중 오류가 발생했습니다.");
      });
    };

    window.validateForm = function() {
      var userId = document.getElementById('userId').value.trim();
      var userName = document.getElementById('userName').value.trim();
      var phone1 = document.getElementById('userPhone1').value.trim();
      var phone2 = document.getElementById('userPhone2').value.trim();
      var phone3 = document.getElementById('userPhone3').value.trim();
      var userPhone = phone1 + phone2 + phone3;
      var userEmail1 = document.getElementById('userEmail1').value.trim();
      var userEmail2 = document.getElementById('userEmail2').value.trim();
      var userPw = document.getElementById('userPw').value;
      var userPwConfirm = document.getElementById('userPwConfirm').value;

      if (!userId || !userName || !userPhone || !userEmail1 || !userEmail2 || !userPw || !userPwConfirm || !isIdChecked || !isSmsVerified) {
        commonModal.show("알림", "다시 한번 모든 항목이 정상적으로 입력되었는지 확인해주세요.");
        return;
      }

      var idRegex = /^[a-z0-9]{4,12}$/;
      if (!idRegex.test(userId)) {
        commonModal.show("알림", "ID는 알파벳 영문 소문자 4자리에서 12자리까지 입력이 가능합니다.");
        return;
      }

      var nameRegex = /^[가-힣a-zA-Z0-9]{1,10}$/;
      if (!nameRegex.test(userName)) {
        commonModal.show("알림", "이름은 한글, 영문, 숫자 조합으로 1자 이상 10자 이하로 입력이 가능합니다.");
        return;
      }

      var pwRegex = /^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+~`\-={}\[\]:;"'<>,.?/]).{8,16}$/;
      if (!pwRegex.test(userPw)) {
        commonModal.show("알림", "8자리 이상 16자리 이하 알파벳, 숫자, 특수기호의 조합으로 작성하셔야 합니다.");
        return;
      }

      if (userPw !== userPwConfirm) {
        commonModal.show("알림", "일치하는 비밀번호를 입력하세요.");
        return;
      }

      var email = userEmail1 + '@' + userEmail2;

      fetch("{{ route('front.register.post') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}",
          "Accept": "application/json"
        },
        body: JSON.stringify({
          userId: userId,
          userName: userName,
          userPhone: userPhone,
          email: email,
          password: userPw
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          location.href = data.redirect + "?name=" + encodeURIComponent(userName);
        } else {
          commonModal.show("알림", data.message || "가입 처리 중 오류가 발생했습니다.");
        }
      })
      .catch(error => {
        console.error('Error:', error);
        commonModal.show("알림", "서버와의 통신 중 오류가 발생했습니다.");
      });
    };

    document.getElementById('btnIdCheck').onclick = window.checkId;
    document.getElementById('btnRequestSms').onclick = window.requestSmsCode;
    document.getElementById('btnVerifySms').onclick = window.verifySmsCode;
  })();
</script>
@endpush
