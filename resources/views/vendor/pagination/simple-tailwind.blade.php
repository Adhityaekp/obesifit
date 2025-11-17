@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{!! __('Pagination Navigation') !!}" class="flex justify-between font-poppins">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-light border border-gray-300 rounded-md cursor-default dark:bg-dark dark:text-gray-500 dark:border-gray-600">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary border border-primary rounded-md hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition duration-150">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary border border-primary rounded-md hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition duration-150">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-light border border-gray-300 rounded-md cursor-default dark:bg-dark dark:text-gray-500 dark:border-gray-600">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
