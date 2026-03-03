@extends('frontend.layouts.layout')

@section('title', '개인정보 처리방침')

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
      <a href="{{ route('frontend.personal_terms') ?? '#' }}" class="item">개인정보 처리방침</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">개인정보 처리방침</h2>
    </div>
    <div class="wrap-c-terms">
      <div class="desc">
        재단법인 하늘누리는 귀하의 개인정보보호를 매우 중요시하며 , 개인정보보호방침을 통하여 귀하께서 제공하시는 개인정보가 어떠한 용도와 방식으로 이용되고 있으며 개인정보보호를 위해 어떠한 조치가 취해지고 있는지 알려드립니다.
      </div>

      <div class="tit">개인정보 수집에 대한 동의</div>
      <div class="desc">
        재단법인 하늘누리는 귀하께 회원가입 시 개인정보보호방침 또는 이용약관의 내용을 공지 하며 회원가입버튼을 클릭하면 개인정보 수집에 대해 동의하신 것으로 봅니다.
      </div>

      <div class="tit">개인정보의 수집목적 및 이용목적</div>
      <div class="desc">재단법인 하늘누리는 다음과 같은 목적을 위하여 개인정보를 수집하고 있습니다 .</div>
      <ul class="term-lists">
        <li class="item">- 재단법인 하늘누리는 서비스를 위한 회원 가입 및 이용아이디 발급</li>
        <li class="item">- 서비스의 이행 ( 홈페이지 이용사항 )</li>
        <li class="item">- 장애처리 및 개별 회원에 대한 개인 맞춤서비스</li>
        <li class="item">- 서비스 이용에 대한 통계 수집</li>
        <li class="item">- 기타 새로운 서비스 및 정보 안내</li>
      </ul>
      <div class="desc">
        단 , 이용자의 기본적 인권 침해의 우려가 있는 민감한 개인정보는 수집하지 않습니다. 재단법인 하늘누리는 상기 범위 내에서 보다 풍부한 서비스를 제공하기 위해 이용자의 자의에 의한 추가 정보를 수집합니다.
      </div>

      <div class="tit">수집하는 개인정보 항목</div>
      <div class="desc">재단법인 하늘누리는 회원가입 , 상담 , 서비스 신청 등등을 위해 아래와 같은 개인정보를 수집하고 있습니다.</div>
      <ul class="term-lists">
        <li class="item">- 수집항목 : 이름 , 로그인 ID(이메일) , 비밀번호 ,휴대전화번호, 서비스 이용기록 , 접속 로그 , 쿠키 , 접속 IP 정보</li>
        <li class="item">- 개인정보 수집방법 : 홈페이지 ( 회원가입 , 게시판 )</li>
      </ul>

      <div class="tit">개인정보의 보유기간 및 이용기간</div>
      <div class="desc">귀하의 개인정보는 다음과 같이 개인정보의 수집목적 또는 제공받은 목적이 달성되면 파기됩니다.</div>
      <ul class="term-lists">
        <li class="item">- 회원 가입정보의 경우 , 회원 가입을 탈퇴하거나 회원에서 제명된 때</li>
        <li class="item">- 예약의 경우 , 예약에 따른 검진 및 처리가 만료된 때</li>
      </ul>

      <div class="tit">개인정보 관리책임자</div>
      <ul class="term-lists sub">
        <li class="item">성 명 : 홍길동</li>
        <li class="item">소 속 : 재단법인 하늘누리</li>
        <li class="item">연락처 : 000-0000-0000</li>
        <li class="item">이메일 : abc@hanmail.net</li>
      </ul>
      <div class="desc">
        [ 시행일 ] 본 개인정보보호정책은 2026년 3월 1일부터 시행합니다 .
      </div>
    </div>
  </div>
</main>
@endsection
