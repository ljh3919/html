@extends('front.layouts.layout')

@section('title', '분양안내 - 분양가격')

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
      <a href="#" class="item">분양 가격</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">분양 가격</h2>
      <div class="tit2-sub">“가격 이상의 가치를 제공합니다”</div>
      <div class="desc">
        하늘누리는 재단법인 운영으로 과도한 영리 추구 없이 합리적인 가격을
        책정합니다.
      </div>
    </div>
  </div>
  <div class="wrap-subscription">
    <ul class="wrap-tab" role="tablist" aria-label="분양 절차 유형">
      <!-- ToDo: 탭 클릭시 .active 추가 및 탭에 맞는 컨텐츠 노출 -->
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
    <div class="wrap-main-img price01"></div>
    <!-- 설명 table type4-1 -->
    <div class="wrap-explain-round">
      <div class="tit">일반 개인 분양가격</div>
      <div class="wrap-explain-table type4-1">
        <div class="explain-item item-header">구분</div>
        <div class="explain-item item-header">1~3 단</div>
        <div class="explain-item item-header">4~6 단</div>
        <div class="explain-item item-header">7~9 단</div>
        <div class="explain-item">1층</div>
        <div class="explain-item">200 만원</div>
        <div class="explain-item">350 만원</div>
        <div class="explain-item">250 만원</div>
        <div class="explain-item">2층</div>
        <div class="explain-item">250 만원</div>
        <div class="explain-item">450 만원</div>
        <div class="explain-item">300 만원</div>
        <div class="explain-item">3층</div>
        <div class="explain-item">300 만원</div>
        <div class="explain-item">550 만원</div>
        <div class="explain-item">350 만원</div>
      </div>
    </div>
    <!-- 설명 table type5-3 -->
    <div class="wrap-explain-round">
      <div class="tit">가족 분양실 분양가격</div>
      <div class="wrap-explain-table type5-3">
        <div class="explain-item item-header">구분</div>
        <div class="explain-item item-header">지하 1층</div>
        <div class="explain-item item-header">1층</div>
        <div class="explain-item item-header">2층</div>
        <div class="explain-item item-header">3층</div>
        <div class="explain-item">4위용</div>
        <div class="explain-item">600 만원</div>
        <div class="explain-item">800 만원</div>
        <div class="explain-item">1,000 만원</div>
        <div class="explain-item">1,200 만원</div>
        <div class="explain-item">6위용</div>
        <div class="explain-item">900 만원</div>
        <div class="explain-item">1,200 만원</div>
        <div class="explain-item">1,500 만원</div>
        <div class="explain-item">1,800 만원</div>
      </div>
    </div>
    <div class="wrap-subscription-product-detail">
      <div class="subscription-detail-item">
        <img
          class="subscription-detail-img"
          src="/img/img_price_part01.png"
          alt="프리미엄 봉안실"
        />
        <div class="subscription-detail-item-desc">
          <div class="tit">프리미엄 봉안실</div>
          <table class="subscription-detail-item-table">
            <thead>
              <tr>
                <th>유형</th>
                <th>위치</th>
                <th>가격</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>개인형</td>
                <td>3층 전망대 인접</td>
                <td>1,000 만원 ~ 1,500 만원</td>
              </tr>
              <tr>
                <td>가족형(4위)</td>
                <td>3층 전망대 인접</td>
                <td>1,800 만원 ~ 2,200 만원</td>
              </tr>
              <tr>
                <td>가족형(6위)</td>
                <td>3층 최상층</td>
                <td>2,200 만원 ~ 2,500 만원</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="cont-subscription">
    <div class="wrap-main-img price02"></div>
    <!-- 설명 table type3-1 -->
    <div class="wrap-explain-round">
      <div class="tit">개인 수목장(수종별) 가격표</div>
      <div class="wrap-explain-table type3-1">
        <div class="explain-item item-header">수종</div>
        <div class="explain-item item-header">규격</div>
        <div class="explain-item item-header">가격</div>
        <div class="explain-item">소나무</div>
        <div class="explain-item">30㎡ 이하</div>
        <div class="explain-item">400 만원</div>
        <div class="explain-item">느티나무</div>
        <div class="explain-item">30㎡ 이하</div>
        <div class="explain-item">450 만원</div>
        <div class="explain-item">벗나무</div>
        <div class="explain-item">30㎡ 이하</div>
        <div class="explain-item">420 만원</div>
      </div>
    </div>
    <!-- 설명 table type4-1 -->
    <div class="wrap-explain-round">
      <div class="tit">부부/가족 수목장(위용벌) 가격표</div>
      <div class="wrap-explain-table type4-1">
        <div class="explain-item item-header">수종</div>
        <div class="explain-item item-header">규격</div>
        <div class="explain-item item-header">안치가능</div>
        <div class="explain-item item-header">가격</div>
        <div class="explain-item">부부형</div>
        <div class="explain-item">50㎡ 이하</div>
        <div class="explain-item">2위</div>
        <div class="explain-item">700 만원</div>
        <div class="explain-item">가족형(소)</div>
        <div class="explain-item">80㎡ 이하</div>
        <div class="explain-item">3위</div>
        <div class="explain-item">950 만원</div>
        <div class="explain-item">가족형(대)</div>
        <div class="explain-item">100㎡ 이하</div>
        <div class="explain-item">4위</div>
        <div class="explain-item">1,200 만원</div>
      </div>
    </div>
    <div class="wrap-main-img price03"></div>
    <!-- 설명 table type3-1 -->
    <div class="wrap-explain-round">
      <div class="tit">공동 수목장</div>
      <div class="wrap-explain-table type3-1">
        <div class="explain-item item-header">구분</div>
        <div class="explain-item item-header">특징</div>
        <div class="explain-item item-header">가격</div>
        <div class="explain-item">공동 수목장</div>
        <div class="explain-item">큰 나무 아래 여러 위 안치</div>
        <div class="explain-item">200 만원</div>
      </div>
    </div>
    <!-- 설명 table type4-1 -->
    <div class="wrap-explain-round">
      <div class="tit">잔디장</div>
      <div class="wrap-explain-table type4-1">
        <div class="explain-item item-header">구분</div>
        <div class="explain-item item-header">규격</div>
        <div class="explain-item item-header">특징</div>
        <div class="explain-item item-header">가격</div>
        <div class="explain-item">잔디장</div>
        <div class="explain-item">1㎡ 당 1 위</div>
        <div class="explain-item">잔디 평지, 개별표식</div>
        <div class="explain-item">250만원 ~ 350 만원</div>
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
