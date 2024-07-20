<nav aria-label="Page navigation example">
    <ul class="pagination">
        @if (!$paginator->onFirstPage())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}" aria-label="Первая страница">
                    <i class="fa-solid fa-angles-left"></i>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Назад">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
            </li>
        @endif

        @for ($i = $paginator->currentPage() - 2 > 1 ? $paginator->currentPage() - 2 : 1; $i <= ($paginator->currentPage() + 2 < $paginator->lastPage() ? $paginator->currentPage() + 2 : $paginator->lastPage()); $i++)
            <li @class(['page-item', 'active' => $paginator->currentPage() == $i])>
                <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($paginator->currentPage() != $paginator->lastPage())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Далее">
                    <i class="fa-solid fa-angle-right"></i>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}"
                    aria-label="Последняя страница">
                    <i class="fa-solid fa-angles-right"></i>
                </a>
            </li>
        @endif
    </ul>
</nav>
