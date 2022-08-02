<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';
    protected $fillable = ['category_id','name'];
    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class,'brands_sub_categories');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
