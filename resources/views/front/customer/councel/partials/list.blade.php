@forelse($inquiries as $inquiry)
  <li class="item">
    <a href="{{ route('front.customer.councel.show', $inquiry->id) }}" class="link">
      <div class="num">{{ $inquiries->total() - ($inquiries->currentPage() - 1) * $inquiries->perPage() - $loop->index }}</div>
      <div class="list-cont">
        <div class="wrap-record-info">
          <div class="date">{{ $inquiry->created_at->format('Y-m-d') }}</div>
          <div class="name">{{ $inquiry->username }}</div>
        </div>
        <div class="tit">{{ $inquiry->title }}</div>
      </div>
      @if($inquiry->status === '답변완료')
        <div class="counsel-status done">답변완료</div>
      @else
        <div class="counsel-status">미답변</div>
      @endif
    </a>
  </li>
  @if($inquiry->reply)
  <li class="item reply">
    <a href="{{ route('front.customer.councel.show', $inquiry->id) }}" class="link">
      <div class="num"></div>
      <div class="list-cont">
        <div class="wrap-record-info">
          <div class="date">{{ $inquiry->reply->created_at->format('Y-m-d') }}</div>
          <div class="name">관리자</div>
        </div>
        <div class="tit">[Re] {{ $inquiry->reply->title }}</div>
      </div>
      <div class="counsel-status"></div>
    </a>
  </li>
  @endif
@empty
  <li class="item" style="justify-content: center; padding: 40px 0;">
    등록된 상담 내역이 없습니다.
  </li>
@endforelse
