@extends('front.layouts.layout')

@section('title', '시설안내 - 부대시설')

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
      <a href="#" class="item">부대시설</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">부대시설</h2>
      <div class="tit2-sub">
        자연과 하나 되어 영면하는 친환경 안장 공간입니다.<br />화장 후
        유골을 자연 분해 용기에 담아 나무 아래 안치합니다.
      </div>
    </div>
  </div>
  <div class="wrap-story-info thin">
    <img
      class="img-part"
      src="{{ asset('img/img_facilities_part01.png') }}"
      alt="주차시설"
    />
    <div class="wrap-info-outter">
      <div class="wrap-foundation-info">
        <div class="tit">주차시설</div>
        <div class="wrap-facilities-info">
          <div class="facilities-item">
            <div class="label">지상 주차장</div>
            <div class="wrap-desc">
              <div class="desc">30대</div>
              <div class="desc">일반차량</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">지하 주차장</div>
            <div class="wrap-desc">
              <div class="desc">200대</div>
              <div class="desc">봉안당 직접 연결</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">장애인 전용</div>
            <div class="wrap-desc">
              <div class="desc">20대</div>
              <div class="desc">출입구 인접 배치</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">대형 버스</div>
            <div class="wrap-desc">
              <div class="desc">20대</div>
              <div class="desc">단체 참배 지원</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">총 규모</div>
            <div class="wrap-desc">
              <div class="desc">530대</div>
              <div class="desc">무료이용</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="wrap-story-info thin">
    <img
      class="img-part"
      src="{{ asset('img/img_facilities_part02.png') }}"
      alt="레스토랑 '하늘정'"
    />
    <div class="wrap-info-outter">
      <div class="wrap-foundation-info">
        <div class="tit">레스토랑 “하늘정”</div>
        <div class="wrap-facilities-info">
          <div class="facilities-item">
            <div class="label">위치</div>
            <div class="wrap-desc">
              <div class="desc">관리동 2층</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">규모</div>
            <div class="wrap-desc">
              <div class="desc">120 석(단체석 별도 운영)</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">메뉴</div>
            <div class="wrap-desc">
              <div class="desc">
                우거지탕, 육개장, 비빔밥, 불고기 정식
              </div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">가격대</div>
            <div class="wrap-desc">
              <div class="desc">8,000원 ~ 15,000원</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">운영시간</div>
            <div class="wrap-desc">
              <div class="desc">09:00~18:00 (연중무휴)</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">전화</div>
            <div class="wrap-desc">
              <div class="desc">031-777-6666</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="wrap-story-info thin">
    <img
      class="img-part"
      src="{{ asset('img/img_facilities_part03.png') }}"
      alt="카페 “하늘쉼”"
    />
    <div class="wrap-info-outter">
      <div class="wrap-foundation-info">
        <div class="tit">카페 “하늘쉼”</div>
        <div class="wrap-facilities-info">
          <div class="facilities-item">
            <div class="label">위치</div>
            <div class="wrap-desc">
              <div class="desc">봉안당 1층 로비</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">메뉴</div>
            <div class="wrap-desc">
              <div class="desc">
                Coffee : 아메리카노, 카푸치노, 카페라떼<br />
                Tea : 유자차, 생강차, 인삼차, 허브티<br />
                Beverage : 과일주스, 에이드<br />
                Dessert : 쿠키, 샌드위치
              </div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">운영시간</div>
            <div class="wrap-desc">
              <div class="desc">08:00 ~ 19:00</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
