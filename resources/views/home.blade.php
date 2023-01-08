<x-app-layout>

    <div class="w-full h-[32rem] bg-cover bg-right-bottom"
        style="background-image: url('/img/homebanner.png')"
    >
        <div class="container pt-24 mx-auto lg:pt-32">
            <div class="w-full px-6 py-4 mx-auto bg-white sm:px-2 sm:w-96 md:p-auto bg-opacity-80 md:bg-opacity-0 md:ml-6 lg:ml-20 lg:w-96">
                <x-jet-application-logo class="w-full"/>
                {{-- <x-algolia-autocomplete class="w-full mt-6"/> --}}
                <form method="GET" action="{{ route('product.index') }}">
                    <div class="flex items-center w-full pr-2 mt-6 transition focus-within:border-primary-500 focus-within:border-b-2">
                        <input class="flex-1 bg-transparent border-transparent peer focus:border-transparent focus:ring focus:ring-transparent"
                            type="text" name="query" placeholder="{{ __('Search...') }}"
                        />
                        <button type="submit" class="transition duration-300 opacity-50 hover:opacity-100 peer-focus:opacity-100">
                            <svg class="w-5 h-5 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container grid gap-6 px-6 mx-auto my-6 md:grid-cols-3">
        @foreach($featured_categories as $category)
            <a href="{{ route('product.index', [ 'category' => $category->slug ]) }}">
                <div class="relative flex items-center justify-center h-24 overflow-hidden bg-cover cursor-pointer group">
                    <img class="absolute object-cover w-full h-full transition duration-700 ease-in-out transform group-hover:scale-150 group-hover:opacity-70" 
                        src="{{ $category->hero }}"
                    />
                    <span class="absolute px-6 py-1 bg-white bg-opacity-80">{{ $category->name }}</span>
                </div>
            </a>
        @endforeach
    </div>
    
    <div class="container mx-auto my-12">
        <h2 class="text-2xl font-bold text-center">I nostri <span class="text-accent-500">Best Seller</span></h2>
    
        <div class="grid grid-cols-2 mx-6 my-12 gap-x-6 gap-y-12 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">

            @foreach ($featured_products as $product)
                <div class="last:hidden last:md:flex">
                    <a href="{{ route('product.show', $product) }}">
                        <div class="flex flex-col items-center h-full p-2">
                            <div class="relative h-48 overflow-hidden group">
                                <img @class([
                                        'object-cover h-full',
                                        'transition duration-500 transform group-hover:scale-90' => $product->hasImage()
                                    ])
                                    src="{{ $product->image }}"/>
                                @if($product->hasImage())
                                    <div class="absolute top-0 block w-1/2 h-full transform -skew-x-12 -inset-full z-5 bg-gradient-to-r from-transparent to-white opacity-40 group-hover:animate-shine"></div>
                                @endif
                            </div>
                            <div class="mt-1 text-base font-bold text-center">{{ $product->name }}</div>
                            <div class="text-gray-500">{{ $product->short_description }}</div>
                            <form action="{{ route('product.show', $product) }}" method="GET" class="flex-none w-full pt-12 mt-auto mb-0">
                                <x-button class="justify-center w-full">{{ __('See more') }}</x-button>
                            </form>
                        </div>
                    </a>
                </div>
                </a>
            @endforeach
        
        </div>

    </div>

    <div class="container grid w-full gap-6 px-6 mx-auto my-12 md:grid-cols-2 lg:grid-cols-5">
        
        <div class="flex items-center justify-center px-6 pt-6 pb-10 bg-neutral-50 lg:col-span-2 bg-opacity-60">
            <div class="flex flex-col">
                <p>Cerchi un prodotto particolare che non trovi sul sito?</p>
                <p>Scrivi a <a class="underline" href="mailto:info@info.it">info@colombofood.it</a></p>
            </div>
        </div>

        <div class="flex flex-col px-4 py-10 bg-secondary-50 lg:flex-row lg:col-span-3 bg-opacity-60">
            <div class="flex flex-col mb-12 text-center lg:mb-0 lg:ml-auto lg:mr-0">
                <p>Consegna in tutta Italia!</p>
                <a class="mx-auto underline max-w-max" href="">Guarda le tariffe</a>
            </div>
            <img class="h-32 mx-auto -mb-10 lg:ml-auto lg:mr-12" src="/img/camioncino.png" />
        </div>

    </div>

    <div class="w-full bg-gray-50">
        <div class="container flex flex-col w-full mx-auto my-12 md:h-96 md:flex-row">
            <img class="object-cover object-top h-64 lg:w-full md:max-w-xs lg:max-w-none md:object-center md:h-full lg:h-auto" 
                src="/img/shop.png"
                
            />
            <div class="flex flex-col items-center w-full">
                <div class="max-w-sm pt-4 pb-10 ml-4 md:pt-0 md:pb-0 md:mt-12">
                    <p class="text-3xl font-bold">Hai la partita Iva?</p>
                    <p class="mt-6">
                        ColomboFood ha studiato una serie di offerte dedicate e personalizzate rivolte ai commercianti,
                        proprietari di bar, panetterie o piccole attività.
                    </p>
                    <p class="mt-6 font-bold">
                        Perchè a volte avere la Partita Iva può essere un vantaggio!
                    </p>
                    <div class="mt-6">
                        <x-button class="px-12">Scopri i vantaggi</x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full">
        <div class="container flex flex-col w-full mx-auto my-12 md:h-96 md:flex-row">
            <div class="flex flex-col items-center w-full">
                <div class="max-w-sm pt-4 pb-10 mr-12 text-right md:pt-0 md:pb-0 md:my-auto">
                    <p class="text-3xl font-bold text-accent-500">Da oggi puoi ritirare direttamente nel nostro magazzino!</p>
                    <p class="mt-2">
                        Organizza il tuo ritiro chiamandoci al
                        <span class="inline-block">+39 02 392 835 39</span>
                    </p>
                </div>
            </div>
            <img class="object-cover object-top h-64 lg:w-full md:max-w-xs lg:max-w-none md:object-center md:h-full lg:h-auto" src="/img/shipping.png"/>
        </div>
    </div>

    <div class="w-full bg-neutral-50">
        <div class="container flex w-full px-6 py-6 mx-auto my-12">
            <img class="hidden h-24 my-auto ml-auto mr-12 md:block" 
                src="/img/logos/pane_quotidiano.png"
            />
            <div class="flex flex-col items-center justify-center md:text-center">
                <div class="">
                    <p class="text-3xl font-bold text-neutral-500">Colombo Food supporta Pane Quotidiano</p>
                    <p class="text-3xl text-neutral-400">e combatte la lotta contro lo spreco al cibo.</p>
                    <p class="mt-2">
                        Puoi dare una mano anche tu, vai su: <a class="underline" href="https://panequotidiano.eu" target="_blank">panequotidiano.eu</a>
                    </p>
                </div>
            </div>
            <img class="hidden h-24 my-auto ml-12 mr-auto sm:block" 
                src="/img/logos/pane_quotidiano.png" 
            />
        </div>
    </div>

</x-app-layout>