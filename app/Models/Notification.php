<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $fillable = ['target_type','target_id','ref_type','ref_id','title','body','type','read_at'];
    const TargetTypes = [
        'Customer'=>1,
        'Vendor'=>2,
        'Employee'=>3
    ];
    const RefTypes = [
        'General'=>1,
        'Order'=>2
    ];
}
