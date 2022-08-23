<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    protected $table = 'advertisements';
    protected $fillable = ['name','image','url','type'];
    const Types = [
        'Slider'=>1,
        'Advertisement'=>2
    ];

}
