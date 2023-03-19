<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'SKU',
        'name_ar',
        'name_en',
        'name_fr',
        'active',
        'brand_id',
        'image',
        'category_id',
        'code',
        'description',
        'price',
        'discount',
        'store_id'
    ];

    public function getNameAttribute()
    {
        return App::currentLocale() == 'ar' ? "{$this->name_ar}" : (App::currentLocale() == 'en' ? "{$this->name_en}" : "{$this->name_fr}");
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }
    public function stores()
    {
        return $this->hasMany(Store::class);
    }
    public function company()
    {
            // return $this->hasMany(::class)->where('type', 'invoice')->first();
            // return $this->hasMany(Store::class);
    }
}
