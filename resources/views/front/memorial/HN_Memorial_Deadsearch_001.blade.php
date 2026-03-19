@extends('front.layouts.layout')

@section('title', '사이버추모관 - 고인 검색')

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
    <form id="deadSearchForm" action="{{ route('front.memorial.deadresult') }}" method="GET" class="form-box search">
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
                value="{{ request('name') }}"
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
  </div>
</main>

<script>
  (function() {
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
  })();
</script>
@endsection
