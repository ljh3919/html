@extends('front.layouts.layout')

@section('title', '분양안내 - 사전청약 혜택')

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
      <a href="#" class="item">분양안내</a>
      <a href="#" class="item">사전청약 혜택</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">사전청약 혜택</h2>
      <div class="tit2-sub">“현명한 선택, 사전계약”</div>
      <div class="desc">
        사전계약은 하늘누리 추모공원의 일부 구역이 개장 전이거나 추가 조성
        중일 때 미리 계약하시는 분들께 드리는 특별한 혜택입니다.
      </div>
    </div>
  </div>
  <div class="wrap-main-img benefit"></div>
  <div class="benefit">
    <div class="benefit-item">
      <div class="tit">가격혜택</div>
      <div class="desc">정식 분양가 대비 10% 할인</div>
    </div>
    <div class="benefit-item">
      <div class="tit">위치 우선권</div>
      <div class="desc">원하는 위치 먼저 선택</div>
    </div>
    <div class="benefit-item">
      <div class="tit">특별 서비스</div>
      <div class="desc">5년 관리비 면제</div>
    </div>
  </div>
  <div class="benefit-lists">
    <div class="benefit-lists-item">
      <div class="item-label">혜택 1</div>
      <div class="item-tit">분양가 10% 할인</div>
      <div class="item-desc">
        정식분양기에서 10% 할인된 가격으로 계약 가능
      </div>
      <div class="wrap-benefit-detail">
        <div class="detail-item">
          일반 봉안실 500 만원 > 450 만원 (50 만원 할인)
        </div>
        <div class="detail-item">
          가족 봉안실 1,000 만원 > 900 만원 (100 만원 할인)
        </div>
        <div class="detail-item">
          개인 수목장 400 만원 > 360 만원 (40 만원 할인)
        </div>
        <div class="detail-item">
          프리미엄 1,500 만원 > 1,350 만원 (150 만원 할인)
        </div>
      </div>
    </div>
    <div class="benefit-lists-item">
      <div class="item-label">혜택 2</div>
      <div class="item-tit">원하는 위치를 먼저 선택할 수 있습니다.</div>
      <div class="item-desc">우선 선택 가능 위치</div>
      <div class="wrap-benefit-detail">
        <div class="detail-item">
          봉안당 중단 (4~6단, 가장 선호되는 높이)
        </div>
        <div class="detail-item">봉안당 2~3층 (밝고 쾌적한 층)</div>
        <div class="detail-item">프리미엄 스카이뷰 (전망대 인접)</div>
        <div class="detail-item">수목장 전망 좋은 구역</div>
        <div class="detail-item">산책로 인접 수목장</div>
        <div class="detail-item">남향 또는 동향 위치</div>
      </div>
    </div>
    <div class="benefit-lists-item">
      <div class="item-label">혜택 3</div>
      <div class="item-tit">5년간 추가 관리비 면제</div>
      <div class="item-desc">포함 서비스</div>
      <div class="wrap-benefit-detail">
        <div class="detail-item">정기 청소 및 관리</div>
        <div class="detail-item">명절 특별 관리</div>
        <div class="detail-item">시설 유지보수</div>
        <div class="detail-item">조경 및 제초 (수목장)</div>
        <div class="detail-item">병충해 방제 (수목장)</div>
        <div class="detail-item">24시간 보안</div>
      </div>
    </div>
  </div>
</main>
@endsection
