@extends('front.layouts.layout')

@section('title', '자료실')

@section('content')
<main>
  <div class="main">
    <div class="breadcrumb">
      <a href="#" class="item">
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
      <a href="{{ route('front.notice.index') }}" class="item">고객센터</a>
      <a href="{{ route('front.customer.referen.index') }}" class="item">자료실</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">자료실</h2>
      <div class="tit2-sub">
        “하늘누리 이용을 돕는 투명하고 정확한 기록들”
      </div>
      <div class="desc">
        이곳저곳 찾아보시는 번거로움을 덜어드리기 위해 관련 서식과
        가이드북을 한곳에 정리했습니다. 편안하게 내려 받아 확인해 보세요.
      </div>
    </div>
  </div>
  <div class="main">
    <div class="wrap-notice-lists">
      
      <div class="wrap-search">
        <form action="{{ route('front.customer.referen.index') }}" method="GET">
          <div class="search-group">
            <input
              type="text"
              name="search_keyword"
              class="search-input"
              placeholder="검색어를 입력하세요"
              value="{{ $searchKeyword ?? '' }}"
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
        </form>
      </div>

      @if($references->isEmpty())
      <div class="result-empty">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="48"
          height="48"
          viewBox="0 0 48 48"
          fill="none"
        >
          <path
            d="M23.9958 43.9909C35.0392 43.9909 43.9917 35.0385 43.9917 23.9951C43.9917 12.9517 35.0392 3.99927 23.9958 3.99927C12.9524 3.99927 4 12.9517 4 23.9951C4 35.0385 12.9524 43.9909 23.9958 43.9909Z"
            stroke="#4A4A4A"
            stroke-width="2"
            stroke-miterlimit="10"
          />
          <path
            d="M23.9951 33.6929C23.1451 33.6929 22.4551 34.3829 22.4551 35.2329C22.4551 36.0829 23.1451 36.7729 23.9951 36.7729C24.8451 36.7729 25.5351 36.0829 25.5351 35.2329C25.5351 34.3829 24.8451 33.6929 23.9951 33.6929Z"
            fill="#4A4A4A"
          />
          <path
            d="M26.2038 12.4774C26.2038 11.2576 25.224 10.2778 24.0042 10.2778C22.7845 10.2778 21.8047 11.2576 21.8047 12.4774C21.8047 12.5274 21.8147 12.5674 21.8147 12.6173H21.8047L22.9045 30.2337H22.9145C22.9445 30.8136 23.4144 31.2735 24.0042 31.2735C24.5941 31.2735 25.064 30.8136 25.094 30.2337H25.104L26.2038 12.6173H26.1938C26.1938 12.6173 26.2038 12.5274 26.2038 12.4774Z"
            fill="#4A4A4A"
          />
        </svg>
        <div class="empty-text">@if(request('search_keyword')) 검색결과가 없습니다. @else 등록된 자료가 없습니다. @endif</div>
      </div>
      @else
      <ul class="notice-lists" id="reference-list">
        @include('front.customer.referen.partials.list', ['references' => $references])
      </ul>
      
      @if($references->hasMorePages())
      <div class="wrap-btn">
        <button type="button" class="btn primary h56" id="btn-more" data-page="{{ $references->currentPage() + 1 }}">
          <span>더보기</span>
        </button>
      </div>
      @endif
      @endif

    </div>
  </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnMore = document.getElementById('btn-more');
    const listContainer = document.getElementById('reference-list');

    if (btnMore) {
        btnMore.addEventListener('click', function() {
            const nextPage = this.getAttribute('data-page');
            const url = new URL(window.location.href);
            url.searchParams.set('page', nextPage);

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === '') {
                    btnMore.style.display = 'none';
                } else {
                    listContainer.insertAdjacentHTML('beforeend', data);
                    this.setAttribute('data-page', parseInt(nextPage) + 1);
                }
            })
            .catch(error => console.error('Error loading more:', error));
        });
    }
});
</script>
@endsection
