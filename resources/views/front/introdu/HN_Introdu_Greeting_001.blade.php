@extends('front.layouts.layout')

@section('title', '인사말')

@section('content')
<main>
  <div class="main">
    <div class="breadcrumb">
      <a href="#" class="item">
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
      <a href="#" class="item">하늘누리 소개</a>
      <a href="#" class="item">인사말</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">인사말</h2>
      <div class="tit2-sub">
        하늘누리 추모공원은 "고인께서는 편안히 영면하실 수 있는 성스러운
        안식처”가 되고자 합니다.
      </div>
    </div>
  </div>
  <div class="wrap-main-img greetings"></div>
  <div class="wrap-greetings">
    <div class="tit">안녕하십니까.</div>
    <div class="tit">
      하늘누리 추모공원 홈페이지를 찾아주신 여러분께 진심으로
      감사드립니다.
    </div>
    <p class="text">
      하늘누리 추모공원은 “하늘이 내린 평안한 안식처”라는 의미를 담아
      자연과 하나 되는 아름다운 영면의 공간으로 조성되었습니다.
    </p>
    <p class="text">
      저희 공원은 단순한 장사시설을 넘어 고인께서는 편안히 영면하실 수
      있는 성스러운 안식처이며, 유가족분들께는 사랑하는 이를 추모하며
      위안을 얻는 치유의 공간이 되고자 합니다.
    </p>
    <p class="text">
      천혜의 자연환경 속에 조성된 하늘누리 추모공원은 사계절 아름다운
      경관과 잘 가꾸어진 조경으로 후손들이 편안하게 방문하여 고인을 기릴
      수 있는 환경을 제공합니다.
    </p>
    <p class="text">
      또한 최신 시설과 친환경 설계로 쾌적하고 품격 있는 추모 문화를
      선도하며, 재단법인의 안정적 운영 체계로 영구적인 관리를 보장합니다.
    </p>
    <p class="text">
      저희 하늘누리 추모공원의 모든 임직원은 내 가족, 내 부모님을 모시는
      마음으로 정성을 다해 고인을 봉안하고 관리할 것을 약속드립니다.
    </p>
    <p class="text">
      방문하시는 모든 분들께 평안과 위로가 되는 공간이 되도록 최선을
      다하겠습니다.
    </p>
    <div class="greeting-last">
      <div class="greeting-text">하늘누리 추모공원 대표 ○○○</div>
      <div class="greeting-text">임직원 일동</div>
    </div>
  </div>
</main>
@endsection
