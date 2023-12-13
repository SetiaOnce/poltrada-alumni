@if ($paginator->hasPages())
    <nav >
        <ul class="rbt-pagination " id="paginate-produk">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <i class="feather-chevron-left" aria-hidden="true"></i>
               </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="feather-chevron-left"></i></a>
               </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled">{{ $element }}</li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active disabled" ><a href="javascript:void(0);">{{ $page }}</a></li>
                        @else
                              <li ><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a  href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="feather-chevron-right"></i></a>
               </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                  <i class="feather-chevron-right" aria-hidden="true"></i>
               </li>
            @endif
        </ul>
    </nav>
@endif

{{-- <nav>
     <ul class="rbt-pagination">
         <li><a href="#" aria-label="Previous"><i class="feather-chevron-left"></i></a></li>
         <li><a href="#">1</a></li>
         <li class="active"><a href="#">2</a></li>
         <li><a href="#">3</a></li>
         <li><a href="#" aria-label="Next"><i class="feather-chevron-right"></i></a></li>
     </ul>
 </nav> --}}
