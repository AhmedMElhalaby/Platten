<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['customer_id','vendor_id','discount_id','discount_amount','cost','amount','total_amount','recipient_name','mobile','address','lat','lng','map_address','status'];
    const Statuses = [
        'Pending'=>0,
        'Accepted'=>1,
        'Paid'=>2,
        'InProgress'=>3,
        'Finished'=>4,
        'Canceled'=>5,
        'Rejected'=>6,
        'NotReceived'=>7,
        'NotDelivered'=>8,
    ];
    const StatusesStr = [
        0=>'Pending',
        1=>'Accepted',
        2=>'Paid',
        3=>'InProgress',
        4=>'Finished',
        5=>'Canceled',
        6=>'Rejected',
        7=>'NotReceived',
        8=>'NotDelivered',
    ];
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }
    public function orders_products(): HasMany
    {
        return $this->hasMany(OrderProduct::class,'order_id');
    }
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class,'order_id');
    }
}
