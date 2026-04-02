@foreach($references as $reference)
<li class="item">
  <a href="{{ route('front.customer.referen.show', $reference->id) }}" class="link">
    <div class="num">{{ $references->total() - ($references->currentPage() - 1) * $references->perPage() - $loop->index }}</div>
    <div class="list-cont">
      <div class="date">{{ $reference->created_at->format('Y-m-d') }}</div>
      <div class="tit">{{ $reference->title }}</div>
    </div>
    @if($reference->attachments && $reference->attachments->count() > 0)
    <div class="icon-file">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path d="M13 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V9L13 2Z" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M13 2V9H20" stroke="#4A4A4A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
    @endif
  </a>
</li>
@endforeach
