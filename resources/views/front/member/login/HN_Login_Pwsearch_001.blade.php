@extends('front.layouts.layout')

@section('title', '비밀번호 찾기')

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
      <a href="{{ route('front.findpassword') ?? '#' }}" class="item">비밀번호 찾기</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">비밀번호 찾기</h2>
      <h3 class="tit3">하늘누리 추모공원</h3>
    </div>
    <div class="wrap-login customer">
      <div class="login-cont">
        <form action="" class="form-login">
          <div class="form-tit">성명</div>
          <div class="input-group">
            <input
              type="text"
              id="userName"
              class="input-box"
              placeholder="성명을 입력해주세요."
            />
            <span class="error-message error-m" style="display:none;">
              <span class="error-icon">!</span>
              성명을 확인하시고 다시 시도해주시기 바랍니다.
            </span>
          </div>
          <div class="form-tit">휴대전화번호</div>
          <div class="input-group">
            <input
              type="text"
              id="userPhone"
              class="input-box"
              placeholder="휴대전화번호(-를 제외한 숫자만 입력)를 입력해주세요."
              oninput="this.value = this.value.replace(/[^0-9]/g, '')"
            />
            <span class="error-message error-m" style="display:none;">
              <span class="error-icon">!</span>
              휴대전화번호를 확인하시고 다시 시도해주시기 바랍니다.
            </span>
          </div>
          <div class="wrap-btn">
            <button type="button" class="btn primary h56 full" id="popupFindPwBtn">
              <span>확인</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
@endsection

@push('scripts')
<script>
  (function () {
    var findPwBtn = document.getElementById("popupFindPwBtn");

    if (findPwBtn) {
      findPwBtn.addEventListener("click", function () {
        var userName = document.getElementById('userName').value.trim();
        var userPhone = document.getElementById('userPhone').value.trim();

        if (!userName || !userPhone) {
          commonModal.show("알림", "성명, 휴대전화번호를 확인하시고 다시 시도해주시기 바랍니다.");
          return;
        }

        fetch("{{ route('front.findpassword.post') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            userName: userName,
            userPhone: userPhone
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            var findPwContent =
              '<div class="wrap-cont">' +
              "<p>등록된 이메일(" + data.email + ")로</p>" +
              "<p style='margin-top:5px; font-size:16px;'>임시 비밀번호를 발송하였습니다.</p>" +
              "</div>";
              
            commonModal.show("비밀번호 찾기 성공", findPwContent, function(isConfirm) {
               location.href = "{{ route('front.login') }}";
            });
          } else {
            commonModal.show("알림", data.message || "입력하신 정보와 일치하는 회원 정보를 찾을 수 없습니다.");
          }
        })
        .catch(error => {
          console.error("Error:", error);
          commonModal.show("요청 실패", "서버 통신 중 오류가 발생했습니다.");
        });
      });
    }
  })();
</script>
@endpush
