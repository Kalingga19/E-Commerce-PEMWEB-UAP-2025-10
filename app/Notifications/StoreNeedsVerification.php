<?php
namespace App\Notifications;

use App\Models\Store;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StoreNeedsVerification extends Notification
{
    use Queueable;

    public $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function via($notifiable)
    {
        return ['database']; // pakai DB, modern & umum
    }

    public function toDatabase($notifiable)
    {
        return [
            'store_id'   => $this->store->id,
            'store_name' => $this->store->name,
            'user_name'  => $this->store->user->name,
        ];
    }
}
