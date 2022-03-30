<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BrandSubCategory extends Model
{
    use HasFactory;
    protected $table = 'brands_sub_categories';
    protected $fillable = ['sub_category_id','brand_id'];
    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
