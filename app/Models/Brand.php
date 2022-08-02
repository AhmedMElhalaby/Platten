<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $fillable = ['name'];
    public function brand_sub_categories(): HasMany
    {
        return $this->hasMany(BrandSubCategory::class,'brand_id');
    }

    public function sub_categories(): BelongsToMany
    {
        return $this->belongsToMany(SubCategory::class,'brands_sub_categories');
    }
}
