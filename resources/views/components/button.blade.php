<button {{ $attributes->merge(['type' => 'submit', 'class' => '
            inline-flex items-center justify-center px-4 py-2 bg-secondary-500 border border-transparent font-semibold text-xs 
            text-white tracking-widest hover:bg-secondary-600 active:bg-secondary-900 focus:outline-none 
            focus:border-secondary-900 focus:ring focus:ring-secondary-400 disabled:opacity-25 transition
        ']) }}>
    {{ $slot }}
</button>
