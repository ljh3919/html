@extends('front.layouts.layout')

@section('title', '분양안내 - 분양가격')

@section('content')
<main>
  <div class="main">
    <div class="breadcrumb">
      <a href="{{ route('front.index') }}" class="item">홈</a>
      <a href="#" class="item">분양안내</a>
      <a href="#" class="item">분양가격</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">분양가격</h2>
      <div class="tit2-sub">자세한 분양가격 안내는 준비 중입니다.</div>
    </div>
  </div>
</main>
@endsection
