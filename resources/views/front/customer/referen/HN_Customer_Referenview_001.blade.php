@extends('front.layouts.layout')

@section('title', '자료실 - 상세보기')

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
      <div class="notice-view">
        <div class="wrap-notice-tit">
          <div class="tit">{{ $reference->title }}</div>
          <div class="date">{{ $reference->created_at->format('Y-m-d') }}</div>
        </div>
        <div class="wrap-notice-content">
          {!! nl2br(e($reference->content)) !!}
        </div>
        
        @if($reference->attachments && $reference->attachments->count() > 0)
        <div class="wrap-notice-attached">
          <div class="attached-tit-text">첨부파일</div>
          @foreach($reference->attachments as $attachment)
          <button type="button" class="wrap-attach" onclick="location.href='{{ Storage::url($attachment->file_path) }}'">
            <div class="attach-text">{{ $attachment->original_name }}</div>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="36"
              height="32"
              viewBox="0 0 36 32"
              fill="none"
            >
              <rect x="0.5" y="0.5" width="35" height="31" rx="1.5" fill="white" />
              <rect x="0.5" y="0.5" width="35" height="31" rx="1.5" stroke="#CCCCCC" />
              <path d="M11 23H25" stroke="#2D2D2D" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M13 15L18 20L23 15" stroke="#2D2D2D" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M18 20V9" stroke="#2D2D2D" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </button>
          @endforeach
        </div>
        @endif
      </div>
      <div class="wrap-btn">
        <button type="button" class="btn primary h56" onclick="location.href='{{ route('front.customer.referen.index') }}'">
          <span>목록</span>
        </button>
      </div>
    </div>
  </div>
</main>
@endsection
