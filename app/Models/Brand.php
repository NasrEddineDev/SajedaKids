<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected static $logName = 'category';
    static $logFillable = true;
    protected $fillable = [
        'number',
        'name_en',
        'name_ar',
        'name_fr',
        'description_ar',
        'description_en',
        'description_fr',
        'active',
    ];

    public function getNameAttribute()
    {
        return App::currentLocale() == 'ar' ? "{$this->name_ar}" : (App::currentLocale() == 'en' ? "{$this->name_en}" : "{$this->name_fr}");
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
