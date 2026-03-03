<header class="header">
  <div class="wrap-header">
    <div class="wrap-mo">
      <a href="{{ route('frontend.index') ?? '/' }}" class="tit1"><h1>하늘누리 추모공원</h1></a>
      <button class="btn-menu">
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
    </div>
    <div class="wrap-pc">
      <div class="wrap-header-account">
        <a href="{{ route('frontend.index') ?? '/' }}" class="tit1"><h1>하늘누리 추모공원</h1></a>
        <div class="wrap-account">
          @if(auth()->guard('member')->check())
            <a href="{{ route('frontend.myinfo') ?? '#' }}" class="item">정보수정</a>
            <a href="javascript:void(0)" onclick="document.getElementById('logout-form').submit();" class="item">로그아웃</a>
            <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          @else
            <a href="{{ route('frontend.join01') ?? '#' }}" class="item">회원가입</a>
            <a href="{{ route('frontend.login') ?? '#' }}" class="item">로그인</a>
          @endif
        </div>
      </div>
      <nav class="lnb">
        <a href="#" class="item">하늘누리소개</a>
        <a href="#" class="item">시설안내</a>
        <a href="#" class="item">분양안내</a>
        <a href="#" class="item">사이버추모관</a>
        <a href="#" class="item">고객센터</a>
      </nav>
    </div>
  </div>
</header>
