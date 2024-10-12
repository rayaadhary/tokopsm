<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = ['product_id', 'image'];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
