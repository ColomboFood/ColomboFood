<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CancelUnpaidOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $failed_status = OrderStatus::where('name',insensitive_like(),'payment_failed')->first();
        $cancelled_status = OrderStatus::where('name',insensitive_like(),'cancelled')->first();
        $draft_status = OrderStatus::where('name',insensitive_like(),'draft')->first();
        if($failed_status && $cancelled_status && $draft_status)
        {
            $orders = Order::where('order_status_id', $failed_status->id )
                ->whereDate('updated_at', '<=' , Carbon::now()->sub('days',2))->get();
            foreach($orders as $order)
            {
                $order->status()->associate($cancelled_status->id);
                $order->save();
                $order->history()->create([
                    'order_status' => $cancelled_status->id,
                ]);
                $order->restock();
            }

            $orders = Order::where('order_status_id', $draft_status->id)
                ->whereDate('updated_at', '<=', Carbon::now()->sub('days',7))->delete();
        }
        else
        {
            if(!$failed_status && !$cancelled_status)
                Log::error('OrderStatuses payment_failed and cancelled not found.');
            elseif(!$failed_status)
                Log::error('OrderStatus payment_failed not found.');
            else
                Log::error('OrderStatus cancelled not found.');
        }
    }
}
