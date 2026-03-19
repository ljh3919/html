@extends('front.layouts.layout')

@section('title', '사이버추모관 - 하늘편지')

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
      <a href="#" class="item">하늘편지</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">하늘편지</h2>
      <div class="tit2-sub">"닿지 못한 마음이 하늘에 닿는 곳"</div>
      <div class="desc">
        차마 다 전하지 못한 말들이 구름을 타고 그리운 이에게 전해집니다.
        당신의 진심을 담아 따뜻한 안부를 띄워주세요.
      </div>
    </div>
    <div class="wrap-btn">
      <button type="button" onclick="location.href='{{ route('front.memorial.letterregi') }}'" class="btn h56 full">하늘편지 쓰기</button>
    </div>
  </div>
  <div class="main">
    <div class="wrap-notice-lists">
      <form action="{{ route('front.memorial.letterlist') }}" method="GET" class="wrap-counsel-top letter">
        <input type="hidden" name="tab" value="{{ $tab }}">
        <div class="wrap-search">
          <div class="search-group">
            <input
              type="text"
              name="search"
              class="search-input"
              placeholder="검색어를 입력하세요"
              value="{{ $search }}"
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
        <div class="wrap-letter-count">
          @if($search)
            총 하늘편지 수 <strong>{{ number_format($totalCount) }}</strong>
          @else
            총 하늘편지 수 <strong>{{ number_format($allCount) }}</strong>
          @endif
        </div>
      </form>
      <ul class="wrap-tab">
        <li class="tab-item {{ $tab === 'all' ? 'active' : '' }}" onclick="location.href='{{ route('front.memorial.letterlist', ['tab' => 'all', 'search' => $search]) }}'">전체({{ number_format($allCount) }})</li>
        <li class="tab-item {{ $tab === 'my' ? 'active' : '' }}" onclick="location.href='{{ route('front.memorial.letterlist', ['tab' => 'my', 'search' => $search]) }}'">내가 쓴 하늘편지({{ number_format($myCount) }})</li>
      </ul>
      @if($letters->count() > 0)
      <ul class="notice-lists">
        @foreach($letters as $letter)
        @php
            $isOwn = auth()->guard('member')->check() && auth()->guard('member')->user()->username === $letter->username;
            $canView = ($letter->is_private !== 'Y') || $isOwn;
        @endphp
        <li class="item {{ ($letter->is_private === 'Y' && !$isOwn) ? 'secret' : '' }}">
          <a href="{{ $canView ? route('front.memorial.letterview', $letter->id) : 'javascript:void(0);' }}" 
             @if(!$canView) onclick="commonModal.show('알림', '비밀글입니다. 작성자 본인만 열람할 수 있습니다.'); return false;" @endif
             class="link">
            <div class="num">{{ $letters->total() - ($letters->currentPage() - 1) * $letters->perPage() - $loop->index }}</div>
            <div class="list-cont">
              <div class="wrap-record-info">
                <div class="date">{{ $letter->created_at->format('Y-m-d') }}</div>
                <div class="name">{{ $letter->author_description }}</div>
              </div>
              @if($canView)
              <div class="letter">
                {{ mb_strimwidth($letter->content, 0, 150, "...") }}
              </div>
              @endif
            </div>
          </a>
        </li>
        @endforeach
      </ul>
      @else
      <div class="result-empty">
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
        <div class="empty-text">작성된 하늘편지가 없습니다.</div>
      </div>
      @endif
      @if($letters->hasMorePages())
      <div class="wrap-btn">
        <button type="button" onclick="location.href='{{ $letters->nextPageUrl() }}&tab={{ $tab }}&search={{ $search }}'" class="btn primary h56">
          <span>더보기</span>
        </button>
      </div>
      @endif
    </div>
  </div>
</main>
@endsection
