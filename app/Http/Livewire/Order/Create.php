<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Traits\Livewire\WithCartTotals;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\{Order, OrderStatus, Address, ShippingPrice};

class Create extends Component
{
    use WithCartTotals;

    public Order $order;
    public Address $shipping_address;
    public Address $billing_address;
    public $shipping_prices;

    public $same_address;

    public $email;
    public $phone;
    public $fiscal_code;
    public $vat;
    public $note;

    public $addresses_confirmed;

    protected $listeners = [
        'createOrder',
    ];

    protected function rules()
    {
        return [
            'email' => 'required|email'. ( auth()->user() ? '' : '|unique:users,email'),
            'vat' => 'required|numeric|digits:11',
            'fiscal_code' => 'nullable|required_without:vat|alpha_num|max:16',
            'phone' => 'nullable|numeric|digits_between:10,13',
            'note' => 'nullable|max:255',

            'shipping_address.full_name' => 'required',             
            'shipping_address.address' => 'required',              
            'shipping_address.city' => 'required',
            'shipping_address.province' => 'required|size:2',
            'shipping_address.country_region' => 'required',
            'shipping_address.postal_code' => 'required|min:5',

            'same_address' => '',
    
            'billing_address.full_name' => 'exclude_if:same_address,true',     
            'billing_address.address' => 'exclude_if:same_address,true|required',   
            'billing_address.city' => 'exclude_if:same_address,true|required',
            'billing_address.province' => 'exclude_if:same_address,true|required|size:2',
            'billing_address.country_region' => 'exclude_if:same_address,true|required',
            'billing_address.postal_code' => 'exclude_if:same_address,true|required|min:5',

            'shipping_price.id' => 'required|exists:shipping_prices,id', 
    
        ];
    }

    public function mount()
    {
        if(!Cart::instance('default') || !Cart::instance('default')->count())
            $this->redirect(route('cart.index'));

        if($this->updatePrices())
        {
            session()->flash('flash.banner', __('shopping_cart.prices_changed') );
            session()->flash('flash.bannerStyle', 'danger');

            $this->redirect(route('cart.index'));
        }

        $this->addresses_confirmed = false;

        $user = Auth::user();
        if($user){
            $this->email =  session()->get('email') ? session()->get('email') : $user->email;
            $this->phone =  session()->get('phone') ? session()->get('phone') : $user->phone;
            $this->fiscal_code =  session()->get('fiscal_code') ? session()->get('fiscal_code') : $user->fiscal_code;
            $this->vat =  session()->get('vat') ? session()->get('vat') : $user->vat;
        }
        
        $this->shipping_prices = ShippingPrice::active()->get();
        if(!count($this->shipping_prices))
        {
            session()->flash('flash.banner', __('general.unexpected_error') );
            session()->flash('flash.bannerStyle', 'danger');

            $this->redirect(route('cart.index'));
        } 

        $this->shipping_price = session()->get('shipping_price') ? 
            $this->shipping_prices->where('id', session()->get('shipping_price') )->first() 
            : $this->shipping_prices->first();

        if(session()->get('shipping_address')){
            $this->shipping_address = session()->get('shipping_address');
            if(session()->get('billing_address')){
                $this->billing_address = session()->get('billing_address');
                //$this->same_address = $this->shipping_address == $this->billing_address && ($this->vat || $this->fiscal_code); 
            }
            else{
                $this->billing_address = $this->shipping_address;
                //$this->same_address = true; 
            }
            $this->confirmAddresses();
        }
        else{
            if(Auth::user() && Auth::user()->defaultAddress){
                $this->shipping_address = Auth::user()->defaultAddress;
            }
            else $this->shipping_address = new Address();
            //$this->same_address = true; 
            $this->billing_address = $this->shipping_address;
            
            if((Auth::user() && Auth::user()->defaultAddress)){
                $this->confirmAddresses();
            }
        }

        $this->refreshTotals();
        
    }

    public function updatedShippingPriceId($value)
    {
        $this->shipping_price = $this->shipping_prices->where('id',$value)->first();
        session()->put('shipping_price', $this->shipping_price->id);
    }

    public function updatePrices()
    {
        $price_changed = false;
        foreach(Cart::instance('default')->content() as $key=>$item)
        {
            if($item->model->price != $item->price) $price_changed = true;
            Cart::instance('default')->update($key,$item->model);
        }
        return $price_changed;
    }

    public function confirmAddresses()
    {
        $this->validate();

        $this->fiscal_code = $this->fiscal_code ?? $this->vat;

        if($this->same_address) $this->billing_address = $this->shipping_address;
        
        session()->put('email', $this->email);
        session()->put('phone', $this->phone);
        session()->put('fiscal_code', $this->fiscal_code);
        session()->put('vat', $this->vat);
        session()->put('note', $this->note);
        session()->put('shipping_address', $this->shipping_address);
        session()->put('billing_address', $this->shipping_address);

        $this->addresses_confirmed = true;
        $this->emit('addressesConfirmed');
    }

    public function updateDefaultAddress()
    {
        $validated = $this->validate([
            'shipping_address.full_name' => 'required',             
            'shipping_address.address' => 'required',              
            'shipping_address.city' => 'required',
            'shipping_address.province' => 'required|size:2',
            'shipping_address.country_region' => 'required',
            'shipping_address.postal_code' => 'required|min:5',
            'phone' => 'nullable|numeric|digits_between:10,13',
        ]);
        
        $defaultAddress = Auth::user()->defaultAddress()->updateOrCreate([
            'user_id' => Auth::user()->id,
        ],[
            'full_name' => $validated['shipping_address']['full_name'],
            'address' => $validated['shipping_address']['address'],
            'city' => $validated['shipping_address']['city'],
            'province' => $validated['shipping_address']['province'],
            'country_region' => $validated['shipping_address']['country_region'],
            'postal_code' => $validated['shipping_address']['postal_code'],
            'default' => true,
        ]);

        $user = Auth::user()->update([
            'phone' => $validated['phone']
        ]);

        if($defaultAddress)
        {
            session()->put('shipping_address');
            $banner_message = __('banner_notifications.address.saved') ;
            $banner_style = 'success';
        }
        else
        {
            $banner_message = __('banner_notifications.address.not_saved');
            $banner_style = 'danger';
        }
        
        $this->dispatchBrowserEvent('banner-message', [
            'message' => $banner_message,
            'style' => $banner_style,
        ]);
    }

    public function updateBillingInfo()
    {
        $validated = $this->validate([
            'vat' => 'nullable|numeric|digits:11',
            'fiscal_code' => 'nullable|required_with:vat|alpha_num|max:16',
        ]);
        
        $user = Auth::user()->update([
            'fiscal_code' => $validated['fiscal_code'],
            'vat' => $validated['vat']
        ]);

        if($user)
        {
            session()->put('fiscal_code');
            session()->put('vat');
            $banner_message = __('banner_notifications.billing_info.saved') ;
            $banner_style = 'success';
        }
        else
        {
            $banner_message = __('banner_notifications.billing_info.not_saved');
            $banner_style = 'danger';
        }
        
        $this->dispatchBrowserEvent('banner-message', [
            'message' => $banner_message,
            'style' => $banner_style,
        ]);
    }

    public function copyAddress()
    {
        $this->billing_address = $this->shipping_address;
    }

    public function createOrder($payment_id, $gateway)
    {
        $validated = $this->validate([
            'shipping_price.id' => 'required|exists:shipping_prices,id',
            'shipping_price.price' => 'required|min:0',          
            'shipping_price.name' => 'required'
        ]);

        //CHECK PRODUCT AVAIABILITY
        $avaiable = true;
        $max_avaiable_from = null;
        foreach(Cart::instance('default')->content() as $key=>$item)
        {
            if($item->model->quantity < $item->qty) $avaiable = false;
            if($item->model->avaiable_from > $max_avaiable_from && $item->model->avaiable_from > today()) $max_avaiable_from = $item->model->avaiable_from;
        }
        if(!$avaiable)
        {
            $this->redirect(route('cart.index'));
        }
        
        if ($avaiable) {
            $status_id = OrderStatus::where('name', 'pending')->first()->id;
            $this->order = Order::firstOrCreate([
                'payment_gateway' => $gateway,
                'payment_id' => $payment_id,
            ],[
                'shipping_address' => $this->shipping_address->toJson(),
                'billing_address' => $this->billing_address->toJson(),
                'fiscal_code' => $this->fiscal_code ?? $this->vat,
                'vat' => $this->vat,
                'email' => $this->email,
                'phone' => $this->phone,
                'note' => $this->note,
                'subtotal' => $this->subtotal,
                'tax'   => $this->tax,
                'total' => $this->total + $this->shipping_price->price,
                'coupon_id' => $this->coupon ? $this->coupon->id : null,
                'coupon_discount' => $this->coupon ? $this->coupon->discount(Cart::instance('default')->subtotal()) : null,
                'order_status_id' => $status_id,
                'user_id' => auth()->user() ? auth()->user()->id : null,
                'shipping_price_id' => $this->shipping_price->id,
                'shipping_price' => $this->shipping_price->price,
                'avaiable_from' => $max_avaiable_from,
            ]);

            $pivots = [];
            foreach (Cart::instance('default')->content() as $item) {
                $pivots[$item->id] = [
                'price' => $item->price,
                'quantity' => $item->qty,
            ];
                $product=\App\Models\Product::find($item->id);
                $product->quantity = ($product->quantity >$item->qty) ? $product->quantity-$item->qty : 0;
                $product->save();
            }
            $this->order->products()->attach($pivots);

            if($this->coupon)
            {
                $this->coupon->redemptions++;
                $this->coupon->save();
            }

            $this->order->history()->create([
                'order_status_id' => $status_id,
            ]);

            if(Auth::user()) {
                if(!Auth::user()->fiscal_code) Auth::user()->update(['fiscal_code' => $this->fiscal_code]) ;
                if(!Auth::user()->vat) Auth::user()->update(['vat' => $this->vat]) ;
            }

            Cart::instance('default')->destroy();
            if(Auth::check())
                Cart::instance('default')->erase(auth()->user()->email);
            session()->forget('coupon');
            session()->forget('shipping_price');
            session()->forget('shipping_address');
            session()->forget('billing_address');
            session()->forget('email');
            session()->forget('phone');
            session()->forget('fiscal_code');
            session()->forget('vat');
            session()->forget('note');

            if($gateway == 'paypal')
                $this->order->setAsPaied();

            $this->emit('orderCreated');
        }
        else
        {
            redirect()->route('cart.index');
        }
    }
   
    public function render()
    {
        if($this->addresses_confirmed)
        {
            $this->confirmAddresses();
        }

        return view('order.create');
    }
}
