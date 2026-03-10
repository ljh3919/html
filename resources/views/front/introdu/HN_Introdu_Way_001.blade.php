@extends('front.layouts.layout')

@section('title', '오시는 길')

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
      <a href="#" class="item">오시는 길</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">오시는 길</h2>
      <div class="tit2-sub">
        하늘누리 추모공원은 "고인께서는 편안히 영면하실 수 있는 성스러운
        안식처”가 되고자 합니다.
      </div>
    </div>
  </div>
  <div class="wrap-main-img location01"></div>
  <div class="main">
    <div class="wrap-map">
      <!-- ToDo: 지도 API 연동 -->
    </div>
    <div class="wrap-info-outter">
      <div class="wrap-foundation-info">
        <div class="wrap-info">
          <div class="info-list">
            <div class="item">
              <div class="item-tit">운영시간</div>
              <div class="item-desc">
                연중무휴 오전 09:00 ~ 오후 18:00
              </div>
            </div>
            <div class="item">
              <div class="item-tit">주소</div>
              <div class="item-desc">경기도 양주시 산북동 산 67-20</div>
            </div>
          </div>
          <div class="info-list wrap-text">
            <div class="text">대표전화 031-999-9999</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
