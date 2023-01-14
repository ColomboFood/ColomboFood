<x-app-layout>

    <x-slot name="seo">
        {!! seo($SEOData) !!}
    </x-slot>

    <x-slot name="header">
        <h1 class="mb-4 text-3xl font-bold">
            {{ __('My Orders') }}
        </h1>
    </x-slot>
    
    <div class="px-6 py-8 mx-auto max-w-7xl lg:px-8 mb-12">
        <div>
            @if($orders->count())
            <ol class="relative w-full mx-auto border-l border-gray-200 space-y-24">
                @foreach($orders as $order)
                <li class="mb-12 ml-6 md:flex">
                    
                    <div class="flex-none w-full md:w-2/3 md:pr-6">

                        <span class="absolute flex items-center justify-center w-6 h-6 rounded-full ring-8 ring-white text-white bg-primary-500 -left-3">
                            <x-icons.cube class="w-4 h-4"/>    
                        </span>

                        <div class="flex items-center mb-2 font-semibold"
                        >
                            <a class="text-lg" href="{{ route('order.show', $order) }}">
                                #{{ $order->number }} 
                            </a>
                            <span class="bg-white uppercase text-primary-500 text-xs mx-2 px-2 py-0.5 border border-primary-500">
                                {{ $order->status->label }}
                            </span>
                        </div>

                        <time class="block mb-4 text-xs text-gray-500">
                            {{ __('Created on') }} {{ $order->created_at->format(config('custom.date_format')) }}
                        </time>

                        @if($order->avaiable_from && $order->isActive())
                        <div class="my-2">
                            <p class="text-sm">
                                {{ __('Advanced Sale Alert', [ 'date' => $order->avaiable_from->format(config('custom.date_format')) ]) }}
                            </p>
                        </div>
                        @endif

                        <div class="mb-4 text-xl font-bold"
                        >{{ __('Total') }}: {{ $order->total }}€</div>

                        <p class="mb-4 text-sm text-gray-500"
                        >{!! $order->shippingAddress()->label !!}</p>
                    
                        <div class="w-full pt-4 border-t border-gray-200 grid sm:grid-cols-2 gap-6">
                        @foreach($order->products as $product)
                            <div class="flex flex-nowrap w-full">
                                <div class="">
                                    <a href="{{ route('product.show', $product) }}">
                                        <div class="flex items-start justify-start w-full h-20 md:justify-start">
                                            <img class="object-contain object-top h-full" src="{{ $product->image }}" alt="{{ $product->name }}">
                                        </div>
                                    </a>
                                </div>
                                <div class="ml-6 mt-2 md:mt-0 space-y-2 flex flex-col justify-between">
                                    <div class="font-semibold">
                                        <a href="{{ route('product.show', $product) }}">
                                            {{ $product->name }}
                                        </a>
                                    </div>
                                    <div class="text-gray-500 text-sm">{{ __('Quantity') }}:{{$product->pivot->quantity}}</div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>

                    <div class="flex flex-col items-center w-full px-6 py-6 space-y-2 bg-gray-50 md:w-1/3 mt-12 md:mt-0">
                        <form class="w-full" action="{{ route('order.show', $order) }}" method="GET">
                            <x-button type="submit" class="justify-center w-full"
                            s>{{ __('Details') }}</x-button>
                        </form>
                        @if($order->canBePaied())
                            <div class="w-full">
                                <a href="{{ route('order.update', $order ) }}" class="inline-flex items-center justify-center w-full px-4 py-2 text-xs font-medium text-white uppercase border rounded-md border-primary-200 bg-primary-500 hover:bg-primary-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-200 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                {{ __('Pay Now') }}</a>
                            </div>
                        @endif
                        @if($order->canBeEdited())
                            <form class="w-full" action="{{ route('order.update', $order ) }}" method="GET">
                                <x-secondary-button type="submit" class="justify-center w-full"
                                >{{__('Edit') }}</x-secondary-button>
                            </form>
                        @endif
                        @if($order->canBeInvoiced())
                            <form class="w-full" action="{{ route('invoice.show', $order ) }}" method="GET">
                                <x-secondary-button type="submit" class="justify-center w-full"
                                >
                                    {{ __('Invoice') }}
                                    <x-icons.document-download class="w-4 h-4"/>
                                </x-secondary-button>
                            </form>
                        @endif
                        @if($order->canBeDeleted())
                            <div class="w-full">
                                <livewire:order.destroy-form class="" :order='$order'/>
                            </div>
                        @endif
                    </div>
                    
                </li>
                @endforeach
            </ol>
            @else
            <div class="grid place-items-center">
                <div class="py-12">
                    <p>
                        {{ __("Haven't found anything, yet?") }}
                    </p>
                    <div class="flex flex-col w-full mt-6 space-y-2 sm:space-y-0 sm:space-x-2 sm:flex-row">
                        <form class="w-full sm:w-1/2" method="GET" action="{{ route('product.index') }}">
                            <x-button class="w-full">{{ __('To Shop') }}</x-button>
                        </form>
                        <form class="w-full sm:w-1/2" method="GET" action="{{  route('product.show', $randomProduct) }}">
                            <x-secondary-button class="w-full">{{ __('Random Product') }}</x-secondary-button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="flex justify-center">
            {{ $orders->links() }}
        </div>
    </div>
</x-app-layout>
