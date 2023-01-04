<x-slot name="seo">
    {!! seo($product) !!}
</x-slot>

<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        <a class="underline" href="{{ route('product.index') }}">{{ __('Shop') }}</a> / {{ $product->name }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
       
        <section class="overflow-hidden body-font">
            <div class="container px-5 py-12 mx-auto">
                <div class="flex flex-wrap mx-auto">

                    {{-- Left Side --}}
                    <div class="flex flex-col mx-auto md:w-1/2 " wire:key='{{$product->id}}'
                        x-data="{
                                curImage : '{{ $this->gallery[0]}}',
                                show : true,
                                transitionTotalTime : 500,
                                changeImage(src){
                                    if(this.curImage != src){
                                        this.show = false;                               
                                        setTimeout(() => { 
                                            this.curImage = src; 
                                            this.show = true} ,
                                            this.transitionTotalTime
                                        );
                                    }
                                }
                            }"
                    >

                        <div class="w-full h-64 mx-auto overflow-hidden border-2 lg:h-96">
                            <a :href="curImage">
                                <img alt="{{ $product->name }}" class="object-contain object-center h-full max-h-full m-auto transition-all ease-in cursor-zoom-in hover:scale-150"
                                    :src="curImage"
                                    x-transition.duration.500ms
                                    x-show = "show ">
                            </a>
                        </div>
                        @if(count($this->gallery) > 2)
                            <div class="inline-flex mx-auto mt-12 space-x-2">
                            @foreach ($this->gallery as $image )
                                <div class="border cursor-pointer"
                                    @click="changeImage('{{ $image }}')"
                                >
                                    <img class="object-contain w-24 h-24" src="{{ $image }}"     
                                    />
                                </div>
                            @endforeach
                            </div>
                        @endif

                    </div>
                    {{-- End Left Side --}}

                    {{-- Right Side --}}
                    <div class="w-full mt-12 lg:w-1/2 lg:pl-10 lg:py-6 lg:mt-0">
                        
                        {{-- Title Section --}}
                        @if($product->brand)
                        <div class="text-sm tracking-widest">{{ $product->brand->name}}</div>
                        @endif

                        <h1 class="mb-1 text-3xl">{{ $product->name }}</h1>
                        <div class="mt-2">{{ $product->short_description }}</div>
                        
                        <div class="flex mb-4">
                            @if($product->reviews->count())
                            <span class="flex items-center">
                                @for ($i = 1; $i <= $this->avg_rating; $i++) 
                                    <x-icons.star/>  
                                @endfor
                                @for ($i = 5; $i > $this->avg_rating; $i--) 
                                    <x-icons.star-empty/>  
                                @endfor
                                <span class="ml-3 text-gray-600">{{$product->reviews->count()}} {{ __('Reviews')}}</span>
                            </span>
                            @endif
                        </div>
                        {{-- End Title Section --}}

                        {{-- Details Section --}}
                        <div class="flex items-center mt-6 mb-6">
                            
                            @if( $this->shouldSelectVariantByImage() )
                                <div class="flex flex-row space-x-4">
                                    @if($product->defaultVariant? $product->defaultVariant->hasImage() : $product->hasImage())
                                    <a href="{{ route('product.show', $product->defaultVariant? $product->defaultVariant : $product) }}" class="px-1 border rounded-lg">
                                        <img class="object-contain w-8 h-8 mx-auto" src="{{ $product->defaultVariant ? $product->defaultVariant->image : $product->image }}"/>
                                    </a>
                                    @endif
                                    @foreach($product->defaultVariant? $product->defaultVariant->variants : $product->variants as $variant)
                                    @if($variant->hasImage())
                                    <a href="{{ route('product.show', $variant) }}" class="px-1 border rounded-lg">
                                        <img class="w-8 h-8" src="{{ $variant->image}}"/>
                                    </a>
                                    @endif
                                    @endforeach
                                </div>
                            @endif
                            
                            @if( $this->shouldSelectVariantByAttribute() )
                                @foreach($attributes as $id=>$name)
                                    @if($product->attributeValues->pluck('attribute_id')->contains($id))
                                    <div class="flex items-center ml-6">
                                        <span class="mr-3 capitalize">{{$name}}</span>
                                        <div class="relative">
                                            <select class="py-2 pl-3 pr-10 text-base border border-gray-300 rounded appearance-none focus:outline-none focus:ring-2 focus:ring-primary-200 focus:border-primary-500"
                                                wire:model="selection.{{$id}}"
                                            >
                                                @foreach ( $variantsAttributeValues->where('attribute.id',$id)->sortBy('value') as $attributeValue )
                                                    <option 
                                                        class="@if(!$this->variantExists($id, $attributeValue->id)) text-gray-400 @endif"
                                                        value="{{$attributeValue->id}}">{{$attributeValue->value}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    {{-- <div class="flex ml-6">
                                        <span class="mr-3 capitalize">{{ $name }}</span>
                                        @foreach ( $variantsAttributeValues->where('attribute.id',$id) as $attributeValue )
                                            <button class="w-6 h-6 ml-1 bg-{{ $attributeValue->value }}-700 border-2 border-gray-300 rounded-full focus:outline-none"></button>
                                        @endforeach
                                    </div> --}}

                                @endforeach
                            @endif
                            
                        </div>
                        {{-- End Details Section --}}

                        <div class="flex">
                            @auth
                                @if($product->discount)
                                <span class="mr-2 text-2xl font-medium text-gray-600 line-through">{{$product->taxed_original_price}}€</span>
                                @endif
                                <span class="text-2xl font-black text-gray-900">{{$product->taxed_selling_price}}€</span>
                            @else
                                <a href="{{ route('login') }}" class="flex px-6 py-2 text-white border-0 rounded bg-neutral-500 focus:outline-none hover:bg-neutral-600">
                                    {{ __('Login to view price') }}
                                </a>
                            @endauth
                            @if($product->quantity && $product->quantity < config('custom.stock_threshold'))
                                <span class="p-2 ml-4 text-red-500 rounded">{{ __('Low Stock') }}</span>
                            @endif
                        </div>
                        
                        <div class="flex items-center mt-6">
                            <div class="flex">
                                @if($product->quantity)
                                    <button class="flex px-6 py-2 ml-auto text-white border-0 rounded bg-secondary-500 focus:outline-none hover:bg-secondary-600"
                                        wire:click="addToCart"
                                    >{{ __('Add to cart') }}<x-icons.cart class="ml-1" /></button>
                                @else
                                    <button disabled class="flex px-6 py-2 ml-auto text-white bg-gray-500 border-0 rounded focus:outline-none"
                                    >{{ __('Out of Stock') }}</button>
                                @endif

                                @if(!$this->wishlistContains($product))
                                <button class="inline-flex items-center justify-center w-10 h-10 p-0 ml-4 text-gray-500 bg-gray-200 border-0 rounded-full"
                                    wire:click="addToWishlist"
                                >
                                    <x-icons.heart filled="false"/>
                                </button>
                                @else
                                <button class="inline-flex items-center justify-center w-10 h-10 p-0 ml-4 text-gray-500 bg-gray-200 border-0 rounded-full"
                                    wire:click="removeFromWishlist"
                                >
                                    <x-icons.heart filled="true"/>
                                </button>
                                @endif
                            </div>
                        </div>

                        <div class="mt-6">
                            <div class="text-lg">{{ __('Description') }}:</div>
                            <p class="text-gray-500">
                                @if($this->description)
                                    {!! $this->description !!}
                                @else
                                    {{ __('No description') }}
                                @endif
                            </p>
                        </div>
                        
                    </div>
                    {{-- End Right Side --}}
                    
                </div>
            </div>
        </section>

        <livewire:product.reviews :product='$product'/>

        </div>
    </div>
</div>