@props([
    'ghost' => false
])

@if($ghost)
    <button {{ $attributes->merge(['type' => 'submit', 'class' => '
                inline-flex items-center justify-center px-4 py-2 bg-white border border-primary-500 font-semibold text-xs 
                text-primary-500 tracking-widest hover:bg-primary-50 active:bg-primary-100 focus:outline-none 
                focus:border-primary-900 focus:ring focus:ring-primary-400 disabled:opacity-25 transition
            ']) }}>
        {{ $slot }}
    </button>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => '
                inline-flex items-center justify-center px-4 py-2 bg-primary-500 border border-transparent font-semibold text-xs 
                text-white tracking-widest hover:bg-primary-600 active:bg-primary-900 focus:outline-none 
                focus:border-primary-900 focus:ring focus:ring-primary-400 disabled:opacity-25 transition
            ']) }}>
        {{ $slot }}
    </button>
@endif