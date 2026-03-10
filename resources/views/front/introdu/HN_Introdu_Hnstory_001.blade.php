@extends('front.layouts.layout')

@section('title', '하늘누리 이야기')

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
      <a href="#" class="item">하늘누리 이야기</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">하늘누리 이야기</h2>
      <div class="tit2-sub">
        하늘누리 추모공원은 "고인께서는 편안히 영면하실 수 있는 성스러운
        안식처”가 되고자 합니다.
      </div>
    </div>
  </div>
  <div class="wrap-main-img story01"></div>
  <div class="wrap-story-info">
    <div class="wrap-info-text">
      <div class="tit">자연으로 돌아가 영면하다</div>
      <div class="desc">
        전통적인 매장 문화에서 화장 중심으로 변화하는 시대적 흐름 속에서,
        품격 있고 아름다운 추모 공간의 필요성이 대두되었습니다.
      </div>
    </div>
    <img
      class="img-part"
      src="{{ asset('img/img_story_part01.png') }}"
      alt="자연으로 돌아가 영면하다"
    />
  </div>
  <div class="wrap-story-info">
    <div class="wrap-info-text">
      <div class="tit">하늘(天) + 누리(世界)</div>
      <div class="desc">
        "하늘누리"는 하늘(天) + 누리(世界)의 합성어로, "하늘이 내린
        평화로운 세상"을 뜻합니다.
      </div>
    </div>
    <img
      class="img-part"
      src="{{ asset('img/img_story_part02.png') }}"
      alt="자연으로 돌아가 영면하다"
    />
  </div>
  <div class="wrap-main-img story02"></div>
  <div class="wrap-story-info">
    <div class="wrap-info-text">
      <div class="tit">하늘누리 추모공원의 장점은</div>
      <div class="desc">품격 있는 추모 문화 창조</div>
      <div class="desc-sub">
        최고급 시설과 쾌적한 환경으로 고품격 추모 공간 제공하고 현대적
        감각의 디자인과 전통의 조화가 어우러져 있습니다.
      </div>
      <div class="desc">자연 친화적 영면 공간</div>
      <div class="desc-sub">
        친환경 수목장과 생태 조경으로 자연과 공존하며 지속 가능한 녹색
        추모 문화 실천합니다.
      </div>
      <div class="desc">유가족 중심의 편의 시설</div>
      <div class="desc-sub">
        넉넉한 주차 공간과 편리한 접근성을 제공하고 쾌적한 참배 공간과
        휴게 시설 갖추었습니다.
      </div>
      <div class="desc">영구적이고 안정적인 관리</div>
      <div class="desc-sub">
        재단법인 운영으로 영속성 보장하고 체계적인 관리 시스템과 전문 인력
        운영하고 있습니다.
      </div>
    </div>
  </div>

  <div class="wrap-story-info">
    <img
      class="img-part"
      src="{{ asset('img/img_story_part03.png') }}"
      alt="자연으로 돌아가 영면하다"
    />
    <div class="wrap-info-text">
      <div class="tit">하늘누리 추모공원은</div>
      <div class="desc">
        고인의 존엄을 지키고 유가족의 애도를 존중하는 품격 있는 추모
        문화를 만들어갑니다. "자연 속에서 편안히 쉬시고, 하늘의 평화를
        누리소서"
      </div>
      <div class="desc">
        이것이 하늘누리 추모공원이 지향하는 궁극적인 가치이자 약속입니다.
      </div>
      <div class="desc">
        하늘누리 추모공원은 단순히 고인을 모시는 공간이 아닌, 생명의
        소중함을 되새기고 가족의 사랑을 기억하는 의미 있는 장소가 되고자
        합니다.
      </div>
    </div>
  </div>
</main>
@endsection
