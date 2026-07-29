<?php

namespace Modules\Chat\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMaxSubscriptionEventType extends Model
{
    protected $table = 'chat_max_subscription_event_types';

    protected $fillable = [
        'event_type',
        'description',
    ];

    public function subscriptions()
    {
        return $this->hasMany(ChatMaxUserSubscription::class, 'event_type_id', 'id');
    }
}
