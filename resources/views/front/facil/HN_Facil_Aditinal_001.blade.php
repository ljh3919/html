@extends('front.layouts.layout')

@section('title', '시설안내 - 부대시설')

@section('content')
<main>
  <div class="main">
    <div class="breadcrumb">
      <a href="{{ route('front.index') }}" class="item">홈</a>
      <a href="#" class="item">시설안내</a>
      <a href="#" class="item">부대시설</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">부대시설</h2>
      <div class="tit2-sub">자세한 시설 정보는 준비 중입니다.</div>
    </div>
  </div>
</main>
@endsection
