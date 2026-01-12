<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'description',
        'price',
        'is_active',
        'category_id',
        'img',
        'is_active',
    ];

    public function category(){
        $this->belongsTo(Category::class, 'category_id');
    }

    public function order_items(){
        $this->hasMany(OrderItem::class);
    }
}
