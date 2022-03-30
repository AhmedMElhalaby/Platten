<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorSubscription extends Model
{
    use HasFactory;
    protected $table = 'vendors_subscriptions';
    protected $fillable = ['vendor_id','subscription_id','billing_type','price','paid','start_at','expire_at'];
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
    const BillingTypes = [
        'Monthly'=>1,
        'Yearly'=>2
    ];
}
