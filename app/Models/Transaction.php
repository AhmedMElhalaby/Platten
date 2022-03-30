<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = ['account_type','account_id','type','amount','status','ref_type','ref_id','payment_reference'];

    const Statuses = [
        'Pending'=>0,
        'InHold'=>1,
        'Placed'=>2,
        'Failed'=>3
    ];
    const AccountTypes = [
        'App'=>0,
        'Customer'=>1,
        'Vendor'=>2,
        'Employee'=>3
    ];
    const Types = [
        'Deposit'=>1,
        'Withdraw'=>2
    ];
}
