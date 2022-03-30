<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductType extends Model
{
    use HasFactory;
    protected $table = 'products_types';
    protected $fillable = ['category_id','sub_category_id','brand_id','name'];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
