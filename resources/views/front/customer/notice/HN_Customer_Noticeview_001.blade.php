@extends('front.layouts.layout')

@section('title', '공지사항상세')

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
      <div class="notice-view">
        <div class="wrap-notice-tit">
          <div class="tit">{{ $notice->title }}</div>
          <div class="date">{{ $notice->created_at->format('Y-m-d') }}</div>
        </div>
        <div class="wrap-notice-content">
          {!! $notice->content !!}
        </div>
        
        @if($notice->attachments && $notice->attachments->count() > 0)
        <!-- 파일명이 필요한 경우 -->
        <div class="wrap-notice-attached">
          <div class="attached-tit-text">첨부파일</div>
          
          @foreach($notice->attachments as $attachment)
          <a href="{{ route('admin.notice.download', $attachment->id) }}" class="wrap-attach" style="text-decoration:none;">
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
          </a>
          @endforeach
        </div>
        @endif
        
      </div>
      <div class="wrap-btn">
        <button type="button" class="btn primary h56" onclick="location.href='{{ route('front.notice.index') }}'">
          <span>목록</span>
        </button>
      </div>
    </div>
  </div>
</main>
@endsection
