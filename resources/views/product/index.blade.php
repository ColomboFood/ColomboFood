<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800" id="breadcrumb">
    </h2>
</x-slot>

<div class="flex justify-center py-8 mx-auto">
    <div class="flex flex-col w-full mx-auto md:space-x-10 md:flex-row md:inline-flex max-w-7xl sm:px-6 lg:px-8">

        <div class="flex flex-col w-full py-2 mb-2 space-x-2 md:w-64 md:mb-auto" aria-label="Sidebar">

            <div class="flex flex-col">
                <div class="flex w-full">
                    <x-input type="text" placeholder="Search…" wire:model.debounce.500ms="query" />
                    <x-button>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </x-button>
                </div>
            </div>

            <div class="w-56 p-2 mt-4 space-y-6 bg-base-100">
                <div class="space-y-2">
                    <div class="mb-2 font-bold">{{ __('Categories') }}</div>
                    @foreach ($categories->where('parent_id', null) as $category1)
                        <div class="ml-2"
                            x-data="{
                                open: @js($openMenus->contains($category1->name))
                            }"
                        >
                            <div class="flex items-center justify-between cursor-pointer {{ $openMenus->contains($category1->name) ? 'font-semibold' : '' }}"]
                            >
                                <span wire:click="toggleCategory('{{ $category1->slug }}')"
                                    x-on:click="open=true"
                                >{{ $category1->name }}</span>
                                @if($categories->filter( fn($c) => $c->parent_id == $category1->id )->count())
                                    <div class="grid w-6 h-6 place-items-center"
                                        x-cloak
                                        x-show="open"
                                        x-on:click="open=!open"
                                    >
                                        <x-icons.chevron-right class="w-4 h-4 transform -rotate-90" />
                                    </div>
                                    <div class="grid w-6 h-6 place-items-center"
                                        x-cloak
                                        x-show="!open"
                                        x-on:click="open=!open"
                                    >
                                        <x-icons.chevron-right class="w-4 h-4 transform rotate-90" />
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4"
                                x-show="open"
                            >
                                @foreach ($categories->where('parent_id', $category1->id) as $category2)
                                    <div
                                        class="flex items-center justify-between cursor-pointer {{ $openMenus->contains($category2->name) ? 'font-semibold' : '' }}">
                                        <span
                                            wire:click="toggleCategory('{{ $category2->slug }}')">{{ $category2->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="space-y-2">
                    <div class="mb-2 font-bold">{{ __('Collections') }}</div>
                    @if($collections->count())
                        <div class="flex flex-col p-5 border border-border-base">
                            @foreach ($collections as $menuCollection)
                                <label class="group flex items-center justify-between text-brand-dark text-sm md:text-15px cursor-pointer transition-all hover:text-opacity-80 border-b border-border-base py-3.5 last:border-b-0 last:pb-0 first:pt-0">
                                    <span class="ltr:mr-3.5 rtl:ml-3.5 -mt-0.5">{{ $menuCollection->name }}
                                    </span>
                                    <input type="checkbox" class="form-checkbox text-yellow-100 w-[22px] h-[22px] border-2 border-border-four rounded-full cursor-pointer transition duration-500 ease-in-out focus:ring-offset-0 hover:border-yellow-100 focus:outline-none focus:ring-0 focus-visible:outline-none checked:bg-yellow-100 hover:checked:bg-yellow-100"
                                        wire:model="collection" value="{{ $menuCollection->slug }}"
                                    >
                                </label>
                            @endforeach
                        </div>
                    @else
                        <div>No collections</div>
                    @endif
                </div>

                <div class="space-y-2">
                    <div class="mb-2 font-bold">{{ __('Brands') }}</div>
                    @if($brands->count())
                        <div class="flex flex-col p-5 border border-border-base">
                            @foreach ($brands as $menuBrand)
                                <label class="group flex items-center justify-between text-brand-dark text-sm md:text-15px cursor-pointer transition-all hover:text-opacity-80 border-b border-border-base py-3.5 last:border-b-0 last:pb-0 first:pt-0">
                                    <span class="ltr:mr-3.5 rtl:ml-3.5 -mt-0.5">{{ $menuBrand->name }}
                                    </span>
                                    <input type="checkbox" class="form-checkbox text-yellow-100 w-[22px] h-[22px] border-2 border-border-four rounded-full cursor-pointer transition duration-500 ease-in-out focus:ring-offset-0 hover:border-yellow-100 focus:outline-none focus:ring-0 focus-visible:outline-none checked:bg-yellow-100 hover:checked:bg-yellow-100"
                                        wire:model="brand" value="{{ $menuBrand->slug }}"
                                    >
                                </label>
                            @endforeach
                        </div>
                    @else
                        <div>No brands</div>
                    @endif
                </div>

                <div class="">
                    <x-jet-secondary-button wire:click="resetFilters">Reset filters</x-jet-secondary-button>
                </div>


            </div>
        </div>

        <div class="w-full overflow-hidden bg-white shadow-xl sm:rounded-lg">

            <div class="grid grid-cols-2 mx-6 my-12 gap-x-6 gap-y-12 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($products as $product)
                    <a  href="{{ route('product.show', $product) }}">
                    <div class="flex flex-col items-center justify-center p-2 h-80">
                        <div class="relative h-48 overflow-hidden group">
                            <img class="object-cover h-full transition duration-500 transform group-hover:scale-90"
                                src="{{ $product->image }}" />
                            <div
                                class="absolute top-0 block w-1/2 h-full transform -skew-x-12 -inset-full z-5 bg-gradient-to-r from-transparent to-white opacity-40 group-hover:animate-shine">
                            </div>
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
