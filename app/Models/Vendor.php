<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Vendor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'vendors';
    protected $fillable = ['name','email','password','mobile','nickname','company_name','maroof_company_number','maroof_tax_number','address','address_alt','postcode','country_id','city_id'];
    protected $hidden = ['password'];
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

}
