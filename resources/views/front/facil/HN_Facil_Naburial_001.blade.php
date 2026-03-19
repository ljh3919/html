@extends('front.layouts.layout')

@section('title', '시설안내 - 수목장(자연장)')

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
      <a href="#" class="item">수목장(자연장)</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">수목장<br />(자연장)</h2>
      <div class="tit2-sub">
        자연과 하나 되어 영면하는 친환경 안장 공간입니다.<br />화장 후
        유골을 자연 분해 용기에 담아 나무 아래 안치합니다.
      </div>
    </div>
  </div>
  <div class="wrap-story-info thin">
    <div class="wrap-img-part external">
      <div class="text">
        “그리울 때마다 찾아오는 당신의 숲이 되겠습니다”
      </div>
    </div>
    <div class="wrap-info-outter">
      <div class="wrap-foundation-info">
        <div class="wrap-facilities-info">
          <div class="facilities-item">
            <div class="label">건물구조</div>
            <div class="wrap-desc">
              <div class="desc">내용 확인 필요합니다.</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">총 안치 가능 기수</div>
            <div class="wrap-desc">
              <div class="desc">내용 확인 필요합니다.</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">건축 자재</div>
            <div class="wrap-desc">
              <div class="desc">내용 확인 필요합니다.</div>
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
  <div class="wrap-main-img external01">
    <span>“이곳의 시간은 고귀한 기억으로 흐릅니다.”</span>
  </div>
  <div class="wrap-story-info thin">
    <div class="tit">개인 수목장</div>
    <div class="wrap-info-outter">
      <div class="wrap-foundation-info">
        <div class="wrap-facilities-info">
          <div class="facilities-item">
            <div class="label">규격</div>
            <div class="wrap-desc">
              <div class="desc">30㎡이하</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">안치 위수</div>
            <div class="wrap-desc">
              <div class="desc">1위</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">수종</div>
            <div class="wrap-desc">
              <div class="desc">소나무, 느티나무, 단품나무</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">특징</div>
            <div class="wrap-desc">
              <div class="desc">
                개별 표석 (화강석, 20cm x 30cm)<br />수목 번호패 부착<br />
                개인 추모 공간
              </div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">가격대</div>
            <div class="wrap-desc">
              <div class="desc">가격: 300만원 ~ 500만원</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="wrap-main-img external02">
    <span
      >“하늘 아래 뿌리 내린 고결한 기억,<br />세월이 흐를수록
      깊어집니다.”</span
    >
  </div>
  <div class="wrap-story-info thin">
    <div class="tit">부부(가족) 수목장</div>
    <div class="wrap-info-outter">
      <div class="wrap-foundation-info">
        <div class="wrap-facilities-info">
          <div class="facilities-item">
            <div class="label">규격</div>
            <div class="wrap-desc">
              <div class="desc">100㎡이하</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">안치 위수</div>
            <div class="wrap-desc">
              <div class="desc">2~4위</div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">수종</div>
            <div class="wrap-desc">
              <div class="desc">
                소나무, 느티나무, 단품나무 등 대형수목
              </div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">특징</div>
            <div class="wrap-desc">
              <div class="desc">
                가족 통합 표석 (화강석, 40cm x 60cm)<br />가족명 새김<br />조경석
                및 벤치 설치 가능
              </div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">가격대</div>
            <div class="wrap-desc">
              <div class="desc">가격: 600만원 ~ 1200만원</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="wrap-main-img external03">
    <span>“자연이 빚은 마지막 명당, 하늘누리 수목장”</span>
  </div>
  <div class="wrap-story-info thin">
    <div class="tit">공동 수목장</div>
    <div class="wrap-info-outter">
      <div class="wrap-foundation-info">
        <div class="wrap-facilities-info">
          <div class="facilities-item">
            <div class="label">특징</div>
            <div class="wrap-desc">
              <div class="desc">
                여러 위를 한 그루 나무 아래 안치<br />경제적 선택<br />공동
                추모비에 이름 새김
              </div>
            </div>
          </div>
          <div class="facilities-item">
            <div class="label">가격대</div>
            <div class="wrap-desc">
              <div class="desc">150만원 ~ 250만원</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="wrap-main-img external04">
    <span
      >“조경 전문가의 손길로 사계절 내내 푸른 기억을 약속합니다.”</span
    >
  </div>
  <div class="tit-section">수목장 관리서비스</div>
  <div class="wrap-info-outter">
    <div class="wrap-certification-lists">
      <div class="item">
        <div class="tit">정기관리</div>
        <ul class="certification-lists">
          <li class="certification-item">분기별 제초 및 조경 관리</li>
          <li class="certification-item">수목 병충해 방제</li>
          <li class="certification-item">계절별 꽃 식재</li>
        </ul>
      </div>
      <div class="item">
        <div class="tit">명절 특별관리</div>
        <ul class="certification-lists">
          <li class="certification-item">설날, 추석 전 집중 정비</li>
          <li class="certification-item">표석 청소 및 주변 정리</li>
          <li class="certification-item">표석 청소 및 주변 정리</li>
        </ul>
      </div>
      <div class="item">
        <div class="tit">영구 보장</div>
        <ul class="certification-lists">
          <li class="certification-item">
            재단법인 운영으로 영구 관리 보장
          </li>
          <li class="certification-item">
            관리비 별도 없음(최초 1회 납부 시 포함)
          </li>
        </ul>
      </div>
    </div>
  </div>
</main>
@endsection
