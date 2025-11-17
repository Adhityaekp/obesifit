@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
        class="flex flex-col sm:flex-row sm:items-center sm:justify-between font-poppins space-y-3 sm:space-y-0">

        {{-- Info --}}
        <p class="text-sm text-gray-700 text-center sm:text-left">
            {!! __('Showing') !!}
            @if ($paginator->firstItem())
                <span class="font-semibold text-dark">{{ $paginator->firstItem() }}</span>
                {!! __('to') !!}
                <span class="font-semibold text-dark">{{ $paginator->lastItem() }}</span>
            @else
                <span class="font-semibold text-dark">{{ $paginator->count() }}</span>
            @endif
            {!! __('of') !!}
            <span class="font-semibold text-dark">{{ $paginator->total() }}</span>
            {!! __('results') !!}
        </p>

        {{-- Buttons Container --}}
        <div class="flex items-center justify-center sm:justify-end space-x-2">
            {{-- Previous Page --}}
            @if ($paginator->onFirstPage())
                <span
                    class="flex items-center justify-center w-10 h-10 rounded-full text-sm font-medium bg-gray-100 text-gray-400 cursor-not-allowed transition-colors"
                    aria-disabled="true">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="flex items-center justify-center w-10 h-10 rounded-full text-sm font-medium bg-primary text-white hover:bg-accent focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg"
                    aria-label="{{ __('Previous') }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            @endif

            {{-- Page Numbers --}}
            <div class="flex items-center space-x-1">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span
                            class="flex items-center justify-center w-10 h-10 rounded-full text-sm font-medium text-gray-500">...</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span
                                    class="flex items-center justify-center w-10 h-10 rounded-full text-sm font-semibold bg-accent text-white cursor-default shadow-inner"
                                    aria-current="page">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="flex items-center justify-center w-10 h-10 rounded-full text-sm font-medium bg-white text-dark border border-gray-200 hover:bg-primary hover:text-white hover:border-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all duration-200 shadow-sm hover:shadow-md">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="flex items-center justify-center w-10 h-10 rounded-full text-sm font-medium bg-primary text-white hover:bg-accent focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg"
                    aria-label="{{ __('Next') }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @else
                <span
                    class="flex items-center justify-center w-10 h-10 rounded-full text-sm font-medium bg-gray-100 text-gray-400 cursor-not-allowed transition-colors"
                    aria-disabled="true">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            @endif
        </div>
    </nav>

    {{-- Mobile Compact View --}}
    <div class="block sm:hidden mt-4">
        <div class="flex justify-between items-center">
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 rounded-lg text-sm font-medium bg-gray-100 text-gray-400 cursor-not-allowed">
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium bg-primary text-white hover:bg-accent transition-colors">
                    Previous
                </a>
            @endif

            <span class="text-sm text-gray-600 font-medium">
                Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
            </span>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium bg-primary text-white hover:bg-accent transition-colors">
                    Next
                </a>
            @else
                <span class="px-4 py-2 rounded-lg text-sm font-medium bg-gray-100 text-gray-400 cursor-not-allowed">
                    Next
                </span>
            @endif
        </div>
    </div>
@endif
