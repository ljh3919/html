@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="font-weight-bold">나의 상담</h2>
        <p class="text-muted">"마음을 다해 듣고, 정성을 다해 답하겠습니다."<br>말로 다 전하기 어려운 유족분들의 고민과 궁금증을 귀 기울여 듣겠습니다.</p>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('HN_Customer_Councellist_001') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search_keyword" class="form-control" placeholder="검색어를 입력하세요" value="{{ $searchKeyword }}">
                    <div class="input-group-append">
                        <button class="btn btn-dark" type="submit">검색</button>
                    </div>
                </div>
            </form>

            <table class="table table-hover text-center">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 10%">No</th>
                        <th>제목</th>
                        <th style="width: 20%">등록일</th>
                        <th style="width: 15%">상태</th>
                    </tr>
                </thead>
                <tbody id="inquiry-list">
                    @forelse($inquiries as $inquiry)
                    <tr onclick="location.href='{{ route('HN_Customer_Councelview_001', $inquiry->id) }}'" style="cursor: pointer;">
                        <td>{{ $inquiry->id }}</td>
                        <td class="text-left">{{ $inquiry->title }}</td>
                        <td>{{ $inquiry->created_at->format('Y-m-d') }}</td>
                        <td>
                            @if($inquiry->status === '답변완료')
                                <span class="badge badge-success">답변완료</span>
                            @else
                                <span class="badge badge-secondary">미답변</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-5 text-muted">상담 내역이 없습니다.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            @if($inquiries->hasMorePages())
            <div class="text-center mt-4">
                <button id="load-more" class="btn btn-outline-dark px-5">더보기 ......</button>
            </div>
            @endif

            <div class="text-right mt-4">
                <a href="{{ route('HN_Customer_Councelregi_001') }}" class="btn btn-primary px-4">1:1 상담하기</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // 간단한 더보기 기능 예시 (실제 구현 시 AJAX 권장되나 설계서 상에는 목록 하단 노출로 명시)
    // 여기서는 기본 라라벨 페이징을 사용하되 UI상 더보기 버튼으로 유도시 로직 필요
</script>
@endpush
