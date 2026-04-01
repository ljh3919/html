@extends('front.layouts.layout')

@section('title', '분양안내 - 분양절차')

@section('content')
<main>
  <div class="main counsel">
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
      <a href="#" class="item">분양 안내</a>
      <a href="#" class="item">분양 절차</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">분양 절차</h2>
      <div class="tit2-sub">
        “하늘과 맞닿은 풍경, 사계절이 그려내는 찬란한 안식처”
      </div>
      <div class="desc">
        탁 트인 조망과 양주시의 수려한 자연경관이 한눈에 들어오는 명당.<br />
        계절마다 옷을 갈아입는 하늘누리의 풍경은 고인에게는 평안을,
        유족에게는 한 폭의 그림 같은 위안을 선사합니다.
      </div>
    </div>
  </div>
  <div class="wrap-subscription">
    <ul class="wrap-tab" role="tablist" aria-label="분양 절차 유형">
      <li
        class="tab-item active"
        role="tab"
        aria-selected="true"
        tabindex="0"
      >
        봉안당(하늘누리관)
      </li>
      <li class="tab-item" role="tab" aria-selected="false" tabindex="-1">
        수목장(자연장)
      </li>
    </ul>
  </div>
  <div class="cont-subscription active">
    <div class="wrap-order-lists">
      <button type="button" class="order-item">
        <div class="wrap-text">
          <div class="label"><strong>1</strong>st</div>
          <div class="desc">봉안실 타입 선택</div>
        </div>
        <div class="text">더 알아보기</div>
      </button>
      <button type="button" class="order-item">
        <div class="wrap-text">
          <div class="label"><strong>2</strong>nd</div>
          <div class="desc">봉안단 타입 선택</div>
        </div>
        <div class="text">더 알아보기</div>
      </button>
      <button type="button" class="order-item">
        <div class="wrap-text">
          <div class="label"><strong>3</strong>rd</div>
          <div class="desc">단 위치 선택</div>
        </div>
        <div class="text">더 알아보기</div>
      </button>
      <button type="button" class="order-item">
        <div class="wrap-text">
          <div class="label"><strong>4</strong>th</div>
          <div class="desc">사용권 계약</div>
        </div>
        <div class="text">더 알아보기</div>
      </button>
      <button type="button" class="order-item">
        <div class="wrap-text">
          <div class="label"><strong>5</strong>th</div>
          <div class="desc">관리비납부</div>
        </div>
        <div class="text">더 알아보기</div>
      </button>
    </div>
    <div class="wrap-main-img procedure01"></div>
    <!-- 분양순서 1 -->
    <div class="wrap-explain">
      <div class="explain-tit">
        <strong>1</strong>st<span>수목장 타입 선택</span>
      </div>
      <div class="explain-desc">
        하늘누리 수목장은 화장 후 유골을 자연 분해 용기에 담아 나무 뿌리
        깊이 안치하는 친환경 자연장입니다.
      </div>
      <div class="explain-desc">
        개인, 부부, 가족, 공동 수목장부터 잔디장까지 다양한 선택지를
        제공합니다.
      </div>
    </div>
    <!-- 설명 table type5-1 -->
    <div class="wrap-explain-round">
      <div class="wrap-explain-table type5-1">
        <div class="explain-item item-header">타입</div>
        <div class="explain-item item-header">위치</div>
        <div class="explain-item item-header">특징</div>
        <div class="explain-item item-header">적합한분</div>
        <div class="explain-item item-header">가격대</div>
        <div class="explain-item">일반 봉안실</div>
        <div class="explain-item">1~3 층</div>
        <div class="explain-item">개인형 (1위) 투명 유리문 자연 채광</div>
        <div class="explain-item">개인 안치를 원하시는 분</div>
        <div class="explain-item">200 만원 ~ 800 만원</div>
        <div class="explain-item">가족 봉안실</div>
        <div class="explain-item">지하 1층~3층</div>
        <div class="explain-item">
          4위/6위 가족 통합 공간 맞춤 인테리어
        </div>
        <div class="explain-item">가족 함께 모시고 싶은 분</div>
        <div class="explain-item">600 만원 ~ 3,000 만원</div>
        <div class="explain-item">프리미엄 봉안실</div>
        <div class="explain-item">3층</div>
        <div class="explain-item">스카이뷰 최상층 전망 독립 공간</div>
        <div class="explain-item">품격과 전망을 중시하는 분</div>
        <div class="explain-item">1,000 만원 ~ 2,500 만원</div>
      </div>
    </div>
    <div class="wrap-subscription-product-detail">
      <div class="subscription-detail-item">
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_internal_part01.png"
          alt="일반 봉안실(Standard)"
        />
        <div class="subscription-detail-item-desc">
          <div class="tit">일반 봉안실(Standard)</div>
          <div class="detail-desc-lists">
            <div class="detail-desc">개인형 안치단 (1위)</div>
            <div class="detail-desc">
              투명 유리문으로 고인 사진 및 유품 안치 가능
            </div>
            <div class="detail-desc">
              자연 채광이 스며드는 쾌적한 공간
            </div>
            <div class="detail-desc">화강석 또는 대리석 명패</div>
            <div class="detail-desc">1~9단 높이별 선택 가능</div>
            <div class="detail-desc">1층, 2층, 3층 층별 선택</div>
          </div>
        </div>
      </div>
      <div class="subscription-detail-item reverse">
        <div class="subscription-detail-item-desc">
          <div class="tit">가족 봉안실(Family)</div>
          <div class="detail-desc-lists">
            <div class="detail-desc">가족 통합 안치단 (4위/6위)</div>
            <div class="detail-desc">
              가족 통합 명패 (가족 이름 모두 새김)
            </div>
            <div class="detail-desc">내부 인테리어 맞춤 가능</div>
            <div class="detail-desc">독립 참배 공간 (일부 구역)</div>
            <div class="detail-desc">넓고 깊은 여유로운 설계</div>
            <div class="detail-desc">프라이빗한 추모 공간</div>
          </div>
        </div>
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_internal_part02.png"
          alt="가족 봉안실(Family)"
        />
      </div>
      <div class="subscription-detail-item">
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_internal_part03.png"
          alt="프리미엄 봉안실(Premium)"
        />
        <div class="subscription-detail-item-desc">
          <div class="tit">프리미엄 봉안실(Premium)</div>
          <div class="detail-desc-lists">
            <div class="detail-desc">3층 최상층 위치</div>
            <div class="detail-desc">전망대 인접, 하늘누리 전경 조망</div>
            <div class="detail-desc">자연 채광 극대화 (천장 채광창)</div>
            <div class="detail-desc">독립된 프라이빗 공간</div>
            <div class="detail-desc">맞춤형 인테리어 디자인 가능</div>
            <div class="detail-desc">VIP 유족 대기실 우선 이용</div>
            <div class="detail-desc">
              천연 대리석 명패 (프리미엄 재질)
            </div>
            <div class="detail-desc">전용 주차 공간 배정</div>
          </div>
        </div>
      </div>
    </div>
    <!-- 분양순서 2 -->
    <div class="wrap-explain">
      <div class="explain-tit">
        <strong>2</strong>nd<span>봉안단 타입 선택</span>
      </div>
      <div class="explain-desc">
        하늘누리 수목장은 수령 20년 이상의 국내 자생종만을 엄선하여
        식재합니다.
      </div>
      <div class="explain-desc">
        나무는 묘비가 되고, 숲은 추모의 성전이 됩니다.고인의 성품과 가족의
        마음에 맞는 나무를 선택하세요.
      </div>
    </div>
    <!-- 설명 table type6-2 -->
    <div class="wrap-explain-round">
      <div class="wrap-explain-table type6-2">
        <div class="explain-item item-header">구분</div>
        <div class="explain-item item-header">안치가능</div>
        <div class="explain-item item-header">공간</div>
        <div class="explain-item item-header">명패</div>
        <div class="explain-item item-header">추모방식</div>
        <div class="explain-item item-header">가격</div>
        <div class="explain-item">일반 봉안실</div>
        <div class="explain-item">1~3 층</div>
        <div class="explain-item">독립형 개인 공간</div>
        <div class="explain-item">개인 명패</div>
        <div class="explain-item">개인 중심 추모</div>
        <div class="explain-item">단일가격</div>
        <div class="explain-item">가족 봉안실</div>
        <div class="explain-item">지하 1층~3층</div>
        <div class="explain-item">부부 함께 공간</div>
        <div class="explain-item">부부 통합 명패</div>
        <div class="explain-item">부부 함께 추모</div>
        <div class="explain-item">개인단 * 2배</div>
      </div>
    </div>
    <div class="wrap-subscription-product-detail">
      <div class="subscription-detail-item">
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_internal_part04.png"
          alt="개인단(Individual)"
        />
        <div class="subscription-detail-item-desc">
          <div class="tit">개인단(Individual)</div>
          <div class="tit-sub">고인의 평온한 영면을 위한 독립형 공간</div>
          <div class="detail-desc-lists">
            <div class="detail-desc">1위 전용 안치</div>
            <div class="detail-desc">인접 단의 간섭 없이 독립적</div>
            <div class="detail-desc">
              조용히 추모에 집중할 수 있는 공간
            </div>
            <div class="detail-desc">화강석 또는 대리석 명패</div>
            <div class="detail-desc">
              개인 명패 (이름, 생몰년월일, 호 등)
            </div>
            <div class="detail-desc">
              유품 및 사진 배치 가능 (투명 유리문)
            </div>
          </div>
        </div>
      </div>
      <div class="subscription-detail-item reverse">
        <div class="subscription-detail-item-desc">
          <div class="tit">부부단(Couple)</div>
          <div class="tit-sub">
            사랑하는 이와 함께 안식하실 수 있는 프라이빗 공간
          </div>
          <div class="detail-desc-lists">
            <div class="detail-desc">2위 함께 안치</div>
            <div class="detail-desc">
              부부 통합 명패 (두 분 이름 함께)
            </div>
            <div class="detail-desc">평온한 분위기 속 함께 추모</div>
            <div class="detail-desc">좌우 배치로 나란히 모심</div>
            <div class="detail-desc">가족이 한 곳에서 참배 가능</div>
          </div>
        </div>
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_internal_part05.png"
          alt="부부단(Couple)"
        />
      </div>
    </div>
    <!-- 분양순서 3 -->
    <div class="wrap-explain">
      <div class="explain-tit">
        <strong>3</strong>rd<span>단 위치 선택</span>
      </div>
      <div class="explain-desc">
        안당 내에서도 층별, 단별 위치에 따라 참배 편의성, 채광, 분위기가
        달라집니다.
      </div>
      <div class="explain-desc">
        하늘누리는 모든 안치단이 고급 소재로 제작되며 위치에 따른 차등
        가격로 선택의 폭을 넓혔습니다.
      </div>
    </div>
    <!-- 설명 table type5-2 -->
    <div class="wrap-explain-round">
      <div class="wrap-explain-table type5-2">
        <div class="explain-item item-header">단</div>
        <div class="explain-item item-header">높이특징</div>
        <div class="explain-item item-header">참배 면의성</div>
        <div class="explain-item item-header">가격(개인단)</div>
        <div class="explain-item item-header">가격(부부단)</div>
        <div class="explain-item">9단</div>
        <div class="explain-item">최상단</div>
        <div class="explain-item">고개 들어 참배</div>
        <div class="explain-item">200 만원</div>
        <div class="explain-item">400 만원</div>
        <div class="explain-item">8단</div>
        <div class="explain-item">상단</div>
        <div class="explain-item">약간위</div>
        <div class="explain-item">250 만원</div>
        <div class="explain-item">500 만원</div>
        <div class="explain-item">7단</div>
        <div class="explain-item">상단</div>
        <div class="explain-item">편안한 높이</div>
        <div class="explain-item">300 만원</div>
        <div class="explain-item">600 만원</div>
        <div class="explain-item">6단</div>
        <div class="explain-item">중단</div>
        <div class="explain-item">눈높이(인기)</div>
        <div class="explain-item">400 만원</div>
        <div class="explain-item">800 만원</div>
        <div class="explain-item">5단</div>
        <div class="explain-item">중단</div>
        <div class="explain-item">최적높이(인기)</div>
        <div class="explain-item">450 만원</div>
        <div class="explain-item">900 만원</div>
        <div class="explain-item">4단</div>
        <div class="explain-item">중단</div>
        <div class="explain-item">현안한 높이(인기)</div>
        <div class="explain-item">400 만원</div>
        <div class="explain-item">800 만원</div>
        <div class="explain-item">3단</div>
        <div class="explain-item">하단</div>
        <div class="explain-item">약간 낮음</div>
        <div class="explain-item">300 만원</div>
        <div class="explain-item">600 만원</div>
        <div class="explain-item">2단</div>
        <div class="explain-item">하단</div>
        <div class="explain-item">허리 숙임</div>
        <div class="explain-item">250 만원</div>
        <div class="explain-item">500 만원</div>
        <div class="explain-item">1단</div>
        <div class="explain-item">최하단</div>
        <div class="explain-item">앉아서 참배</div>
        <div class="explain-item">200 만원</div>
        <div class="explain-item">400 만원</div>
      </div>
    </div>
    <div class="wrap-main-img procedure02"></div>
    <!-- Wrap Detail Lists -->
    <div class="wrap-round-detail">
      <div class="wrap-round-detail-lists">
        <div class="round-detail-list-item">
          <div class="tit">참배 편의성 우선</div>
          <div class="tit-sub">추천: 4~6단 (중단)</div>
          <div class="wrap-detail-lists">
            <div class="item">서서 자연스러운 눈높이</div>
            <div class="item">허리 굽히지 않고 참배 가능</div>
            <div class="item">고령 유족도 편안하게 참배</div>
            <div class="item">가장 많이 선호되는 구간</div>
          </div>
        </div>
        <div class="round-detail-list-item">
          <div class="tit">가격 효율성 측면</div>
          <div class="tit-sub">추천: 1~3단 (하단) 또는 7~9단 (상단)</div>
          <div class="wrap-detail-lists">
            <div class="item">중단 대비 20~40% 저렴</div>
            <div class="item">동일한 시설과 관리</div>
            <div class="item">앉아서 또는 고개 들어 참배</div>
            <div class="item">예산 절감 효과</div>
          </div>
        </div>
        <div class="round-detail-list-item">
          <div class="tit">채광 및 분위기 측면</div>
          <div class="tit-sub">추천: 2~3층 고단</div>
          <div class="wrap-detail-lists">
            <div class="item">자연 채광 최대</div>
            <div class="item">밝고 쾌적한 분위기</div>
            <div class="item">하늘과 가까운 느낌</div>
            <div class="item">프리미엄 공간감</div>
          </div>
        </div>
      </div>
    </div>
    <!-- 분양순서 4 -->
    <div class="wrap-explain">
      <div class="explain-tit">
        <strong>4</strong>th<span>사용권 계약</span>
      </div>
      <div class="explain-desc">
        하늘누리는 재단법인 운영으로 법률 검토를 마친 표준 계약서를
        사용합니다.
      </div>
      <div class="explain-desc">
        전용 상담실에서 편안하게 계약을 진행하며,모든 조항을 명확히
        설명해드립니다.
      </div>
    </div>
    <div class="wrap-subscription-product-detail">
      <div class="subscription-detail-item">
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_internal_part06.png"
          alt="계약관련 필요 서류"
        />
        <div class="subscription-detail-item-desc">
          <div class="tit">계약관련 필요 서류</div>
          <table class="subscription-detail-item-table">
            <thead>
              <tr>
                <th>구분</th>
                <th>필수서류</th>
                <th>비고</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>개인 계약</td>
                <td>
                  <ul class="list-item">
                    <li>신분증 원본</li>
                    <li>도장 또는 서명</li>
                  </ul>
                </td>
                <td>본인 계약 시</td>
              </tr>
              <tr>
                <td>대리인 계약</td>
                <td>
                  <ul class="list-item">
                    <li>위임장</li>
                    <li>대리인 신분증</li>
                    <li>계약자 신분증 사본</li>
                  </ul>
                </td>
                <td>대리 계약 시</td>
              </tr>
              <tr>
                <td>법인 계약</td>
                <td>
                  <ul class="list-item">
                    <li>사업자등록증</li>
                    <li>법인인감증명서</li>
                    <li>대표자 신분증</li>
                  </ul>
                </td>
                <td>법인 명의 시</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="subscription-detail-item reverse">
        <div class="subscription-detail-item-desc step">
          <div class="tit">계약 단계</div>
          <div class="wrap-order-lists">
            <button type="button" class="order-item">
              <div class="wrap-text">
                <div class="label"><strong>1</strong>st</div>
                <div class="desc">계약 내용 최종확인</div>
              </div>
              <div class="text">선택한 봉안실 위치 재확인</div>
            </button>
            <button type="button" class="order-item">
              <div class="wrap-text">
                <div class="label"><strong>2</strong>nd</div>
                <div class="desc">계약서 설명 및 작성</div>
              </div>
              <div class="text">봉안시설 사용권 계약서 (표준양식)</div>
            </button>
            <button type="button" class="order-item">
              <div class="wrap-text">
                <div class="label"><strong>3</strong>rd</div>
                <div class="desc">계약금 납부</div>
              </div>
              <div class="text">계약금 30% 즉시 납부</div>
            </button>
            <button type="button" class="order-item">
              <div class="wrap-text">
                <div class="label"><strong>4</strong>th</div>
                <div class="desc">향후 일정 안내</div>
              </div>
              <div class="text">향후 제반 일정 기타 관련 안내</div>
            </button>
          </div>
        </div>
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_internal_part07.png"
          alt="계약 단계"
        />
      </div>
    </div>
    <!-- 분양순서 5 -->
    <div class="wrap-explain">
      <div class="explain-tit">
        <strong>5</strong>th<span>관리비 납부</span>
      </div>
      <div class="explain-desc">
        하늘누리는 재단법인 운영으로 법률 검토를 마친 표준 계약서를
        사용합니다.
      </div>
      <div class="explain-desc">
        전용 상담실에서 편안하게 계약을 진행하며,모든 조항을 명확히
        설명해드립니다.
      </div>
    </div>
    <div class="wrap-subscription-product-detail">
      <div class="subscription-detail-item">
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_internal_part08.png"
          alt="계약 기간"
        />
        <div class="subscription-detail-item-desc">
          <div class="tit">계약 기간</div>
          <table class="subscription-detail-item-table">
            <thead>
              <tr>
                <th>구분</th>
                <th>개인단</th>
                <th>부부단</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>일반 봉안실</td>
                <td>50 만원 / 5년</td>
                <td>100 만원 / 5년</td>
              </tr>
              <tr>
                <td>가족 봉안실</td>
                <td>50 만원 / 5년(1 위당)</td>
                <td>100 만원 / 5년(2위)</td>
              </tr>
              <tr>
                <td>프리미엄 봉안실</td>
                <td>80 만원 / 5년</td>
                <td>160 만원 / 5년</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="subscription-detail-item reverse">
        <div class="subscription-detail-item-desc">
          <div class="tit">관리비 납부 일정</div>
          <div class="wrap-schedule">
            <p class="schedule-text">
              1차 관리비: 최초 안치일로부터 5년분 선납
            </p>
            <p class="schedule-text">2차 관리비: 5년 후 갱신 시</p>
          </div>
          <div class="wrap-schedule">
            <p class="schedule-text">
              ※ 사전 준비 가능: 안치 전에 미리 납부 가능
            </p>
            <p class="schedule-text">
              ※ 사전계약 혜택: 5년 관리비 면제 (사전계약 고객)
            </p>
          </div>
        </div>
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_internal_part09.png"
          alt="관리비 납부 일정"
        />
      </div>
    </div>
  </div>
  <div class="cont-subscription">
    <div class="wrap-order-lists">
      <button type="button" class="order-item">
        <div class="wrap-text">
          <div class="label"><strong>1</strong>th</div>
          <div class="desc">수목장 타입 선택</div>
        </div>
        <div class="text">더 알아보기</div>
      </button>
      <button type="button" class="order-item">
        <div class="wrap-text">
          <div class="label"><strong>2</strong>nd</div>
          <div class="desc">수목 선택</div>
        </div>
        <div class="text">더 알아보기</div>
      </button>
      <button type="button" class="order-item">
        <div class="wrap-text">
          <div class="label"><strong>3</strong>rd</div>
          <div class="desc">구역 위치 선택</div>
        </div>
        <div class="text">더 알아보기</div>
      </button>
      <button type="button" class="order-item">
        <div class="wrap-text">
          <div class="label"><strong>4</strong>th</div>
          <div class="desc">사용권 계약</div>
        </div>
        <div class="text">더 알아보기</div>
      </button>
      <button type="button" class="order-item">
        <div class="wrap-text">
          <div class="label"><strong>5</strong>th</div>
          <div class="desc">관리비 납부</div>
        </div>
        <div class="text">더 알아보기</div>
      </button>
    </div>
    <div class="wrap-main-img procedure03"></div>
    <!-- 분양순서 1 -->
    <div class="wrap-explain">
      <div class="explain-tit">
        <strong>1</strong>st<span>수목장 타입 선택</span>
      </div>
      <div class="explain-desc">
        하늘누리 수목장은 화장 후 유골을 자연 분해 용기에 담아 나무 뿌리
        깊이 안치하는 친환경 자연장입니다.
      </div>
      <div class="explain-desc">
        개인, 부부, 가족, 공동 수목장부터 잔디장까지 다양한 선택지를
        제공합니다.
      </div>
    </div>
    <!-- 설명 table type5-1 -->
    <div class="wrap-explain-round">
      <div class="wrap-explain-table type5-1">
        <div class="explain-item item-header">타입</div>
        <div class="explain-item item-header">면적</div>
        <div class="explain-item item-header">안치 가능</div>
        <div class="explain-item item-header">특징</div>
        <div class="explain-item item-header">가격대</div>
        <div class="explain-item">개인 수목장</div>
        <div class="explain-item">30㎡ 이하</div>
        <div class="explain-item">1위</div>
        <div class="explain-item">개발 나무, 개인 표석</div>
        <div class="explain-item">300 만원 ~ 500 만원</div>
        <div class="explain-item">부부 수목장</div>
        <div class="explain-item">50㎡ 이하</div>
        <div class="explain-item">2위</div>
        <div class="explain-item">대형 수목, 부부 표석</div>
        <div class="explain-item">600 만원 ~ 800 만원</div>
      </div>
    </div>
    <div class="wrap-subscription-product-detail">
      <div class="subscription-detail-item">
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_external_part01.png"
          alt="개인 수목장(Individual)"
        />
        <div class="subscription-detail-item-desc">
          <div class="tit">개인 수목장(Individual)</div>
          <div class="detail-desc-lists">
            <div class="detail-desc">1위 전용 안치</div>
            <div class="detail-desc">30㎡ 이하 개별 공간</div>
            <div class="detail-desc">
              나무 수종 선택 (소나무, 느티나무, 벚나무, 단풍나무)
            </div>
            <div class="detail-desc">개인 표석 (화강석 20cm x 30cm)</div>
            <div class="detail-desc">표석에 이름, 생몰년월일 새김</div>
            <div class="detail-desc">번호패 부착</div>
            <div class="detail-desc">정기 관리 (연 4회 제초 및 조경)</div>
          </div>
        </div>
      </div>
      <div class="subscription-detail-item reverse">
        <div class="subscription-detail-item-desc">
          <div class="tit">부부 수목장(Couple)</div>
          <div class="detail-desc-lists">
            <div class="detail-desc">2위 함께 안치</div>
            <div class="detail-desc">50㎡ 이하 공간</div>
            <div class="detail-desc">대형 수목 (수령 20년 이상)</div>
            <div class="detail-desc">
              부부 통합 표석 (화강석 30cm x 40cm)
            </div>
            <div class="detail-desc">나란히 또는 좌우 배치</div>
            <div class="detail-desc">벤치 설치 가능 (옵션)</div>
          </div>
        </div>
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_external_part02.png"
          alt="부부 수목장(Couple)"
        />
      </div>
      <div class="subscription-detail-item">
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_external_part03.png"
          alt="가족 수목장(Family)"
        />
        <div class="subscription-detail-item-desc">
          <div class="tit">가족 수목장(Family)</div>
          <div class="detail-desc-lists">
            <div class="detail-desc">3~4위 안치 가능</div>
            <div class="detail-desc">100㎡ 이하 넓은 공간</div>
            <div class="detail-desc">천년송 또는 대형 수목</div>
            <div class="detail-desc">
              가족 통합 표석 (화강석 40cm x 60cm)
            </div>
            <div class="detail-desc">조경석 및 벤치 설치</div>
            <div class="detail-desc">가족 전용 산책로 연결 가능</div>
          </div>
        </div>
      </div>
      <div class="subscription-detail-item reverse">
        <div class="subscription-detail-item-desc">
          <div class="tit">공동 수목장(Community)</div>
          <div class="detail-desc-lists">
            <div class="detail-desc">
              여러 위를 한 그루 큰 나무 아래 안치
            </div>
            <div class="detail-desc">경제적이면서도 품격 유지</div>
            <div class="detail-desc">공동 추모비에 이름 새김</div>
            <div class="detail-desc">합동 추모제 참석 가능</div>
          </div>
        </div>
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_external_part04.png"
          alt="공동 수목장(Community)"
        />
      </div>
      <div class="subscription-detail-item">
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_external_part05.png"
          alt="잔디장(Grass Memorial)"
        />
        <div class="subscription-detail-item-desc">
          <div class="tit">잔디장(Grass Memorial)</div>
          <div class="detail-desc-lists">
            <div class="detail-desc">잔디 평지에 안치</div>
            <div class="detail-desc">1㎡당 1위</div>
            <div class="detail-desc">개별 표석 설치</div>
            <div class="detail-desc">깔끔하고 현대적 디자인</div>
            <div class="detail-desc">개방적인 공간감</div>
          </div>
        </div>
      </div>
    </div>
    <!-- 분양순서 2 -->
    <div class="wrap-explain">
      <div class="explain-tit">
        <strong>2</strong>nd<span>수목 선택</span>
      </div>
      <div class="explain-desc">
        하늘누리 수목장은 수령 20년 이상의 국내 자생종만을 엄선하여
        식재합니다.
      </div>
      <div class="explain-desc">
        나무는 묘비가 되고, 숲은 추모의 성전이 됩니다.고인의 성품과 가족의
        마음에 맞는 나무를 선택하세요.
      </div>
    </div>
    <div class="wrap-subscription-product-detail">
      <div class="subscription-detail-item">
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_external_part06.png"
          alt="소나무(Korean Pine)"
        />
        <div class="subscription-detail-item-desc">
          <div class="tit">소나무(Korean Pine)</div>
          <div class="detail-desc-lists">
            <div class="detail-desc">사계절 푸른 잎</div>
            <div class="detail-desc">강인한 생명력</div>
            <div class="detail-desc">수령 100년 이상 장수</div>
            <div class="detail-desc">전통적으로 가장 선호되는 수종</div>
            <div class="detail-desc">한국의 정서와 가장 잘 어울림</div>
          </div>
        </div>
      </div>
      <div class="subscription-detail-item reverse">
        <div class="subscription-detail-item-desc">
          <div class="tit">느티나무(Zelkova)</div>
          <div class="detail-desc-lists">
            <div class="detail-desc">수백 년 장수 수종</div>
            <div class="detail-desc">넓은 그늘 제공</div>
            <div class="detail-desc">마을 어귀 수호목 역할</div>
            <div class="detail-desc">봄 신록, 가을 단풍 아름다움</div>
            <div class="detail-desc">가족을 지키는 상징</div>
          </div>
        </div>
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_external_part07.png"
          alt="느티나무(Zelkova)"
        />
      </div>
      <div class="subscription-detail-item">
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_external_part08.png"
          alt="벗나무(Cherry Blossom)"
        />
        <div class="subscription-detail-item-desc">
          <div class="tit">벗나무(Cherry Blossom)</div>
          <div class="detail-desc-lists">
            <div class="detail-desc">봄철 화려한 꽃</div>
            <div class="detail-desc">낭만적 분위기</div>
            <div class="detail-desc">젊은 층 선호</div>
            <div class="detail-desc">포토존으로 인기</div>
            <div class="detail-desc">벚꽃 축제 기간 아름다움</div>
          </div>
        </div>
      </div>
    </div>
    <!-- 분양순서 3 -->
    <div class="wrap-explain">
      <div class="explain-tit">
        <strong>3</strong>rd<span>구역 위치 선택</span>
      </div>
      <div class="explain-desc">
        하늘누리 수목장은 전체 부지가 자연 경관과 조화를 이루도록
        설계되었습니다.
      </div>
      <div class="explain-desc">
        위치에 따라 전망, 접근성, 일조량이 달라지며 가격도 차등
        적용됩니다.
      </div>
    </div>
    <!-- 설명 table type5-2 -->
    <div class="wrap-explain-round">
      <div class="wrap-explain-table type5-2">
        <div class="explain-item item-header">구분</div>
        <div class="explain-item item-header">A 구역</div>
        <div class="explain-item item-header">B 구역</div>
        <div class="explain-item item-header">C 구역</div>
        <div class="explain-item item-header">D 구역</div>
        <div class="explain-item">특징</div>
        <div class="explain-item">전망 최고</div>
        <div class="explain-item">산책로 인접</div>
        <div class="explain-item">조용한 숲속</div>
        <div class="explain-item">공동 수목장</div>
      </div>
    </div>
    <div class="wrap-subscription-product-detail">
      <div class="subscription-detail-item reverse">
        <div class="subscription-detail-item-desc">
          <div class="tit">A 구역(Premium Zone)</div>
          <div class="detail-desc-lists">
            <div class="detail-desc">전망대 인접, 하늘누리 전경 조망</div>
            <div class="detail-desc">남향 또는 동향</div>
            <div class="detail-desc">일조량 최고</div>
            <div class="detail-desc">산책로 직접 연결</div>
            <div class="detail-desc">계절별 꽃 정원 인접</div>
          </div>
        </div>
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_external_part09.png"
          alt="A 구역(Premium Zone)"
        />
      </div>
      <div class="subscription-detail-item">
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_external_part10.png"
          alt="B 구역 (Standard Zone)"
        />
        <div class="subscription-detail-item-desc">
          <div class="tit">B 구역 (Standard Zone)</div>
          <div class="detail-desc-lists">
            <div class="detail-desc">산책로 바로 인접</div>
            <div class="detail-desc">동향 또는 남동향</div>
            <div class="detail-desc">일조량 양호</div>
            <div class="detail-desc">접근성 우수</div>
            <div class="detail-desc">벤치 및 휴게 공간 근처</div>
          </div>
        </div>
      </div>
      <div class="subscription-detail-item reverse">
        <div class="subscription-detail-item-desc">
          <div class="tit">C 구역(Forest Zone)</div>
          <div class="detail-desc-lists">
            <div class="detail-desc">깊은 숲속 조용한 공간</div>
            <div class="detail-desc">북향 또는 북동향</div>
            <div class="detail-desc">나무 그늘 아래 시원함</div>
            <div class="detail-desc">프라이빗한 분위기</div>
            <div class="detail-desc">새소리와 자연 소리</div>
          </div>
        </div>
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_external_part11.png"
          alt="C 구역(Forest Zone)"
        />
      </div>
      <div class="subscription-detail-item">
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_external_part12.png"
          alt="D 구역 (Community Zone)"
        />
        <div class="subscription-detail-item-desc">
          <div class="tit">D 구역 (Community Zone)</div>
          <div class="detail-desc-lists">
            <div class="detail-desc">공동 수목장 전용 구역</div>
            <div class="detail-desc">대형 천년송 5그루</div>
            <div class="detail-desc">공동 추모비</div>
            <div class="detail-desc">합동 추모제 공간</div>
          </div>
        </div>
      </div>
    </div>
    <!-- 분양순서 4 -->
    <div class="wrap-explain">
      <div class="explain-tit">
        <strong>4</strong>th<span>사용권 계약</span>
      </div>
      <div class="explain-desc">
        수목장 사용권 계약은 자연 회귀의 철학을 실천하는 첫걸음입니다.
      </div>
      <div class="explain-desc">
        투명하고 명확한 계약으로 평생 안심하고 모실 수 있도록
        약속드립니다.
      </div>
    </div>
    <div class="wrap-subscription-product-detail">
      <div class="subscription-detail-item">
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_external_part13.png"
          alt="계약관련 필요 서류"
        />
        <div class="subscription-detail-item-desc">
          <div class="tit">계약관련 필요 서류</div>
          <table class="subscription-detail-item-table">
            <thead>
              <tr>
                <th>구분</th>
                <th>필수서류</th>
                <th>비고</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>개인 계약</td>
                <td>
                  <ul class="list-item">
                    <li>신분증 원본</li>
                    <li>도장 또는 서명</li>
                  </ul>
                </td>
                <td>본인 계약 시</td>
              </tr>
              <tr>
                <td>대리인 계약</td>
                <td>
                  <ul class="list-item">
                    <li>위임장</li>
                    <li>대리인 신분증</li>
                    <li>계약자 신분증 사본</li>
                  </ul>
                </td>
                <td>대리 계약 시</td>
              </tr>
              <tr>
                <td>법인 계약</td>
                <td>
                  <ul class="list-item">
                    <li>사업자등록증</li>
                    <li>법인인감증명서</li>
                    <li>대표자 신분증</li>
                  </ul>
                </td>
                <td>법인 명의 시</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="subscription-detail-item reverse">
        <div class="subscription-detail-item-desc step">
          <div class="tit">계약 단계</div>
          <div class="wrap-order-lists">
            <button type="button" class="order-item">
              <div class="wrap-text">
                <div class="label"><strong>1</strong>st</div>
                <div class="desc">계약 내용 최종확인</div>
              </div>
              <div class="text">선택한 봉안실 위치 재확인</div>
            </button>
            <button type="button" class="order-item">
              <div class="wrap-text">
                <div class="label"><strong>2</strong>nd</div>
                <div class="desc">계약서 설명 및 작성</div>
              </div>
              <div class="text">봉안시설 사용권 계약서 (표준양식)</div>
            </button>
            <button type="button" class="order-item">
              <div class="wrap-text">
                <div class="label"><strong>3</strong>rd</div>
                <div class="desc">계약금 납부</div>
              </div>
              <div class="text">계약금 30% 즉시 납부</div>
            </button>
          </div>
        </div>
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_external_part14.png"
          alt="계약 단계"
        />
      </div>
    </div>
    <!-- 분양순서 5 -->
    <div class="wrap-explain">
      <div class="explain-tit">
        <strong>5</strong>th<span>관리비 납부</span>
      </div>
      <div class="explain-desc">
        수목장 관리비는 나무의 성장과 관리,구역 조경 및 유지보수에
        사용됩니다.
      </div>
      <div class="explain-desc">
        5년 단위로 선납하며, 자연 친화적으로 관리합니다.
      </div>
    </div>
    <!-- 설명 table type6-1 -->
    <div class="wrap-explain-round">
      <div class="wrap-explain-table type6-1">
        <div class="explain-item item-header">구분</div>
        <div class="explain-item item-header">개인 수목장</div>
        <div class="explain-item item-header">부부 수목장</div>
        <div class="explain-item item-header">가족 수목장</div>
        <div class="explain-item item-header">공동 수목장</div>
        <div class="explain-item item-header">잔디장</div>
        <div class="explain-item">관리비(5년)</div>
        <div class="explain-item">100 만원</div>
        <div class="explain-item">150 만원</div>
        <div class="explain-item">200 만원</div>
        <div class="explain-item">30 만원</div>
        <div class="explain-item">80 만원</div>
      </div>
    </div>
    <div class="wrap-main-img procedure04"></div>
    <!-- Wrap Detail Lists -->
    <div class="wrap-round-detail">
      <div class="tit">관리비 포함 서비스</div>
      <div class="wrap-round-detail-lists">
        <div class="round-detail-list-item">
          <div class="tit">나무 관리</div>
          <div class="wrap-detail-lists">
            <div class="item">계절별 제초 및 조경 (연 4회)</div>
            <div class="item">수형 관리 및 전지 (연 1회)</div>
            <div class="item">영양제 및 비료 공급 (연 2~3회)</div>
            <div class="item">나무 성장 모니터링</div>
          </div>
        </div>
        <div class="round-detail-list-item">
          <div class="tit">구역관리</div>
          <div class="wrap-detail-lists">
            <div class="item">산책로 유지보수</div>
            <div class="item">계절별 꽃 식재</div>
            <div class="item">잡초 제거</div>
            <div class="item">배수로 관리</div>
          </div>
        </div>
        <div class="round-detail-list-item">
          <div class="tit">표석 관리</div>
          <div class="wrap-detail-lists">
            <div class="item">표석 청소 (분기별)</div>
            <div class="item">명패 광택</div>
            <div class="item">주변 정돈</div>
          </div>
        </div>
        <div class="round-detail-list-item">
          <div class="tit">추가 서비스</div>
          <div class="wrap-detail-lists">
            <div class="item">나무 성장 사진 발송 (연 2회)</div>
            <div class="item">명절 특별 관리 (연 2회)</div>
            <div class="item">합동 추모제 개최 (연 2회)</div>
          </div>
        </div>
      </div>
    </div>
    <div class="wrap-subscription-product-detail">
      <div class="subscription-detail-item reverse">
        <div class="subscription-detail-item-desc">
          <div class="tit">관리비 납부 일정</div>
          <div class="wrap-schedule">
            <p class="schedule-text">
              1차 관리비: 최초 안치일로부터 5년분 선납
            </p>
            <p class="schedule-text">2차 관리비: 5년 후 갱신 시</p>
          </div>
          <div class="wrap-schedule">
            <p class="schedule-text">
              ※ 사전 준비 가능: 안치 전에 미리 납부 가능
            </p>
            <p class="schedule-text">
              ※ 사전계약 혜택: 5년 관리비 면제 (사전계약 고객)
            </p>
          </div>
          <div class="tit">장기 선납 할인</div>
          <div class="wrap-schedule">
            <p class="schedule-text">10년 분 선납 시: 5% 할인</p>
            <p class="schedule-text">15년 분 선납 시: 10% 할인</p>
            <p class="schedule-text">20년 분 선납 시: 15% 할인</p>
          </div>
        </div>
        <img
          class="subscription-detail-img"
          src="/img/img_procedure_external_part15.png"
          alt="관리비 납부 일정"
        />
      </div>
    </div>
  </div>
</main>
@endsection

@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".wrap-tab .tab-item");
    const contents = document.querySelectorAll(".cont-subscription");

    if (!tabs.length || !contents.length) return;

    const activateTab = (targetIdx) => {
      tabs.forEach((tab, idx) => {
        tab.classList.toggle("active", idx === targetIdx);
        tab.setAttribute("aria-selected", String(idx === targetIdx));
        tab.setAttribute("tabindex", idx === targetIdx ? "0" : "-1");
      });

      contents.forEach((content, idx) => {
        content.classList.toggle("active", idx === targetIdx);
      });
    };

    tabs.forEach((tab, idx) => {
      tab.addEventListener("click", function () {
        activateTab(idx);
      });

      tab.addEventListener("keydown", function (event) {
        if (event.key === "Enter" || event.key === " ") {
          event.preventDefault();
          activateTab(idx);
        }
      });
    });
  });
</script>
@endpush
