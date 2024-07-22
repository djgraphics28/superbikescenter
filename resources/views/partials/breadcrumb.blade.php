@unless ($breadcrumbs->isEmpty())
  <nav>
    <ol class="flex flex-wrap py-4 text-sm">
      @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->url && ! $loop->last)
          <li>
            <a
              wire:navigate
              href="{{ $breadcrumb->url }}"
              class="text-gray transition-colors hover:text-primary-800 focus:text-primary-500"
            >
              {{ $breadcrumb->title }}
            </a>
          </li>
        @else
          <li class="{{ ! $loop->last ? 'text-gray' : 'text-primary-800' }}">
            {{ $breadcrumb->title }}
          </li>
        @endif

        @unless ($loop->last)
          <li class="px-2 text-gray-500">
            \
          </li>
        @endif
      @endforeach
    </ol>
  </nav>
@endunless
