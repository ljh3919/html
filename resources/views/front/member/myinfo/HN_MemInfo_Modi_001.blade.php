@extends('front.layouts.layout')

@section('title', '나의 정보 수정')

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
      <a href="{{ route('front.myinfo') ?? '#' }}" class="item">나의 정보</a>
      <a href="{{ route('front.myinfo_edit') ?? '#' }}" class="item">나의 정보 수정</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">나의 정보 수정</h2>
    </div>
    <div class="wrap-login customer">
      <div class="login-cont myinfo">
        <form action="" class="form-login" id="editInfoForm" onsubmit="return validateEditForm()">
          <div class="wrap-form-item">
            <div class="form-tit">아이디</div>
            <div class="form-desc">{{ $member->username ?? '' }}</div>
          </div>
          <div class="wrap-form-item">
            <div class="form-tit">이름</div>
            <div class="form-desc">{{ $member->name ?? '' }}</div>
          </div>
          <div class="wrap-form-item">
            <div class="form-tit form">휴대전화</div>
            <div class="input-group" style="flex: 1;">
              <input 
                type="text" 
                id="userPhone" 
                class="input-box" 
                value="{{ str_replace('-', '', $member->phone ?? '') }}" 
                placeholder="휴대전화번호(-를 제외한 숫자만 입력)를 입력해주세요." 
                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                style="width: 100%;"
              >
            </div>
          </div>
          <div class="wrap-form-item">
            <div class="form-tit form">E-Mail</div>
            <div class="input-group">
              @php
                  $emailParts = explode('@', $member->email ?? '@');
                  $e1 = $emailParts[0] ?? '';
                  $e2 = $emailParts[1] ?? '';
              @endphp
              <div class="wrap-email-inputs">
                <div class="wrap-form-set">
                  <input
                    type="text"
                    id="userEmail1"
                    class="input-box"
                    placeholder="이메일을 입력하세요"
                    value="{{ $e1 }}"
                  />@
                  <input
                    type="text"
                    id="userEmail2"
                    class="input-box"
                    placeholder="도메인을 입력하세요"
                    value="{{ $e2 }}"
                  />
                </div>
                <div class="select-wrapper">
                  <select class="input-box select" id="emailDomainSelect">
                    <option value="">직접입력</option>
                    <option value="naver.com" {{ $e2 == 'naver.com' ? 'selected' : '' }}>naver.com</option>
                    <option value="gmail.com" {{ $e2 == 'gmail.com' ? 'selected' : '' }}>gmail.com</option>
                    <option value="daum.net" {{ $e2 == 'daum.net' ? 'selected' : '' }}>daum.net</option>
                  </select>
                </div>
              </div>
            </div>
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
  document.addEventListener('DOMContentLoaded', function() {
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
  });

  function validateEditForm() {
    var userPhone = document.getElementById('userPhone').value.trim();
    var e1 = document.getElementById('userEmail1').value.trim();
    var e2 = document.getElementById('userEmail2').value.trim();

    if (!userPhone || !e1 || !e2) {
      commonModal.show("알림", "다시 한번 입력항목을 확인해 주세요.");
      return false;
    }

    var email = e1 + '@' + e2;

    fetch("{{ route('front.myinfo_edit.post') }}", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        "Accept": "application/json"
      },
      body: JSON.stringify({
        phone: userPhone,
        email: email
      })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        commonModal.show("알림", data.message || "정보가 수정되었습니다.", function() {
          location.href = data.redirect;
        });
      } else {
        commonModal.show("알림", data.message || "수정 처리 중 오류가 발생했습니다.");
      }
    })
    .catch(error => {
      console.error('Error:', error);
      commonModal.show("알림", "네트워크 오류가 발생했습니다.");
    });

    return false;
  }
</script>
@endsection
