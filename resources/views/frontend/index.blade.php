@extends('frontend.layouts.layout')

@section('title', '하늘누리 추모공원')

@section('content')
<main>
  <div class="main">
    <div class="breadcrumb">
      <a href="{{ route('frontend.index') ?? '#' }}" class="item">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" style="width: 16px; height: 16px;">
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
      <!-- <a href="#" class="item">현재 페이지명 (동적으로 변경 처리 권장)</a> -->
    </div>
    
    <!-- 내용 (각 서브 페이지에서 이 부분을 덮어씌웁니다) -->
    <div class="wrap-tit">
      <h2 class="tit2">메인 페이지</h2>
      <div class="tit2-sub">
        하늘누리 추모공원에 오신것을 환영합니다.
      </div>
    </div>
  </div>
</main>
@endsection
