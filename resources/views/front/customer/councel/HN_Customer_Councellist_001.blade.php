@extends('front.layouts.layout')

@section('title', '나의 상담')

@section('content')
<main>
  <div class="main counsel">
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
      <a href="{{ route('front.customer.councel.index') }}" class="item">1:1 상담</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">나의 상담</h2>
      <div class="tit2-sub">
        “마음을 다해 듣고, 정성을 다해 답하겠습니다.”
      </div>
      <div class="desc">
        말로 다 전하기 어려운 유족분들의 고민과 궁금증을 귀 기울여
        듣겠습니다. 하늘누리가 가족의 마음으로 함께 고민하고 답변해
        드립니다.
      </div>
    </div>
  </div>

  <div class="main">
    <div class="wrap-notice-lists">
      <div class="wrap-counsel-top">
        <button type="button" class="btn h56 full" onclick="location.href='{{ route('front.customer.councel.create') }}'">1:1 상담가기</button>
        <div class="wrap-search">
          <form action="{{ route('front.customer.councel.index') }}" method="GET">
            <div class="search-group">
              <input type="text" name="search_keyword" class="search-input" placeholder="검색어를 입력하세요" value="{{ request('search_keyword') }}" />
              <button type="submit" class="search-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#4A4A4A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M21.0004 20.9984L16.6504 16.6484" stroke="#4A4A4A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </button>
            </div>
          </form>
        </div>
      </div>
      
      <ul class="notice-lists" id="counsel-list-container">
        @include('front.customer.councel.partials.list', ['inquiries' => $inquiries])
      </ul>
      
      @if($inquiries->hasMorePages())
      <div class="wrap-btn mt-10" id="load-more-container" style="display: flex; justify-content: center; margin-top: 40px;">
        <button type="button" class="btn primary h56" id="load-more-btn" data-page="2" data-last-page="{{ $inquiries->lastPage() }}" style="width: 200px;">
          <span>더보기</span>
        </button>
      </div>
      @endif

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('load-more-btn');
    const listContainer = document.getElementById('counsel-list-container');
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

        fetch("{{ route('front.customer.councel.index') }}?" + searchParams.toString(), {
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
          console.error('Error fetching more inquiries:', error);
          btn.disabled = false;
          btn.querySelector('span').textContent = '더보기 (오류 발생)';
        });
      });
    }
  });
</script>
@endpush
      
    </div>
  </div>
</main>
@endsection
