<ul class="autocar-paginator">
    <li class="previous-page">
        @if(!$paginator->onFirstPage())
            <a href="{{$paginator->previousPageUrl()}}"><i class="fas fa-angle-left"></i></a>
        @endif
    </li>
    <li class="paginator-info">
        {{$paginator->currentPage()}} of {{$paginator->lastPage()}}
    </li>
    <li class="next-page">
        <a href="{{$paginator->nextPageUrl()}}"><i class="fas fa-angle-right"></i></a>
    </li>
</ul>
