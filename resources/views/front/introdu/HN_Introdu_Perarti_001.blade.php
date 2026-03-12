@extends('front.layouts.layout')

@section('title', '재단/허가 현황')

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
      <a href="{{ route('front.introdu.greeting') }}" class="item">하늘누리 소개</a>
      <a href="#" class="item">재단/허가 현황</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">재단/허가 현황</h2>
      <div class="tit2-sub">
        “투명한 인허가 절차를 통해 증명된 준비된 추모 공간”
      </div>
      <div class="desc">
        하늘누리 추모공원은 토지 확보부터 도시계획시설 결정, 환경영향평가
        및 최종 설치 허가에 이르기까지 모든 행정 절차를 적법하게
        완수하였습니다.
      </div>
    </div>
  </div>
  <div class="wrap-main-img permission01"></div>
  <div class="wrap-story-info">
    <img
      class="img-part"
      src="{{ asset('img/img_permission_part01.png') }}"
      alt="재단법인 하늘누리"
    />
    <div class="wrap-info-text">
      <div class="tit">재단법인 하늘누리</div>
      <div class="desc">세대를 넘어 이어지는 책임</div>
      <div class="desc-sub">
        하늘누리 추모공원은 재단법인으로 운영됩니다.<br />재단법인은 일반
        기업과 달리<br />"공익 목적"을 위해 설립된 비영리 법인으로<br />
        파산이나 폐업의 위험이 없으며<br />세대를 넘어 영속적으로
        운영됩니다.<br /><br />이는 고객님께서 안치하신 고인을<br />영원히
        책임지고 관리하겠다는<br />
        하늘누리의 약속입니다.
      </div>
    </div>
  </div>
  <div class="wrap-info-outter">
    <div class="wrap-foundation-info">
      <div class="tit-info">재단정보</div>
      <div class="wrap-info">
        <div class="info-list">
          <div class="item">
            <div class="item-tit">법인명</div>
            <div class="item-desc">재단법인 하늘누리</div>
          </div>
          <div class="item">
            <div class="item-tit">설립목적</div>
            <div class="item-desc">
              장사시설의 설치 및 운영을 통한 국민 복지 증진 및 추모 문화
              발전
            </div>
          </div>
          <div class="item">
            <div class="item-tit">설립인가</div>
            <div class="item-desc">
              20OO년 ○월 ○일 | ○○시청 인가 제2020-○○호
            </div>
          </div>
        </div>
        <div class="info-list">
          <div class="item">
            <div class="item-tit">법인등록번호</div>
            <div class="item-desc">XXX-XX-XXXXX</div>
          </div>
          <div class="item">
            <div class="item-tit">대표이사</div>
            <div class="item-desc">OOO</div>
          </div>
          <div class="item">
            <div class="item-tit">소재지</div>
            <div class="item-desc">경기도 양주시 산북동 산67-20</div>
          </div>
          <div class="item">
            <div class="item-tit">감독기관</div>
            <div class="item-desc">OO시청(보건복지과)</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="wrap-story-info">
    <img
      class="img-part"
      src="{{ asset('img/img_permission_part02.png') }}"
      alt="재단법인의 법적 특성"
    />
    <div class="wrap-info-text">
      <div class="tit">재단법인의 법적 특성</div>
      <div class="desc">영속성 보장</div>
      <div class="desc-sub">
        법적으로 영구적 존속이 보장되며 대표이사 교체와 무관하게 계속
        운영됩니다.
      </div>
      <div class="desc">비영리 구조</div>
      <div class="desc-sub">
        수익금은 주주 배당이 아닌 시설 개선과 서비스 향상에 재투자됩니다.
      </div>
      <div class="desc">공적 감독</div>
      <div class="desc-sub">
        정부 감독기관의 지속적 관리·감독을 받으며 투명한 운영이 법적으로
        강제됩니다.
      </div>
      <div class="desc">자산 보호</div>
      <div class="desc-sub">
        재단 자산은 법적으로 보호되며 임의 처분이 불가능합니다.
      </div>
    </div>
  </div>
  <div class="main">
    <div class="wrap-tit">
      <h2 class="tit2">주요 허가 및 인증</h2>
      <div class="tit2-sub">필수 허가 사항</div>
    </div>
  </div>
  <div class="wrap-main-img permission02"></div>
  <div class="wrap-info-outter">
    <div class="wrap-permission-lists">
      <div class="item">
        <div class="tit">재단법인 설립허가</div>
        <ul class="permission-lists">
          <li class="permission-item"><strong>허가기관</strong>○○시청</li>
          <li class="permission-item">
            <strong>허가번호</strong>제2020-○○호
          </li>
          <li class="permission-item">
            <strong>허가일자</strong>20OO년 ○월 ○일
          </li>
          <li class="permission-item space">
            <strong>근거법령</strong>
            <p>민법 제32조 (비영리법인의 설립과 허가)</p>
            <p>장사 등에 관한 법률</p>
          </li>
        </ul>
      </div>
      <div class="item">
        <div class="tit">봉안시절 설치허가</div>
        <ul class="permission-lists">
          <li class="permission-item"><strong>허가기관</strong>○○시청</li>
          <li class="permission-item">
            <strong>허가번호</strong>제2020-○○호
          </li>
          <li class="permission-item">
            <strong>허가일자</strong>20OO년 ○월 ○일
          </li>
          <li class="permission-item space">
            <strong>시설규모</strong>
            <p>봉안당 : OOOOO기</p>
            <p>수목장 : OOOOO기</p>
            <p>부지면적 : OO,OOO ㎡</p>
          </li>
          <li class="permission-item space">
            <strong>근거법령</strong>
            <p>장사 등에 관한 법률 제13</p>
            <p>조장사시설 설치기준 (시행령 별표3)</p>
          </li>
        </ul>
      </div>
      <div class="item">
        <div class="tit">자연장지 조성허가</div>
        <ul class="permission-lists">
          <li class="permission-item"><strong>허가기관</strong>○○시청</li>
          <li class="permission-item">
            <strong>허가번호</strong>제2020-○○호
          </li>
          <li class="permission-item">
            <strong>허가일자</strong>20OO년 ○월 ○일
          </li>
          <li class="permission-item space">
            <strong>시설종류</strong>
            <p>수목장 (개인/가족)</p>
            <p>잔디장 (평장형)</p>
          </li>
          <li class="permission-item space">
            <strong>근거법령</strong>
            <p>장사 등에 관한 법률 제2조 제9호</p>
            <p>자연장지 조성 기준 (시행령 별표4)</p>
          </li>
        </ul>
      </div>
      <div class="item">
        <div class="tit">건축물 사용승인</div>
        <ul class="permission-lists">
          <li class="permission-item"><strong>허가기관</strong>○○시청</li>
          <li class="permission-item">
            <strong>승인번호</strong>건축물대장 ○○○○-○○○○
          </li>
          <li class="permission-item">
            <strong>승인일자</strong>2020년 ○월 ○일
          </li>
          <li class="permission-item space">
            <strong>건축물 정보</strong>
            <p>구조 : 철근콘크리드조</p>
            <p>규모 : 지하1층 ~ 지상 3층</p>
            <p>연면적 : O,OOO ㎡</p>
          </li>
          <li class="permission-item space">
            <strong>근거법령</strong>
            <p>건축법 제 22조(사용승인)</p>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="main">
    <div class="wrap-tit">
      <h2 class="tit2">주요 인증 및 등록</h2>
    </div>
  </div>
  <div class="wrap-main-img permission03"></div>
  <div class="wrap-info-outter">
    <div class="wrap-certification-lists">
      <div class="item">
        <div class="tit">친환경 건축물 인증<br />(그린빌딩)</div>
        <ul class="certification-lists">
          <li class="certification-item">
            한국건설기술연구원 OOOO년 OO월
          </li>
          <li class="certification-item">등급 : 우수(2등급)</li>
        </ul>
      </div>
      <div class="item">
        <div class="tit">장애인 편의시설 적합 인증</div>
        <ul class="certification-lists">
          <li class="certification-item">한국장애인개발원 OOOO년 OO월</li>
          <li class="certification-item">등급 : 최우수(BF 1등급)</li>
        </ul>
      </div>
      <div class="item">
        <div class="tit">소방시설 완비 확인서</div>
        <ul class="certification-lists">
          <li class="certification-item">OO소방서 OOOO년 OO월</li>
          <li class="certification-item">
            스프링쿨러, 자동화재탐지설비 등
          </li>
        </ul>
      </div>
      <div class="item">
        <div class="tit">정기 안전검사 적합 판정</div>
        <ul class="certification-lists">
          <li class="certification-item">한국시설안전공단 OOOO년 OO월</li>
          <li class="certification-item">
            건축물, 전기, 소방, 기스 등 전 분야 적합
          </li>
        </ul>
      </div>
      <div class="item">
        <div class="tit">위생관리등급 우수 평가</div>
        <ul class="certification-lists">
          <li class="certification-item">OO보건소 OOOO년 OO월</li>
          <li class="certification-item">
            식당, 카페, 화장실 위생 관리 우수
          </li>
        </ul>
      </div>
    </div>
  </div>
</main>
@endsection