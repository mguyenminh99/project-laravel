@if ($paginator->hasPages())
    <!-- Pagination -->
    <div class="product_sorting_container product_sorting_container_bottom clearfix">
        <div style="width:fit-content">

        {{-- <ul class="product_sorting">
            <li>
                <span>Show:</span>
                <span class="num_sorting_text">{{ $paginator->currentPage() }}</span>
                <i class="fa fa-angle-down"></i>
                <ul class="sorting_num">
                    @foreach ($elements as $element)
                @if (is_array($element))
                @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage() && $paginator->onFirstPage() == false)
                            <li><a href="{{ $paginator->previousPageUrl() }}"><span style="color: black">{{ $page - 1 }}</span></a></li>
                            <li class="active"><span style="color: red" >{{ $page }}</span></li>
                        @elseif ($page == $paginator->currentPage() )
                            <li class="active"><span style="color: red" >{{ $page }}</span></li>
                        @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 1) || $page == $paginator->lastPage())
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @elseif ($page == $paginator->lastPage() - 1)
                            <li class="disabled" style="color: black">...</li>
                        @endif
                    @endforeach
                @endif
            @endforeach
                @endif
            @endforeach
                </ul>
            </li>
        </ul> --}}
        <span class="showing_results">Showing {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }} results</span>
         <div class="pages d-flex flex-row align-items-center"> 
            <div class="page_current">
                <span>
                    {{ $paginator->currentPage() }}
                </span>
                <ul class="page_selection">
                    @foreach ($elements as $element)
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage() && $paginator->onFirstPage() == false)
                                    <li><a href="{{ $paginator->previousPageUrl() }}"><span style="color: black">{{ $page - 1 }}</span></a></li>
                                    <li class="active"><span style="color: red" >{{ $page }}</span></li>
                                @elseif ($page == $paginator->currentPage() )
                                    <li class="active"><span style="color: red" >{{ $page }}</span></li>
                                @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 1) || $page == $paginator->lastPage())
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @elseif ($page == $paginator->lastPage() - 1)
                                    <li class="disabled" style="color: black">...</li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="page_total"><span>of</span>{{ $paginator->lastPage() }}</div>
            <div id="next_page_1" class="page_next"><a href="#"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>
        </div> 
        </div>
    </div>
    <!-- Pagination -->
@endif

