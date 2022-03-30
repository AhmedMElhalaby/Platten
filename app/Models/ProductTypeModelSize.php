<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductTypeModelSize extends Model
{
    use HasFactory;
    protected $table = 'products_types_models_sizes';
    protected $fillable = ['product_type_model_id','name'];
    public function product_type_model(): BelongsTo
    {
        return $this->belongsTo(ProductTypeModel::class,'product_type_model_id');
    }
}
