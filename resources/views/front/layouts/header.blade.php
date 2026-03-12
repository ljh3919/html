<header class="header">
  <div class="wrap-header">
    <div class="wrap-mo">
      <a href="{{ route('front.index') }}" class="tit1"><h1>하늘누리 추모공원</h1></a>
      <button type="button" class="btn-menu">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="32"
          height="32"
          viewBox="0 0 32 32"
          fill="none"
        >
          <path
            d="M3 16H29"
            stroke="#333333"
            stroke-width="2"
            stroke-miterlimit="10"
            stroke-linecap="round"
          />
          <path
            d="M3 26H29"
            stroke="#333333"
            stroke-width="2"
            stroke-miterlimit="10"
            stroke-linecap="round"
          />
          <path
            d="M3 6H29"
            stroke="#333333"
            stroke-width="2"
            stroke-miterlimit="10"
            stroke-linecap="round"
          />
        </svg>
      </button>
      <!-- ToDo: 햄버거 메뉴 클릭시 .active 추가 -->
      <div class="wrap-menu-mo">
        <div class="menu-header">
          @if(!auth()->guard('member')->check())
            <div class="account-item"><a href="{{ route('front.join01') }}"><span>회원가입</span></a></div>
            <div class="account-item">
              <a href="{{ route('front.login') }}">
                <span>로그인</span>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                >
                  <path
                    d="M13.7372 12.3052C13.8182 12.1102 13.8182 11.8892 13.7372 11.6932C13.6992 11.6032 13.6432 11.5232 13.5772 11.4532C13.5712 11.4472 13.5702 11.4392 13.5642 11.4332L10.5642 8.43322C10.2512 8.12122 9.74623 8.12122 9.43323 8.43322C9.12023 8.74622 9.12023 9.25221 9.43323 9.56521L11.0672 11.1992H4.99921C4.55821 11.1992 4.19922 11.5572 4.19922 11.9992C4.19922 12.4402 4.55721 12.7992 4.99921 12.7992H11.0672L9.43323 14.4332C9.12023 14.7462 9.12023 15.2532 9.43323 15.5662C9.58923 15.7212 9.79323 15.7992 9.99823 15.7992C10.2032 15.7992 10.4072 15.7212 10.5632 15.5662L13.5632 12.5662C13.5692 12.5602 13.5702 12.5522 13.5762 12.5462C13.6432 12.4762 13.6992 12.3962 13.7372 12.3052Z"
                    fill="#4A4A4A"
                  />
                  <path
                    d="M8.52039 17.4682C9.82439 18.5842 11.4804 19.1992 13.1844 19.1992C17.1544 19.1992 20.3844 15.9702 20.3844 11.9992C20.3844 8.02924 17.1544 4.79922 13.1844 4.79922C11.6244 4.79922 10.1344 5.30022 8.87439 6.24722C8.52139 6.51422 8.01939 6.44223 7.75439 6.08923C7.48839 5.73623 7.56039 5.23524 7.91339 4.96924C9.45239 3.81124 11.2744 3.19922 13.1844 3.19922C18.0374 3.19922 21.9844 7.14624 21.9844 11.9992C21.9844 16.8522 18.0374 20.7992 13.1844 20.7992C11.0994 20.7992 9.07337 20.0482 7.47937 18.6832C7.14437 18.3962 7.10439 17.8912 7.3924 17.5552C7.67939 17.2202 8.18439 17.1812 8.52039 17.4682Z"
                    fill="#4A4A4A"
                  />
                </svg>
              </a>
            </div>
          @else
            <div class="account-item"><a href="{{ route('front.myinfo') }}"><span>나의정보</span></a></div>
            <div class="account-item">
              <a href="javascript:void(0)" onclick="document.getElementById('logout-form-mo').submit();">
                <span>로그아웃</span>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                >
                  <path
                    d="M20.7382 12.3052C20.8192 12.1102 20.8192 11.8892 20.7382 11.6932C20.7002 11.6032 20.6442 11.5232 20.5782 11.4532C20.5722 11.4472 20.5712 11.4392 20.5652 11.4332L17.5652 8.43322C17.2522 8.12122 16.7472 8.12122 16.4342 8.43322C16.1212 8.74622 16.1212 9.25221 16.4342 9.56521L18.0682 11.1992H12.0002C11.5592 11.1992 11.2002 11.5572 11.2002 11.9992C11.2002 12.4402 11.5582 12.7992 12.0002 12.7992H18.0682L16.4342 14.4332C16.1212 14.7462 16.1212 15.2532 16.4342 15.5662C16.5902 15.7212 16.7942 15.7992 16.9992 15.7992C17.2042 15.7992 17.4082 15.7212 17.5642 15.5662L20.5642 12.5662C20.5702 12.5602 20.5712 12.5522 20.5772 12.5462C20.6442 12.4762 20.7002 12.3962 20.7382 12.3052Z"
                    fill="#4A4A4A"
                  />
                  <path
                    d="M16.6642 17.4682C15.3602 18.5842 13.7042 19.1992 12.0002 19.1992C8.03018 19.1992 4.80017 15.9702 4.80017 11.9992C4.80017 8.02924 8.03018 4.79922 12.0002 4.79922C13.5602 4.79922 15.0502 5.30022 16.3102 6.24722C16.6632 6.51422 17.1652 6.44223 17.4302 6.08923C17.6962 5.73623 17.6242 5.23524 17.2712 4.96924C15.7322 3.81124 13.9102 3.19922 12.0002 3.19922C7.14718 3.19922 3.2002 7.14624 3.2002 11.9992C3.2002 16.8522 7.14718 20.7992 12.0002 20.7992C14.0852 20.7992 16.1112 20.0482 17.7052 18.6832C18.0402 18.3962 18.0802 17.8912 17.7922 17.5552C17.5052 17.2202 17.0002 17.1812 16.6642 17.4682Z"
                    fill="#4A4A4A"
                  />
                </svg>
              </a>
              <form id="logout-form-mo" action="{{ route('front.logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          @endif
          <!-- close button -->
          <button class="btn-close">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="32"
              height="32"
              viewBox="0 0 32 32"
              fill="none"
            >
              <path
                d="M5 27L27 5"
                stroke="#333333"
                stroke-width="2"
                stroke-miterlimit="10"
                stroke-linecap="round"
              />
              <path
                d="M5 5L27 27"
                stroke="#333333"
                stroke-width="2"
                stroke-miterlimit="10"
                stroke-linecap="round"
              />
            </svg>
          </button>
        </div>
        <nav class="nav-mo">
          <div class="nav-item">
            <div class="nav-item-head">하늘누리</div>
            <div class="nav-item-body">
              <a href="{{ route('front.introdu.greeting') }}" class="body-item">인사말</a>
              <a href="{{ route('front.introdu.hnstory') }}" class="body-item">하늘누리 이야기</a>
              <a href="{{ route('front.introdu.perarti') }}" class="body-item">재단/허가 현황</a>
              <a href="{{ route('front.introdu.way') }}" class="body-item">오시는 길</a>
            </div>
          </div>
          <div class="nav-item">
            <div class="nav-item-head">시설안내</div>
            <div class="nav-item-body">
              <a href="{{ route('front.facil.bongan') }}" class="body-item">봉안당(하늘누리관)</a>
              <a href="{{ route('front.facil.naburial') }}" class="body-item">수목장(자연장)</a>
              <a href="{{ route('front.facil.aditinal') }}" class="body-item">부대시설</a>
              <a href="{{ route('front.facil.surround') }}" class="body-item">주변 둘러보기</a>
            </div>
          </div>
          <div class="nav-item">
            <div class="nav-item-head">분양안내</div>
            <div class="nav-item-body">
              <a href="{{ route('front.distriinfo.distriproce') }}" class="body-item">분양절차</a>
              <a href="{{ route('front.distriinfo.distriprice') }}" class="body-item">분양가격</a>
              <a href="{{ route('front.distriinfo.applibenefit') }}" class="body-item">사전청약 혜택</a>
            </div>
          </div>
          <div class="nav-item">
            <div class="nav-item-head">사이버 추모관</div>
            <div class="nav-item-body">
              <a href="{{ route('front.memorial.deadsearch') }}" class="body-item">고인 검색</a>
              <a href="{{ route('front.memorial.letterlist') }}" class="body-item">하늘편지</a>
            </div>
          </div>
          <div class="nav-item">
            <div class="nav-item-head">고객센터</div>
            <div class="nav-item-body">
              <a href="{{ route('front.notice.index') }}" class="body-item">공지사항</a>
              <a href="{{ route('front.customer.faq') }}" class="body-item">자주묻는 질문</a>
              <a href="{{ route('front.customer.councel.index') }}" class="body-item">1:1 상담</a>
              <a href="{{ route('front.customer.councel.index') }}" class="body-item">나의상담</a>
              <a href="{{ route('front.customer.referen.index') }}" class="body-item">자료실</a>
            </div>
          </div>
          <div class="nav-item">
            <div class="nav-item-head">
              <a href="{{ route('front.service_terms') }}">서비스 이용약관</a>
            </div>
          </div>
          <div class="nav-item">
            <div class="nav-item-head">
              <a href="{{ route('front.personal_terms') }}">개인정보 처리방침</a>
            </div>
          </div>
        </nav>
      </div>
    </div>
    <div class="wrap-pc">
      <div class="wrap-header-account">
        <a href="{{ route('front.index') }}" class="tit1"><h1>하늘누리 추모공원</h1></a>
        <div class="wrap-account">
          @if(auth()->guard('member')->check())
            <a href="{{ route('front.myinfo') }}" class="item">정보수정</a>
            <a href="javascript:void(0)" onclick="document.getElementById('logout-form-pc').submit();" class="item">로그아웃</a>
            <form id="logout-form-pc" action="{{ route('front.logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          @else
            <a href="{{ route('front.join01') }}" class="item">회원가입</a>
            <a href="{{ route('front.login') }}" class="item">로그인</a>
          @endif
        </div>
      </div>
      <nav class="lnb">
        <a href="{{ route('front.introdu.greeting') }}" class="item">하늘누리소개</a>
        <a href="{{ route('front.facil.bongan') }}" class="item">시설안내</a>
        <a href="{{ route('front.distriinfo.distriproce') }}" class="item">분양안내</a>
        <a href="{{ route('front.memorial.deadsearch') }}" class="item">사이버추모관</a>
        <a href="{{ route('front.notice.index') }}" class="item">고객센터</a>
      </nav>
    </div>
    <!-- ToDo: pc메뉴(.wrap-pc) hover시 .active 추가 -->
    <nav class="nav-pc">
      <div class="nav-pc-item item-word1">
        <a href="{{ route('front.introdu.greeting') }}" class="item">인사말</a>
        <a href="{{ route('front.introdu.hnstory') }}" class="item">하늘누리 이야기</a>
        <a href="{{ route('front.introdu.perarti') }}" class="item">재단/허가 현황</a>
        <a href="{{ route('front.introdu.way') }}" class="item">오시는 길</a>
      </div>
      <div class="nav-pc-item item-word2">
        <a href="{{ route('front.facil.bongan') }}" class="item">봉안당(하늘누리관)</a>
        <a href="{{ route('front.facil.naburial') }}" class="item">수목장(자연장)</a>
        <a href="{{ route('front.facil.aditinal') }}" class="item">부대시설</a>
        <a href="{{ route('front.facil.surround') }}" class="item">주변 둘러보기</a>
      </div>
      <div class="nav-pc-item item-word3">
        <a href="{{ route('front.distriinfo.distriproce') }}" class="item">분양절차</a>
        <a href="{{ route('front.distriinfo.distriprice') }}" class="item">분양가격</a>
        <a href="{{ route('front.distriinfo.applibenefit') }}" class="item">사전청약 혜택</a>
      </div>
      <div class="nav-pc-item item-word4">
        <a href="{{ route('front.memorial.deadsearch') }}" class="item">고인 검색</a>
        <a href="{{ route('front.memorial.letterlist') }}" class="item">하늘편지</a>
      </div>
      <div class="nav-pc-item item-word5">
        <a href="{{ route('front.notice.index') }}" class="item">공지사항</a>
        <a href="{{ route('front.customer.faq') }}" class="item">자주묻는 질문</a>
        <a href="{{ route('front.customer.councel.index') }}" class="item">1:1 상담</a>
        <a href="{{ route('front.customer.referen.index') }}" class="item">자료실</a>
      </div>
    </nav>
  </div>
</header>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const btnMenu = document.querySelector('.btn-menu');
    const btnClose = document.querySelector('.btn-close');
    const wrapMenuMo = document.querySelector('.wrap-menu-mo');

    if (btnMenu && wrapMenuMo) {
      btnMenu.addEventListener('click', function () {
        wrapMenuMo.classList.add('active');
      });
    }
    if (btnClose && wrapMenuMo) {
      btnClose.addEventListener('click', function () {
        wrapMenuMo.classList.remove('active');
      });
    }

    (function () {
      const header = document.querySelector("header.header");
      const wrapPc = document.querySelector(".wrap-pc");
      const navPc = document.querySelector(".nav-pc");

      if (!header || !wrapPc || !navPc) return;

      function addActive() {
        header.classList.add("active");
        navPc.classList.add("active");
      }

      function removeActive() {
        header.classList.remove("active");
        navPc.classList.remove("active");
      }

      wrapPc.addEventListener("mouseenter", addActive);

      wrapPc.addEventListener("mouseleave", function (e) {
        if (e.relatedTarget && navPc.contains(e.relatedTarget)) return;
        removeActive();
      });

      navPc.addEventListener("mouseleave", function (e) {
        if (e.relatedTarget && wrapPc.contains(e.relatedTarget)) return;
        removeActive();
      });
    })();
  });
</script>
