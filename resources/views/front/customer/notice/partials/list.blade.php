@foreach($notices as $notice)
<li class="item">
  <a href="{{ route('front.notice.show', $notice->id) }}" class="link">
    <div class="num">{{ $notices->total() - ($notices->currentPage() - 1) * $notices->perPage() - $loop->index }}</div>
    <div class="list-cont">
      <div class="date">{{ $notice->created_at ? $notice->created_at->format('Y-m-d') : '' }}</div>
      <div class="tit">{{ Str::limit($notice->title, 50) }}</div>
    </div>
    @if($notice->attachments && $notice->attachments->count() > 0)
      <div class="icon-file"></div>
    @endif
  </a>
</li>
@endforeach
