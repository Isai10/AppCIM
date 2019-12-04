
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if (session()->get('modoExam')=="Normal")
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.previous')</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" id = "button-prev" href="{{$paginator->previousPageUrl()}}" rel="prev" onclick="return false;" >@lang('pagination.previous')</a>
                    </li>
                @endif
            @endif
            
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
               
                    <li class="page-item">
                        <a class="page-link "  id = "button-next"  href="{{ $paginator->nextPageUrl() }}" rel="next" onclick="return false;">@lang('pagination.next')</a>
                    </li>
                
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">@lang('pagination.next')</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
