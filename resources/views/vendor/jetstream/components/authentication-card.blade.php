<div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
    <div>
        <a href="{{ route('home') }}">
            {{ $logo }}
        </a>
    </div>

    <div class="w-full px-6 py-4 mt-8 overflow-hidden bg-white shadow-md sm:max-w-md">
        {{ $slot }}
    </div>
</div>
