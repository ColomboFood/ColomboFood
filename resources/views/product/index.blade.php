<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800" id="breadcrumb">
    </h2>
</x-slot>

<div class="flex justify-center py-8 mx-auto"
    x-init="
        $wire.on('goTop', () => { 
            window.scrollTo({top:0}) 
        })
    "
>
    <div class="flex flex-col w-full mx-auto md:space-x-10 md:flex-row md:inline-flex max-w-7xl sm:px-6 lg:px-8">

        @include('product._filters-bar')

        <div class="w-full overflow-hidden bg-white shadow-xl sm:rounded-lg">

            <div class="grid grid-cols-2 mx-6 my-12 gap-x-6 gap-y-12 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($products as $product)
                    <a  href="{{ route('product.show', $product) }}">
                    <div class="flex flex-col items-center justify-center p-2 h-80">
                        <div class="relative h-48 overflow-hidden group">
                            <img @class([
                                    'object-cover h-full',
                                    'transition duration-500 transform group-hover:scale-90' => $product->hasImage()
                                ])
                                src="{{ $product->image }}" />
                            @if($product->hasImage())
                                <div class="absolute top-0 block w-1/2 h-full transform -skew-x-12 -inset-full z-5 bg-gradient-to-r from-transparent to-white opacity-40 group-hover:animate-shine"></div>
                            @endif
                        </div>
                        <div class="text-base font-bold text-center">{{ $product->name }}</div>
                        <div>{{ $product->short_description }}</div>
                        <div class="flex-none w-full mt-auto mb-0">
                            <div class='flex justify-between'>
                                <span>
                                    @if( !$product->defaultVariant()->exists() && !$product->variants()->exists())
                                        {{ $product->stock_status}}                                     
                                    @endif
                                </span>
                                <div class="relative flex flex-col">
                                    @if( $product->discount) 
                                        <span class="absolute ml-4 text-base text-gray-900 line-through -right-2 -top-4 dark:text-white">
                                            {{ $product->taxed_original_price }}€
                                        </span>
                                    @endif
                                    <span class='font-bold'>
                                        @auth
                                        {{ $product->taxed_price }}€
                                        @else
                                        <div class="tooltip tooltip-top" data-tip="Registrati per vedere i prezzi">
                                            <span>--.--€</span>
                                        </div>
                                        @endauth
                                    </span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    </a>
                @endforeach
            </div>

            <div class="m-2">
                {{ $products->links() }}
            </div>

        </div>

    </div>
</div>
