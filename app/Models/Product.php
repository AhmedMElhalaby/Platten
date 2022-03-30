<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['vendor_id','category_id','sub_category_id','brand_id','product_type_id','product_type_model_id','product_type_model_color_id','product_type_model_size_id','cost_price','profit_rate','sell_price','discount','status'];
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
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
    public function product_type(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }
    public function product_type_model(): BelongsTo
    {
        return $this->belongsTo(ProductTypeModel::class);
    }
    public function product_type_model_color(): BelongsTo
    {
        return $this->belongsTo(ProductTypeModelColor::class);
    }
    public function product_type_model_size(): BelongsTo
    {
        return $this->belongsTo(ProductTypeModelSize::class);
    }
}
