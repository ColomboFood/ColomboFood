@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-primary-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-primary-600 transition'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-secondary-400 focus:outline-none focus:text-gray-700 focus:border-secondary-400 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

{{-- relative before:content-[""] before:absolute before:block before:w-full before:h-[2px] 
before:bottom-0 before:left-0 before:bg-secondary-500
before:hover:scale-x-100 before:scale-x-0 before:origin-top-left
before:transition before:ease-in-out before:duration-300 --}}