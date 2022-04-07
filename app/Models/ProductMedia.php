<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductMedia extends Model
{
    use HasFactory;
    protected $table = 'products_media';
    protected $fillable = ['product_type_id','path','mime_type'];
    public function product_type(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }
    const MimeTypes = [
        'jpg'=>1,
        'jpeg'=>2,
        'png'=>1
    ];
}
