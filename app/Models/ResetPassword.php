<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResetPassword extends Model
{
    use HasFactory;
    protected $table = 'reset_passwords';
    protected $fillable = ['ref_id','ref_type','code'];
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class,'ref_id');
    }
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class,'ref_id');
    }
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class,'ref_id');
    }
    const RefTypes = [
        'Customer'=>1,
        'Vendor'=>2,
        'Employee'=>3
    ];

}
