@extends('front.layouts.layout')

@section('title', '공지사항')

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
      <a href="#" class="item">고객센터</a>
      <a href="{{ route('front.notice.index') }}" class="item">공지사항</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">공지사항</h2>
      <div class="tit2-sub">
        "하늘누리의 새로운 소식과 정성 어린 안내를 전합니다."
      </div>
      <div class="desc">
        유족분들의 소중한 걸음이 헛되지 않도록, 공원의 운영 일정과 주요
        안내 사항을 가장 정직하고 세심하게 전달해 드리겠습니다.
      </div>
    </div>
  </div>
  <div class="main">
    <div class="wrap-notice-lists">
      <form action="{{ route('front.notice.index') }}" method="GET">
        <div class="wrap-search">
          <div class="search-group">
            <input
              type="text"
              name="search"
              class="search-input"
              placeholder="검색어를 입력하세요"
              value="{{ request('search') }}"
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
      </form>

      @if($notices->isEmpty())
      <div class="wrap-empty">
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
        <div class="text-empty">@if(request('search')) 검색결과가 없습니다. @else 등록된 공지사항이 없습니다. @endif</div>
      </div>
      @else
      <ul class="notice-lists" id="notice-list-container">
        @include('front.customer.notice.partials.list', ['notices' => $notices])
      </ul>
      
      @if($notices->hasMorePages())
      <div class="wrap-btn mt-10" id="load-more-container" style="display: flex; justify-content: center; margin-top: 40px;">
        <button type="button" class="btn primary h56" id="load-more-btn" data-page="2" data-last-page="{{ $notices->lastPage() }}" style="width: 200px;">
          <span>더보기</span>
        </button>
      </div>
      @endif

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('load-more-btn');
    const listContainer = document.getElementById('notice-list-container');
    const loadMoreContainer = document.getElementById('load-more-container');
    
    if (loadMoreBtn) {
      loadMoreBtn.addEventListener('click', function() {
        const btn = this;
        const page = parseInt(btn.getAttribute('data-page'));
        const lastPage = parseInt(btn.getAttribute('data-last-page'));
        const searchParams = new URLSearchParams(window.location.search);
        
        searchParams.set('page', page);
        btn.disabled = true;
        btn.querySelector('span').textContent = '불러오는 중...';

        fetch("{{ route('front.notice.index') }}?" + searchParams.toString(), {
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(response => response.text())
        .then(html => {
          listContainer.insertAdjacentHTML('beforeend', html);
          
          if (page < lastPage) {
            btn.setAttribute('data-page', page + 1);
            btn.disabled = false;
            btn.querySelector('span').textContent = '더보기';
          } else {
            loadMoreContainer.remove();
          }
        })
        .catch(error => {
          console.error('Error fetching more notices:', error);
          btn.disabled = false;
          btn.querySelector('span').textContent = '더보기 (오류 발생)';
        });
      });
    }
  });
</script>
@endpush
      @endif
    </div>
  </div>
</main>
@endsection
