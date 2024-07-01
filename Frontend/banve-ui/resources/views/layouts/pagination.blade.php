<!-- custom.blade.php -->

<style>


.pagination span,
.pagination a {
    font-size: 1.2em;
    padding: 0px 10px;
    text-decoration: none;
    color: #333;
}
</style>
@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        {{-- <ul class="pagination">

            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">Previous</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a></li>
            @endif


            @foreach ($elements as $element)

                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>
            @endif
        </ul>  --}}

        <div class="pagination">
            @if ($paginator->onFirstPage())
                <span></span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a>
            @endif

            <span>{{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}</span>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a>
            @else
                <span></span>
            @endif
        </div>
    </nav>
@endif
