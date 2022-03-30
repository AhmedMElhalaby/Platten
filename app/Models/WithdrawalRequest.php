<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    use HasFactory;
    protected $table = 'withdrawal_requests';
    protected $fillable = ['account_type','account_id','reject_reason','amount','bank_id','iban','status'];

    const Statuses = [
        'Pending'=>0,
        'Accepted'=>1,
        'Rejected'=>2,
        'Canceled'=>3,
    ];
    const AccountTypes = [
        'Customer'=>1,
        'Vendor'=>2,
    ];
}
