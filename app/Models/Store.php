<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_lt',
        'code',
        'domain',
        'description',
        'active',
        'address_ar',
        'address_lt',
        'company_id',
        'city_id',
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'store_products', 'store_id', 'product_id')
        ->withPivot('quantity', 'description')->using(StoreProduct::class)
        ->withTimestamps();
    }


}
