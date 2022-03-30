<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductTypeModel extends Model
{
    use HasFactory;
    protected $table = 'products_types_models';
    protected $fillable = ['product_type_id','name'];
    public function product_type(): BelongsTo
    {
        return $this->belongsTo(ProductType::class,'product_type_id');
    }
}
