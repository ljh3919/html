@extends('front.layouts.layout')

@section('title', '하늘누리 추모공원')

@section('content')
<main>
  <div class="main intro">
    <!-- Part 01 -->
    <section class="part01">
      <div class="part01-tit01 reveal-text">하늘누리</div>
      <div class="part01-tit02 reveal-text">
        하늘이 머무는 언덕 누리가 펼쳐지는 곳
      </div>
      <div class="part01-tit03 reveal-text">
        자연의 품으로 돌아가 영원히 쉬는 곳<br />
        사계절 아름다움 속에서 고인의 존엄을 지키고<br />사랑하는 이들의
        그리움을 위로하는<br />하늘과 땅이 함께하는 성스러운 안식처입니다.
      </div>
    </section>

    <!-- Part 02 -->
    <section class="part02">
      <div class="part02-tit01 reveal-text">하늘누리 이야기</div>
      <div class="part02-tit02">
        <p class="tit02 reveal-text">
          하늘누리는<br />
          하늘이 내린 평화로운 세상에서<br />
          고인께서 편안히 쉬시고<br />
          유가족께 위안을 얻는 성스러운 안식처입니다.
        </p>
        <p class="tit02 reveal-text">
          하늘누리는 <br />
          죽음을 끝이 아닌 또다른 시작으로 생각합니다.<br />
          자연으로 돌아가 영원히 쉬는 곳<br />
          고인의 존엄과 유가족의 평안을 최우선으로 생각합니다.
        </p>
      </div>
      <div class="wrap-links">
        <a href="{{ route('front.introdu.greeting') }}" class="links-item reveal-text">
          <span>인사말</span>
        </a>
        <a href="{{ route('front.introdu.hnstory') }}" class="links-item reveal-text">
          <span>하늘누리 이야기</span>
        </a>
        <a href="{{ route('front.introdu.perarti') }}" class="links-item reveal-text">
          <span>재단/허가 현황</span>
        </a>
      </div>
    </section>

    <!-- Part 03 -->
    <section class="part03">
      <div class="wrap-story-info">
        <img
          class="img-part"
          src="{{ asset('img/img_main03.png') }}"
          alt="봉안당(하늘누리관)"
        />
        <div class="wrap-sky-part-info">
          <div class="sky-part-info-tit reveal-text">
            봉안당
            <span>(하늘누리관)</span>
          </div>
          <div class="sky-part-info-tit-sub reveal-text">
            천년으로 이어갈 품격의 공간
          </div>
          <div class="sky-part-info-desc reveal-text">
            하늘누리관은 단순한 봉안시설이 아닙니다.<br />
            고인께서는 평안을 얻으시고<br />
            유가족께서는 위안을 받으시는<br />
            하늘과 땅이 함께하는 성스러운 안식처 입니다.
          </div>
          <a href="{{ route('front.facil.bongan') }}" class="sky-par-link reveal-text">
            <span>자세히 알아보기</span>
          </a>
        </div>
      </div>
      <div class="wrap-story-info">
        <img
          class="img-part"
          src="{{ asset('img/img_main04.png') }}"
          alt="자연장(하늘누리관)"
        />
        <div class="wrap-sky-part-info">
          <div class="sky-part-info-tit reveal-text">
            자연장
            <span>(수목장)</span>
          </div>
          <div class="sky-part-info-tit-sub reveal-text">
            자연으로 돌아가는 아름다운 여정
          </div>
          <div class="sky-part-info-desc reveal-text">
            생명은 자연에서 태어나 자연으로 돌아갑니다.<br />
            하늘누리 수목장은 이 숭고한 진리를 따라<br />
            고인께서 자연과 하나 되어 쉬시는<br />
            가장 아름다운 방식 입니다.
          </div>
          <a href="{{ route('front.facil.naburial') }}" class="sky-par-link reveal-text">
            <span>자세히 알아보기</span>
          </a>
        </div>
      </div>
    </section>

    <!-- Part 04 -->
    <section class="part04">
      <div class="part04-tit01 reveal-text">하늘누리 분양안내</div>
      <div class="part04-tit02">
        <p class="tit02 reveal-text">
          영원을 준비하는 가장 현명한 선택<br />
          생의 마지막 순간까지 품격을 지키며 사랑하는 가족에게 평안을
          선물하는<br />
          하늘누리에서<br />
          영원을 약속 받으세요
        </p>
      </div>
      <div class="wrap-product">
        <div class="product-tit reveal-text">
          세가지 선택, 하나의 마음
        </div>
        <ul class="wrap-product-lists">
          <li class="product-item">
            <a href="{{ route('front.distriinfo.distriproce') }}" class="item-link">
              <img
                src="{{ asset('img/img_main_product01.png') }}"
                alt="봉안당 Standard"
                class="product-img"
              />
              <span class="product-name reveal-text"
                >봉안당 Standard</span
              >
            </a>
          </li>
          <li class="product-item">
            <a href="{{ route('front.distriinfo.distriproce') }}" class="item-link">
              <img
                src="{{ asset('img/img_main_product02.png') }}"
                alt="봉안당 Premium"
                class="product-img"
              />
              <span class="product-name reveal-text">봉안당 Premium</span>
            </a>
          </li>
          <li class="product-item">
            <a href="{{ route('front.distriinfo.distriproce') }}" class="item-link">
              <img
                src="{{ asset('img/img_main_product03.png') }}"
                alt="수목장 Nature"
                class="product-img"
              />
              <span class="product-name reveal-text">수목장 Nature</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="wrap-links">
        <a href="{{ route('front.distriinfo.distriproce') }}" class="links-item reveal-text">
          <span>분양절차</span>
        </a>
        <a href="{{ route('front.distriinfo.distriprice') }}" class="links-item reveal-text">
          <span>분양가격</span>
        </a>
        <a href="{{ route('front.distriinfo.applibenefit') }}" class="links-item reveal-text">
          <span>사전청약</span>
        </a>
      </div>
    </section>

    <!-- Part 05 -->
    <section class="part05">
      <div class="part05-tit01 reveal-text">하늘누리 오시는 길</div>
      <div class="part05-tit02 reveal-text">
        하늘누리로 오시는 길,<br />사랑하는 이를 만나러 가는 여정
      </div>
      <div class="wrap-company">
        <div class="sky-info">
          <p class="cellnum reveal-text">대표전화 031-999-9999</p>
          <p class="time reveal-text">
            운영시간 : 연중무휴 오전 09:00 ~ 오후 18:00
          </p>
          <p class="address reveal-text">
            주소 : 경기도 양주시 산북동 산 67-20
          </p>
        </div>
        <img src="{{ asset('img/img_main05.png') }}" alt="약도" class="img-map" />
      </div>
    </section>
  </div>
</main>
@endsection

@push('styles')
<style>
  /* 섹션 텍스트 노출 애니메이션(스크롤 트리거) */
  .reveal-text {
    opacity: 0;
  }
  .reveal-text.is-visible {
    animation: revealUp 700ms ease both;
    animation-delay: var(--reveal-delay, 0ms);
    will-change: opacity, transform;
  }
  @keyframes revealUp {
    from {
      opacity: 0;
      transform: translateY(14px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  @media (prefers-reduced-motion: reduce) {
    .reveal-text.is-visible {
      animation: none;
      opacity: 1;
    }
  }
</style>
@endpush

@push('scripts')
<script>
  /* part01~part05 텍스트 스크롤 노출(뷰포트 top 기준 1/2 라인) */
  (function () {
    const main = document.querySelector(".main.intro");
    if (!main) return;

    const sections = Array.from(main.children).filter(
      (el) => el.tagName === "SECTION",
    );
    const revealElsBySection = sections.map((sec) =>
      Array.from(sec.querySelectorAll(".reveal-text")),
    );

    const shown = new Array(sections.length).fill(false);
    let hasReachedBottom = false;

    function setDelayAndShow(el, delayMs) {
      el.style.setProperty("--reveal-delay", `${delayMs}ms`);
      el.classList.add("is-visible");
    }

    function showSection(idx) {
      if (shown[idx]) return;
      shown[idx] = true;

      const items = revealElsBySection[idx];
      items.forEach((el, i) => {
        el.classList.remove("is-visible");
        // 애니메이션 재시작 balance
        void el.offsetWidth;
        setDelayAndShow(el, i * 140);
      });
    }

    function resetAll() {
      shown.fill(false);
      hasReachedBottom = false;

      revealElsBySection.forEach((items) => {
        items.forEach((el) => {
          el.classList.remove("is-visible");
          el.style.removeProperty("--reveal-delay");
        });
      });
    }

    function handleScroll() {
      const scrollY = window.scrollY || document.documentElement.scrollTop;
      const docHeight = document.documentElement.scrollHeight;
      const bottomThreshold = 120;

      if (scrollY + window.innerHeight >= docHeight - bottomThreshold) {
        hasReachedBottom = true;
      }

      if (hasReachedBottom && scrollY <= 10) {
        resetAll();
      }

      const triggerY = scrollY + window.innerHeight * (2 / 3);

      for (let i = 0; i < sections.length; i++) {
        if (shown[i]) continue;
        const rect = sections[i].getBoundingClientRect();
        const sectionTop = rect.top + scrollY;
        if (sectionTop <= triggerY) {
          showSection(i);
        }
      }
    }

    window.addEventListener("scroll", handleScroll, { passive: true });
    window.addEventListener("resize", handleScroll);

    handleScroll();
  })();
</script>
@endpush
