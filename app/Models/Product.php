<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'category',
        'description',
        'seller_id',
        'is_approved',
        'commission_rate',
        'is_featured',
    ];

 
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
