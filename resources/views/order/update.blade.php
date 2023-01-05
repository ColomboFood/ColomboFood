<x-slot name="seo">
    {!! 
        seo(new RalphJSmit\Laravel\SEO\Support\SEOData(
                title: __('Order Update')
            )) 
    !!}
</x-slot>

<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Order Update') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="mx-auto md:flex max-w-7xl sm:px-6 lg:px-8">

        <div class="w-full overflow-hidden bg-white shadow-xl md:flex sm:rounded-lg">

            <div class="w-full md:1/2 lg:w-2/3">

                <div class="px-8 pt-6 pb-12" 
                        x-data="{ 
                            selected: @js($addresses_confirmed || count($errors) ? null : 1),
                            same_address : @entangle('same_address'),
                            addresses_confirmed : @entangle('addresses_confirmed'),
                        }"
                        x-init="
                            Livewire.on('addressesConfirmed', () => {
                                if(selected != 4)
                                    selected = null;
                            });
                        "
                    >
                
                    <x-jet-validation-errors class="my-4 mb-4" />

                    <form action="" method="POST">
                    @csrf

                        <div class="relative border-b-2 border-gray-200">
                            <button type="button" class="w-full py-6 text-left"
                                x-bind:disabled="addresses_confirmed"
                                @click="selected !== 1 ? selected = 1 : selected = null">
                                <div class="flex items-center justify-between">
                                    <span @class([
                                            'text-lg font-semibold text-gray-900',
                                            'text-red-500' => $errors->has('shipping_address.*') || $errors->has('email') || $errors->has('phone') || $errors->has('note'),
                                        ])
                                    >
                                        {{ __('Shipping Address') }}
                                        
                                    </span>
                                    <span
                                        x-show="!addresses_confirmed"
                                    >
                                        <x-icons.plus/>
                                    </span>
                                </div>

                                
                                @if($shipping_address->label)
                                <div class="flex items-center p-2"
                                    x-show="selected != 1"
                                    x-transition:enter.delay.200ms
                                    x-cloak
                                >
                                    {!! $shipping_address->label !!}
                                    <div>{{ $phone }}</div>
                                    @if($note)
                                        <div class="mt-2">{{ $note }}</div>
                                    @endif
                                </div>
                                @endif
                            </button>

                            <div class="relative overflow-hidden transition-all duration-300 max-h-0" style=""
                                x-ref="container1"
                                x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''"
                            >
                                <div class="p-6">
                                <div @class([
                                    'relative z-0 w-full mb-6 group',
                                    'hidden' => Auth::check()
                                    ])>
                                    <x-input-floating label="{{ __('Email') }}" name="shipping_address_email" wire:model.lazy="email"/>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input-floating label="{{ __('Full Name') . ' / ' . __('Company') }}" name="shipping_address_full_name" wire:model.lazy="shipping_address.full_name"/>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input-floating label="{{ __('Phone Number') }}" name="phone" wire:model.lazy="phone"/>
                                    </div>
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-input-floating label="{{ __('Address') }}" name="shipping_address_address" wire:model.lazy="shipping_address.address"/>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input-floating label="{{ __('City') }}" name="shipping_address_city" wire:model.lazy="shipping_address.city"/>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input-floating label="{{ __('Province') }}"  maxlength="2" name="shipping_address_province" wire:model.lazy="shipping_address.province"/>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input-floating label="{{ __('Country/Region') }}" name="shipping_address_country_region" wire:model.lazy="shipping_address.country_region"/>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input-floating label="{{ __('Postal Code') }}" name="shipping_address_postal_code" wire:model.lazy="shipping_address.postal_code"/>
                                    </div>
                                </div>

                                <div class="relative z-0 w-full mb-6 group">  
                                    <textarea id="note" name="note" rows="4" maxlength="255" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-primary-500 focus:outline-none focus:ring-0 focus:border-primary-600 peer" 
                                        wire:model.lazy="note" placeholder=" "></textarea>
                                    <label for="note" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-primary-600 peer-focus:dark:text-primary-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                                        >{{ __('Note') }}</label>
                                </div>

                                <div class="mt-6 md:flex md:justify-between">
                                    <div class="flex items-center mb-6">
                                        @if($shipping_address != $billing_address)
                                        <button class="ml-2 text-sm font-medium text-gray-900 underline link dark:text-gray-300"
                                            wire:click="copyAddress()"
                                        >{{ __('Use as billing address') }}</button>
                                        @endif
                                    </div>

                                    @auth
                                        <button type="button" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                            wire:click.prevent='updateDefaultAddress'
                                        >{{ __('Save as default') }}</button>
                                    @endauth
                                    
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="relative border-b-2 border-gray-200">

                            <button type="button" class="w-full py-6 text-left"
                                x-bind:disabled="addresses_confirmed"
                                @click="selected !== 2 ? selected = 2 : selected = null">
                                <div class="flex items-center justify-between">
                                    <span @class([
                                            'text-lg font-semibold text-gray-900',
                                            'text-red-500' => $errors->has('billing_address.*') || $errors->has('fiscal_code') || $errors->has('vat'),
                                        ])
                                    >
                                        {{ __('Billing Address') }}
                                    </span>
                                    <span
                                        x-show="!addresses_confirmed"
                                    >
                                        <x-icons.plus/>
                                    </span>
                                </div>
                                                                  
                                @if( ($same_address && $shipping_address->label) || $billing_address->label)  
                                <div class="flex items-center p-2"
                                    x-show="selected != 2"
                                    x-transition:enter.delay.200ms
                                    x-cloak
                                > 
                                    <div>
                                        {{ __('Fiscal Code')}}: {{ $fiscal_code }}
                                    </div>
                                    <div>
                                        {{ __('VAT')}}: {{ $vat }}
                                    </div>
                                    <div class="mt-2">
                                        {!! $billing_address->label ?? $shipping_address->label !!}
                                    </div>
                                </div>
                                @endif
                            </button>
                            
                            <div class="relative overflow-hidden transition-all duration-300 max-h-0" style=""
                                x-ref="container2"
                                x-bind:style="selected == 2 ? 'max-height: ' + $refs.container2.scrollHeight + 'px' : ''"
                            >
                                <div class="p-6">
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input-floating label="{{ __('Full Name') . ' / ' . __('Company') }}" name="billing_address_full_name" wire:model.lazy="billing_address.full_name"/>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input-floating label="{{ __('Fiscal Code') }}" name="fiscal_code" wire:model.lazy="fiscal_code"/>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input-floating label="{{ __('VAT') }}" name="vat" wire:model.lazy="vat"/>
                                    </div>
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <x-input-floating label="{{ __('Address') }}" name="billing_address_address" wire:model.lazy="billing_address.address"/>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input-floating label="{{ __('City') }}" name="billing_address_city" wire:model.lazy="billing_address.city"/>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input-floating label="{{ __('Province') }}"  maxlength="2" name="billing_address_province" wire:model.lazy="billing_address.province"/>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input-floating label="{{ __('Country/Region') }}" name="billing_address_country_region" wire:model.lazy="billing_address.country_region"/>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <x-input-floating label="{{ __('Postal Code') }}" name="billing_address_postal_code" wire:model.lazy="billing_address.postal_code"/>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>

                        @if($addresses_confirmed)
                        <button type="button" class="mt-5 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                            wire:click.prevent="$set('addresses_confirmed',false)"
                        >{{ __('Edit') }}</button>
                        @endif   
                    </form>
            
            </div>
        </div>

        <div class="w-full md:1/2 lg:w-1/3">

            <div class="pt-6 pb-12 pl-8 pr-8 md:pl-0">
                <x-price-total
                    :subtotal="$order->subtotal"
                    :discounted-subtotal="$order->discounted_subtotal"
                    :tax="$order->tax"
                    :total="$order->total"
                    :coupon="$order->coupon"
                    :shipping="$order->shippingPrice"
                    :shipping-price="$order->shipping_price"
                >
                    <x-slot:actions>
                        <div class="flex justify-center">
                            @if(!$addresses_confirmed && $order->canBeEdited())
                                <button type="button" class=" w-full text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                    wire:click.prevent='updateAddresses'
                                >{{ __('Update Addresses') }}</button>
                            @endif
                            @if($addresses_confirmed && $order->canBePaied())
                                <livewire:checkout :total="$order->total" update="true"/>
                            @endif
                        </div>
                    </x-slot>
                </x-price-total>
            </div>
        
        </div>
    
    </div>
</div>