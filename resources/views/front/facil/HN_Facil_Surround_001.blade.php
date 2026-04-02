@extends('front.layouts.layout')

@section('title', '시설안내 - 주변 둘러보기')

@section('content')
<main>
  <div class="main">
    <div class="breadcrumb">
      <a href="{{ route('front.index') }}" class="item">
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
      <a href="#" class="item">시설안내</a>
      <a href="#" class="item">주변 둘러보기</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">주변 둘러보기</h2>
      <div class="tit2-sub">
        "하늘과 맞닿은 풍경, 사계절이 그려내는 찬란한 안식처“
      </div>
      <div class="desc">
        탁 트인 조망과 양주시의 수려한 자연경관이 한눈에 들어오는 명당.<br />계절마다
        옷을 갈아입는 하늘누리의 풍경은 고인에게는 평안을, 유족에게는 한
        폭의 그림 같은 위안을 선사합니다.
      </div>
    </div>
  </div>
  <div class="wrap-main-img outside01">
    <span> “하늘이 아끼고 숲이 품은, 생의 마지막 보금자리” </span>
  </div>
  <div class="wrap-story-info">
    <div class="wrap-info-text">
      <div class="tit">추모의 숲</div>
      <div class="desc">위치</div>
      <div class="desc-sub">수목장지 주변</div>
      <div class="desc">특징</div>
      <div class="desc-sub">
        산책로 조성(총 1.2km), 사계절 꽃과 나무 감상, 벤치 및 쉽터 10개소
      </div>
    </div>
  </div>
  <div class="wrap-main-img outside02">
    <span> “발아래 펼쳐진 사계절의 품, 슬픔조차 풍경이 되는 시간” </span>
  </div>
  <div class="wrap-story-info">
    <div class="wrap-info-text">
      <div class="tit">전망대 “하늘누리 뷰”</div>
      <div class="desc">위치</div>
      <div class="desc-sub">공원최상단부</div>
      <div class="desc">높이</div>
      <div class="desc-sub">해발 000m</div>
      <div class="desc">조망</div>
      <div class="desc-sub">
        서울/경기 도심 조망, 주변 산세 파노라마 뷰, 일출/일몰 명소
      </div>
      <div class="desc">시설</div>
      <div class="desc-sub">전망 데크, 망원경 2대</div>
    </div>
  </div>
</main>
@endsection
