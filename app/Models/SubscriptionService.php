<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubscriptionService extends Model
{
    use HasFactory;
    protected $table = 'subscriptions_services';
    protected $fillable = ['subscription_id','name','color','checked'];
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
