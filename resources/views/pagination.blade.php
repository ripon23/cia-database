@if ($paginator->hasPages())
    <div class="d-flex justify-content-end p-3">
        <span class="data_count px-5 d-flex align-items-center">{{ $paginator->lastPage() * 20 }} people in the list </span>
        @if ($paginator->onFirstPage())
            <a class="btn btn-next-prev disabled" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa-solid fa-arrow-left"></i></a>
        @else
            <a class="btn btn-next-prev" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa-solid fa-arrow-left"></i></a>
        @endif 
        
        <span class="data_count px-2 d-flex align-items-center">{{ ($paginator->currentPage() * 20)  - 20 == 0?1: ($paginator->currentPage() * 20)  - 19}} - {{ $paginator->currentPage() * 20 }} of {{ $paginator->lastPage() }}</span>
        
        @if ($paginator->hasMorePages())
            <a class="btn btn-next-prev" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa-solid fa-arrow-right"></i></a>
        @else
            <a class="btn btn-next-prev disabled" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa-solid fa-arrow-right"></i></a>
        @endif

    </div>

    <!-- <ul class="pager">
       
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>← Previous</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a></li>
        @endif


      
        @foreach ($elements as $element)
           
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif


           
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active my-active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach


        
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a></li>
        @else
            <li class="disabled"><span>Next →</span></li>
        @endif
    </ul> -->
@endif