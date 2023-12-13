
 @if ($paginator->hasPages())
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="d-flex flex-wrap py-2 mr-3" id="paginate-kegiatan">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
               <a class="btn btn-icon btn-sm btn-light-secondary mr-2 my-1 " aria-disabled="true" aria-label="@lang('pagination.previous')"><i class="ki ki-bold-double-arrow-back icon-xs text-secondary"></i></a>
            @else
               <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-double-arrow-back icon-xs"></i></a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a class="btn btn-icon btn-sm border-0 btn-hover-secondary mr-2 my-1 text-secondary">{{ $element }}</a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                         <a href="javascript:void(0);" class="btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1">{{ $page }}</a>
                        @else
                         <a href="{{ $url }}" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
               <a href="{{ $paginator->nextPageUrl() }}"  rel="next" aria-label="@lang('pagination.next')" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-double-arrow-next icon-xs"></i></a>
            @else
               <a class="btn btn-icon btn-sm btn-light-secondary mr-2 my-1" aria-disabled="true" aria-label="@lang('pagination.next')"><i class="ki ki-bold-double-arrow-next icon-xs text-secondary"></i></a>
            @endif
        </div>
    </div>
@endif