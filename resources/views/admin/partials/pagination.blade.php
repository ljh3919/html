@if ($paginator->hasPages())
    <div class="wrap-pager">
        {{-- First Page Link --}}
        <a href="{{ $paginator->url(1) }}" class="arrow first {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                <path d="M15.5 8.75L9.25 15L15.5 21.25" stroke="#2D2D2D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M19.5 8.75L13.25 15L19.5 21.25" stroke="#2D2D2D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>

        {{-- Previous Page Link --}}
        <a href="{{ $paginator->previousPageUrl() }}" class="arrow before {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                <path d="M17.5 8.75L11.25 15L17.5 21.25" stroke="#2D2D2D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>

        {{-- Pagination Elements --}}
        @php
            $start = max(1, $paginator->currentPage() - 2);
            $end = min($paginator->lastPage(), $paginator->currentPage() + 2);
        @endphp

        @for ($i = $start; $i <= $end; $i++)
            <a href="{{ $paginator->url($i) }}" class="num {{ $paginator->currentPage() == $i ? 'active' : '' }}">
                {{ $i }}
            </a>
        @endfor

        {{-- Next Page Link --}}
        <a href="{{ $paginator->nextPageUrl() }}" class="arrow next {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                <path d="M12.5 8.75L18.75 15L12.5 21.25" stroke="#2D2D2D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>

        {{-- Last Page Link --}}
        <a href="{{ $paginator->url($paginator->lastPage()) }}" class="arrow last {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                <path d="M10.5 8.75L16.75 15L10.5 21.25" stroke="#2D2D2D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14.5 8.75L20.75 15L14.5 21.25" stroke="#2D2D2D" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>
@endif
