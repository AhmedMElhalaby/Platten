<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductTypeModel extends Model
{
    use HasFactory;
    protected $table = 'products_types_models';
    protected $fillable = ['product_type_id','name'];
    public function product_type(): BelongsTo
    {
        return $this->belongsTo(ProductType::class,'product_type_id');
    }
    public function products_types_models_colors(): HasMany
    {
        return $this->hasMany(ProductTypeModelColor::class);
    }
    public function products_types_models_sizes(): HasMany
    {
        return $this->hasMany(ProductTypeModelSize::class);
    }
}
