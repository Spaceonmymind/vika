<?php

namespace Modules\Chat\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int|null $chat_id
 * @property int|null $user_id
 * @property int|null $event_type_id
 * @property int|null $weather_subscription_id
 * @property-read ChatMaxWeatherSubscription|null $weather_subscription
 */
class ChatMaxUserSubscription extends Model
{
    use SoftDeletes;

    protected $table = 'chat_max_user_subscriptions';

    protected $fillable = [
        'chat_id',
        'user_id',
        'event_type_id',
        'weather_subscription_id'
    ];

    protected $casts = [
        'chat_id' => 'int',
        'user_id' => 'int',
        'event_type_id' => 'int',
        'weather_subscription_id' => 'int',
    ];

    protected static function booted(): void
    {
        static::deleting(function ($subscription) {
            if ($subscription->isForceDeleting() && $subscription->weather_subscription) {
                $subscription->weather_subscription->forceDelete();
            } elseif ($subscription->weather_subscription) {
                $subscription->weather_subscription->delete();
            }
        });
    }

    public function event_type(): BelongsTo
    {
        return $this->belongsTo(ChatMaxSubscriptionEventType::class, 'event_type_id');
    }

    /**
     * @return BelongsTo<ChatMaxWeatherSubscription, $this>
     */
    public function weather_subscription(): BelongsTo
    {
        return $this->belongsTo(ChatMaxWeatherSubscription::class, 'weather_subscription_id');
    }
}
