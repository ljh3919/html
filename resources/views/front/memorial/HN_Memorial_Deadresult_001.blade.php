@extends('front.layouts.layout')

@section('title', '사이버추모관 - 고인 검색 결과')

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
      <a href="#" class="item">사이버 추모관</a>
      <a href="#" class="item">고인검색</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">고인검색</h2>
      <div class="tit2-sub">“마음으로 부르는 이름, 다시 만나는 그곳”</div>
      <div class="desc">
        하늘누리 사이버 추모관에 모셔진 고인을 성함으로 검색하실 수
        있습니다.
      </div>
    </div>
    <div class="wrap-btn">
      <button type="button" onclick="location.href='{{ route('front.memorial.letterregi', ['dead_name' => $name ?? '']) }}'" class="btn h56 full">
        하늘편지 쓰러가기
      </button>
    </div>
    <form id="deadSearchForm" action="{{ route('front.memorial.deadresult') }}" method="GET" class="form-box search wide">
      <div class="wrap-search-top">
        <div class="tit-deceased-search">고인검색</div>
        <div class="wrap-search-form">
          <span class="search-text">故</span>
          <div class="wrap-search">
            <div class="search-group">
              <input
                type="text"
                name="name"
                id="deceasedName"
                class="search-input"
                placeholder="고인의 이름을 입력하세요"
                value="{{ $name }}"
              />
              <button type="submit" class="search-btn">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                >
                  <path
                    d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                    stroke="#4A4A4A"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M21.0004 20.9984L16.6504 16.6484"
                    stroke="#4A4A4A"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="wrap-btn">
        <button type="submit" class="btn primary h56 full">
          <span>검색</span>
        </button>
      </div>
    </form>
    <div class="result-list">
      <div class="result-top">
        <div class="label">고인성함</div>
        <div class="date">기일</div>
      </div>
      <div class="result-body">
        @forelse($deads as $dead)
        <div class="result-item">
          <div class="item-top">
            <div class="label">故 {{ $dead->name }}</div>
            <div class="date">{{ $dead->death_date ? $dead->death_date->format('Y-m-d') : '-' }}</div>
            <svg
              class="icon"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
            >
              <path
                d="M11.5 16L4.5 9"
                stroke="#161616"
                stroke-width="1.5"
                stroke-miterlimit="10"
                stroke-linecap="round"
              />
              <path
                d="M18.5 9L11.5 16"
                stroke="#161616"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </div>
          <div class="item-desc">
            {{ $dead->location_hall }} {{ $dead->location_area }} {{ $dead->location_row ? $dead->location_row . '열' : '' }} {{ $dead->location_num }}
          </div>
        </div>
        @empty
        <div class="result-empty" style="display: flex; flex-direction: column; align-items: center; padding: 40px 0;">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="48"
            height="48"
            viewBox="0 0 48 48"
            fill="none"
          >
            <path
              d="M23.9958 43.9907C35.0392 43.9907 43.9917 35.0383 43.9917 23.9949C43.9917 12.9515 35.0392 3.99902 23.9958 3.99902C12.9524 3.99902 4 12.9515 4 23.9949C4 35.0383 12.9524 43.9907 23.9958 43.9907Z"
              stroke="#4A4A4A"
              stroke-width="2"
              stroke-miterlimit="10"
            />
            <path
              d="M23.9931 33.6929C23.1431 33.6929 22.4531 34.3829 22.4531 35.2329C22.4531 36.0829 23.1431 36.7729 23.9931 36.7729C24.8431 36.7729 25.5331 36.0829 25.5331 35.2329C25.5331 34.3829 24.8431 33.6929 23.9931 33.6929Z"
              fill="#4A4A4A"
            />
            <path
              d="M26.2038 12.4774C26.2038 11.2576 25.224 10.2778 24.0042 10.2778C22.7845 10.2778 21.8047 11.2576 21.8047 12.4774C21.8047 12.5274 21.8147 12.5674 21.8147 12.6173H21.8047L22.9045 30.2337H22.9145C22.9445 30.8136 23.4144 31.2735 24.0042 31.2735C24.5941 31.2735 25.064 30.8136 25.094 30.2337H25.104L26.2038 12.6173H26.1938C26.1938 12.6173 26.2038 12.5274 26.2038 12.4774Z"
              fill="#4A4A4A"
            />
          </svg>
          <div class="empty-text" style="margin-top: 16px; color: #4A4A4A;">검색결과가 없습니다.</div>
        </div>
        @endforelse
      </div>
      @if($deads->hasMorePages())
      <div class="wrap-btn-more">
        <button type="button" onclick="location.href='{{ $deads->nextPageUrl() }}&name={{ $name }}'" class="btn primary h56">
          <span>더보기</span>
        </button>
      </div>
      @endif
    </div>
  </div>
</main>

<script>
  // 고인검색 결과 아코디언 및 유효성 검사
  (function () {
    // 유효성 검사
    const form = document.getElementById('deadSearchForm');
    const input = document.getElementById('deceasedName');

    if (form && input) {
      form.addEventListener('submit', function(e) {
        if (!input.value.trim()) {
          e.preventDefault();
          alert('고인명을 입력해 주세요.');
          input.focus();
        }
      });
    }

    // 아코디언 (단일 열림 제어)
    const items = document.querySelectorAll(".result-body .result-item");
    if (!items.length) return;

    items.forEach(function (item) {
      item.addEventListener("click", function () {
        const isActive = item.classList.contains("active");

        // 모든 아이템의 active를 지움
        items.forEach(function (i) {
          i.classList.remove("active");
        });

        // 클릭한 아이템이 이전에 비활성 상태였다면 활성화
        if (!isActive) {
          item.classList.add("active");
        }
      });
    });
  })();
</script>
@endsection
