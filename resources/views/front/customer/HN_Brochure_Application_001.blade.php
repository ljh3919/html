@extends('front.layouts.layout')

@section('title', '브로슈어 신청')

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
      <a href="#" class="item">브로슈어 신청</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">브로슈어 신청</h2>
      <div class="tit2-sub">
        사랑하는 이를 위한 가장 소중한 공간, 직접 만나보시기 전에 먼저
        마음으로 느껴보세요.<br />하늘누리의 모든 것을 담은 브로슈어를
        무료로 보내드립니다.
      </div>
    </div>
    <div class="wrap-login customer">
      <div class="login-cont myinfo">
        <form action="{{ route('front.brochure.store') }}" method="POST" class="form-login" id="brochureForm">
          @csrf
          <div class="wrap-form-item">
            <div class="form-tit">이름</div>
            <div class="form-desc">{{ auth()->guard('member')->user()->name }}</div>
            <input type="hidden" name="name" value="{{ auth()->guard('member')->user()->name }}">
          </div>
          <div class="wrap-form-item">
            <div class="form-tit form">E-Mail</div>
            <div class="form-desc">{{ auth()->guard('member')->user()->email }}</div>
            <input type="hidden" name="email" value="{{ auth()->guard('member')->user()->email }}">
          </div>
          <div class="wrap-btn">
            <button type="submit" class="btn primary h56 full">
              <span>브로슈어 신청</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
@endsection

@push('scripts')
<script>
  document.getElementById('brochureForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch(this.action, {
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": "{{ csrf_token() }}",
        "Accept": "application/json"
      },
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        commonModal.show("알림", data.message, function() {
          location.href = "{{ route('front.index') }}";
        });
      } else {
        commonModal.show("알림", data.message || "신청 처리 중 오류가 발생했습니다.");
      }
    })
    .catch(error => {
      console.error('Error:', error);
      commonModal.show("알림", "신청 처리 중 오류가 발생했습니다.");
    });
  });
</script>
@endpush
