<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\{Order, OrderStatus ,Address};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Update extends Component
{
    use AuthorizesRequests;
    
    public Order $order;
    public Address $shipping_address;
    public Address $billing_address;
    
    public $same_address;

    public $email;
    public $phone;
    public $fiscal_code;
    public $vat;
    public $note;

    public $addresses_confirmed;

    protected $listeners = [
        'updateOrder',
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
            'shipping_address.postal_code' => 'required|min:5|max:5',

            'same_address' => '',
    
            'billing_address.full_name' => 'exclude_if:same_address,true',     
            'billing_address.address' => 'exclude_if:same_address,true|required',   
            'billing_address.city' => 'exclude_if:same_address,true|required',
            'billing_address.province' => 'exclude_if:same_address,true|required|size:2',
            'billing_address.country_region' => 'exclude_if:same_address,true|required',
            'billing_address.postal_code' => 'exclude_if:same_address,true|required|min:5|max:5',
        ];
    }
    
    public function mount(Order $order)
    {
        $this->authorize('update', $this->order);
        
        $this->order = $order;
        $this->same_address = false;
        $this->shipping_address = $order->shippingAddress();
        $this->billing_address = $order->billingAddress();
        $this->phone = $order->phone;
        $this->note = $order->note;
        $this->fiscal_code = $order->fiscal_code;
        $this->vat = $order->vat;
        $this->addresses_confirmed = true;

        $this->email = Auth::user() ? Auth::user()->email : null;
    }

    public function updateDefaultAddress()
    {
        $validated = $this->validate([
            'shipping_address.full_name' => 'required',             
            'shipping_address.address' => 'required',              
            'shipping_address.city' => 'required',
            'shipping_address.province' => 'required|size:2',
            'shipping_address.country_region' => 'required',
            'shipping_address.postal_code' => 'required|min:5|max:5',
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

    public function copyAddress()
    {
        $this->billing_address = $this->shipping_address;
    }

    public function updateAddresses()
    {
        $this->authorize('update', $this->order);

        if($this->addresses_confirmed){
            $this->addresses_confirmed=false;
        }
        else{
            $this->validate();
            $this->fiscal_code = $this->fiscal_code ?? $this->vat;
            if($this->same_address) $this->billing_address = $this->shipping_address;
            if (Order::find($this->order->id)->canBeEdited()) {
                $this->order->update([
                    'shipping_address' => $this->shipping_address->toJson(),
                    'billing_address' => $this->billing_address->toJson(),
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'note' => $this->note,
                    'fiscal_code' => $this->fiscal_code,
                    'vat' => $this->vat,
                ]);
                $this->order->history()->create([
                    'order_status_id' => $this->order->order_status_id,
                    'description' => 'Addresses Updated',
                ]);
                $this->addresses_confirmed=true;
            }
        }
    }

    public function updateOrder($payment_id)
    {
        if(Order::find($this->order->id)->canBePaied()) {
            $pending_id = OrderStatus::where('name', 'pending')->first()->id;
            $this->order->update([
                'payment_gateway' => 'stripe',
                'payment_id' =>  $payment_id,
                'order_status_id' => $pending_id,
            ]);

            $this->order->history()->create([
                'order_status_id' => $pending_id,
                'description' => 'New Payment Intent',
            ]);

            $this->emit('orderUpdated');
        }
    }

    public function render()
    {
        return view('order.update');
    }
}
