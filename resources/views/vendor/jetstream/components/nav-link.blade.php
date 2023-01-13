@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-primary-500 text-sm font-medium leading-5 
                text-gray-900 focus:outline-none focus:border-primary-500 transition'
            : 'relative inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm 
               font-medium leading-5 text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900'  
            .   'before:content-[""] before:absolute before:block before:w-full before:h-[1.5px] 
                before:-bottom-0.5 before:left-0 before:bg-secondary-500
                before:hover:scale-x-100 before:scale-x-0 before:origin-top-left
                before:transition before:ease-in-out before:duration-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>