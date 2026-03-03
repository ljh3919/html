@extends('frontend.layouts.layout')

@section('title', '나의 정보')

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
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">나의 정보</h2>
    </div>
    <div class="wrap-login customer">
      <div class="login-cont">
        <form action="" class="form-login">
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
            <div class="form-desc">{{ $member->phone ?? '' }}</div>
          </div>
          <div class="wrap-form-item">
            <div class="form-tit form">E-Mail</div>
            <div class="form-desc">{{ $member->email ?? '' }}</div>
          </div>
          <div class="wrap-btn">
            <button type="button" class="btn primary h56 full" onclick="location.href='{{ route('frontend.myinfo_edit') ?? '#' }}'">
              <span>나의 정보 수정</span>
            </button>
            <button type="button" class="btn primary h56 full" onclick="location.href='{{ route('frontend.change_password') ?? '#' }}'">
              <span>비밀번호 변경</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
@endsection
