<div class="px-6 py-12 space-y-5 text-white bg-primary-500">

    <div class="mb-2 text-3xl font-bold">{{ isset($heading) ? $heading :  __('Total') }}</div>

    <div class="flex items-center justify-between">
        <span class="">{{ __('Subtotal') }}</span>
        <span class="text-xl font-bold">{{ $subtotal }}€</span>
    </div>

    @if($coupon)
    <div class="flex items-center justify-between">
        <span class="">{{ $coupon->label }} {{ $coupon->code ?? '' }}</span>
        <span class="text-xl font-bold">-{{ number_format( $subtotal - $discountedSubtotal , 2) }}€</span>
    </div>
    <div class="flex items-center justify-between">
        <span class=""></span>
        <span class="text-xl font-bold">{{ $discountedSubtotal }}€</span>
    </div>
    @endif
    
    @if($tax)
    <div class="flex items-center justify-between">
        <span class="">
            {{ __('Tax') }}
        </span>
        <span class="text-xl font-bold">{{ $tax }}€</span>
    </div>
    @endif

    @if(isset($shipping))
    <div class="flex items-center justify-between">
        <span class="">
            {{ __('Shipping') }} : {{ $shipping->name }}
        </span>
        <span class="text-xl font-bold">{{ $shippingPrice }}€</span>
    </div>
    @endif

    {{-- <h4 class="mb-2 text-xl font-bold">Shipping</h4>
    <div class="flex items-center justify-between mb-2">
        <span class="">Next day</span>
        <span class="text-xl font-bold">$11.00</span>
    </div>
    <div class="flex items-center justify-between mb-10">
        <span class="">Shipping to United States</span>
        <span class="text-xl font-bold">-</span>
    </div> --}}

    <div class="flex items-center justify-between pt-8 pb-12 border-t border-primary-100">
        <span class="text-xl font-bold">{{ __('Total') }}</span>
        <span class="text-xl font-bold">{{ $total }}€</span>
    </div>

    @if(isset($actions))
        {{ $actions }}
    @endif

</div>