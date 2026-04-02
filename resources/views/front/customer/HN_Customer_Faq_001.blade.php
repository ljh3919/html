@extends('front.layouts.layout')

@section('title', '고객센터 - 자주 묻는 질문(FAQ)')

@section('content')
<main>
  <div class="main">
    <div class="breadcrumb">
      <a href="{{ route('front.index') ?? '#' }}" class="item">
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
      <a href="{{ route('front.notice.index') ?? '#' }}" class="item">고객센터</a>
      <a href="{{ route('front.customer.faq') ?? '#' }}" class="item">자주 묻는 질문</a>
    </div>
    <div class="wrap-tit">
      <h2 class="tit2">자주 묻는 질문</h2>
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
    <div class="wrap-notice-faq">
      <!-- FAQ Item 1 -->
      <div class="item">
        <div class="item-content head">
          <div class="wrap-item-content">
            <div class="item-pre">Q</div>
            <div class="item-text">
              <div class="tit">
                하늘누리 추모공원의 운영시간은 어떻게 되나요?
              </div>
            </div>
          </div>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
          >
            <path
              d="M11.5 16L4.5 9"
              stroke="#161616"
              stroke-width="1.5"
              stroke-miterlimit="10"
              stroke-linecap="round"
            />
            <path
              d="M18.5 9L11.5 16"
              stroke="#161616"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>
        <div class="item-content body">
          <div class="wrap-item-content">
            <div class="item-pre">A</div>
            <div class="item-text">
              <div class="tit">하늘누리 추모공원 운영 시간</div>
              <div class="desc">
                연중무휴 오전 08:00 ~ 오후 18:00하늘누리 추모공원은
                <strong
                  >“고인께서는 평안히 영면하실 수 있는 성스러운
                  안식처가”</strong
                >
                되겠습니다.
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- FAQ Item 2 -->
      <div class="item">
        <div class="item-content head">
          <div class="wrap-item-content">
            <div class="item-pre">Q</div>
            <div class="item-text">
              <div class="tit">
                봉안당(납골당) 계약 시 필요한 서류는 무엇인가요?
              </div>
            </div>
          </div>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
          >
            <path
              d="M11.5 16L4.5 9"
              stroke="#161616"
              stroke-width="1.5"
              stroke-miterlimit="10"
              stroke-linecap="round"
            />
            <path
              d="M18.5 9L11.5 16"
              stroke="#161616"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>
        <div class="item-content body">
          <div class="wrap-item-content">
            <div class="item-pre">A</div>
            <div class="item-text">
              <div class="tit">계약 시 필요 서류 안내</div>
              <div class="desc">
                계약자 본인의 신분증, 가족관계증명서명(고인과의 관계 확인 용도), 주민등록등본 1통이 필요합니다. 상세 내용은 고객센터로 문의 바랍니다.
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- FAQ Item 3 -->
      <div class="item">
        <div class="item-content head">
          <div class="wrap-item-content">
            <div class="item-pre">Q</div>
            <div class="item-text">
              <div class="tit">
                사전 청약(예약) 제도가 있나요?
              </div>
            </div>
          </div>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
          >
            <path
              d="M11.5 16L4.5 9"
              stroke="#161616"
              stroke-width="1.5"
              stroke-miterlimit="10"
              stroke-linecap="round"
            />
            <path
              d="M18.5 9L11.5 16"
              stroke="#161616"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>
        <div class="item-content body">
          <div class="wrap-item-content">
            <div class="item-pre">A</div>
            <div class="item-text">
              <div class="tit">사전 청약 제도 운영 안내</div>
              <div class="desc">
                네, 하늘누리 추모공원은 원하시는 자리를 미리 확보하실 수 있도록 사전 청약제도를 운영하고 있습니다. 자세한 혜택 및 절차는 [분양안내 - 사전청약 혜택] 메뉴를 참고해 주시기 바랍니다.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.wrap-notice-faq .item-content.head').forEach(function (head) {
      head.addEventListener('click', function () {
        var item = this.closest('.item');
        item.classList.toggle('is-open');
      });
    });
  });
</script>
@endpush
