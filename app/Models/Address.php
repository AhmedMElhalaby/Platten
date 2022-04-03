<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';
    protected $fillable = ['customer_id','recipient_name','mobile','address','type','lat','lng','map_address',];
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    const Types = [
        'Home'=>1,
        'Work'=>2
    ];

}
