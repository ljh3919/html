@extends('front.layouts.layout')

@section('title', '시설안내 - 봉안당(하늘누리관)')

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
      <a href="#" class="item">봉안당(하늘누리관)</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">봉안당<br />(하늘누리관)</h2>
      <div class="tit2-sub">
        하늘누리관은 최고급 건축 자재와 현대적 설계로 조성된 품격 있는
        봉안 공간입니다.<br />자연 채광과 쾌적한 환경으로 고인을 편안하게
        모실 수 있습니다.
      </div>
    </div>
  </div>
  <div class="wrap-story-info thin">
    <div class="wrap-img-part internal">
      <div class="text">
        “하늘과 맞닿은 가장 가까운 안식,<br />하늘누리관”
      </div>
    </div>
    <div class="wrap-info-outter">
      <div class="wrap-foundation-info">
        <div class="wrap-facilities-info">
          <div class="facilities-item">
            <div class="label">건물구조</div>
            <div class="wrap-desc">
              <div class="desc">지하 1층 ~ 지상 3층</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">총 안치 가능 기수</div>
            <div class="wrap-desc">
              <div class="desc">약 OOOO 기</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">건축 자재</div>
            <div class="wrap-desc">
              <div class="desc">최고급 인조대리석 및 화강석</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">층별 구성</div>
            <div class="wrap-desc">
              <div class="desc">
                지하 1층 : 가족 봉안실<br />1층 : 일반봉안실, 안내데스크,
                로비<br />
                2층 : 프리미엄 봉안실
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="wrap-main-img internal01">
    <span>“이곳의 시간은 고귀한 기억으로 흐릅니다.”</span>
  </div>
  <div class="wrap-story-info thin">
    <div class="tit">일반 봉안실(개인형)</div>
    <div class="wrap-info-outter">
      <div class="wrap-foundation-info">
        <div class="wrap-facilities-info">
          <div class="facilities-item">
            <div class="label">규격</div>
            <div class="wrap-desc">
              <div class="desc">가로 30cm x 세로 30cm x 깊이 40cm</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">안치 위수</div>
            <div class="wrap-desc">
              <div class="desc">1위</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">위치</div>
            <div class="wrap-desc">
              <div class="desc">1층~3층 전 층</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">특징</div>
            <div class="wrap-desc">
              <div class="desc">
                투명 유리문으로 고인 유품 및 사진 안치 가능
              </div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">단구분</div>
            <div class="wrap-desc">
              <div class="desc">
                1~9단 (눈높이 4~5단 프리미엄)
                <br />개별 명패 부착일반 봉안실(개인형)
              </div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">가격대</div>
            <div class="wrap-desc">
              <div class="desc">150만원 ~ 800만원 (위치별 차등)</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="wrap-main-img internal02">
    <span>“당신의 그리움이 별이 되어 머무는 공간”</span>
  </div>
  <div class="wrap-story-info thin">
    <div class="tit">가족 봉안실</div>
    <div class="wrap-info-outter">
      <div class="wrap-foundation-info">
        <div class="wrap-facilities-info">
          <div class="facilities-item">
            <div class="label">종류</div>
            <div class="wrap-desc">
              <div class="desc">
                4위용: 가로 60cm x 세로 60cm<br />6위용: 가로 90cm x 세로
                60cm<br />12위용: 가로 120cm x 세로 90cm
              </div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">특징</div>
            <div class="wrap-desc">
              <div class="desc">
                가족 단위 영구 안치 공간<br />고급 대리석 마감<br />
                2층 : 프리미엄 봉안실
              </div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">가격대</div>
            <div class="wrap-desc">
              <div class="desc">
                4위용: 600만원 ~ 1,200만원<br />6위용: 900만원 ~
                1,800만원<br />12위용: 1,500만원 ~ 3,000만원
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="wrap-main-img internal03">
    <span>“가족의 사랑을 담은, 단 하나의 프리미엄 에디션”</span>
  </div>
  <div class="wrap-story-info thin">
    <div class="tit">프리미엄 봉안실</div>
    <div class="wrap-info-outter">
      <div class="wrap-foundation-info">
        <div class="wrap-facilities-info">
          <div class="facilities-item">
            <div class="label">위치</div>
            <div class="wrap-desc">
              <div class="desc">3층 전망대 인접</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">특징</div>
            <div class="wrap-desc">
              <div class="desc">
                자연 채광이 풍부한 공간<br />주변 산세와 풍광을 조망<br />독립적이고
                프라이빗한 환경<br />특별 설계 인테리어
              </div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">가격대</div>
            <div class="wrap-desc">
              <div class="desc">1,000만원 ~ 2,500만원</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="wrap-main-img internal04">
    <span>“생의 끝에서도 빛나는 단 하나의 명예”</span>
  </div>
  <div class="tit-section">하늘누리관 특별 서비스</div>
  <div class="wrap-info-outter">
    <div class="wrap-certification-lists">
      <div class="item">
        <div class="tit">E-추모 시스템</div>
        <ul class="certification-lists">
          <li class="certification-item">
            웹사이트/모바일 사이트를 통한 고인 검색
          </li>
          <li class="certification-item">
            고인 추모글을 쓸 수 있는 하늘편지 서비스
          </li>
        </ul>
      </div>
      <div class="item">
        <div class="tit">제례실</div>
        <ul class="certification-lists">
          <li class="certification-item">각 층별 1개소 배치</li>
          <li class="certification-item">
            전통 제례상 및 제수용품 준비 가능
          </li>
          <li class="certification-item">예약제 운영 (무료 이용)</li>
        </ul>
      </div>
      <div class="item">
        <div class="tit">참배편의</div>
        <ul class="certification-lists">
          <li class="certification-item">계단 및 엘리베이터 완비</li>
          <li class="certification-item">
            휠체어 접근 가능한 무장애 설계
          </li>
          <li class="certification-item">
            각 층 휴게 공간 및 화장실 배치
          </li>
        </ul>
      </div>
    </div>
  </div>
</main>
@endsection
