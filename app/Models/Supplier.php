<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;
    static $logFillable = true;
    protected static $logName = 'customer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_ar',
        'name_lt',
        'address_ar',
        'address_lt',
        'mobile',
        'email',
        'tel',
        'city_id',
        'company_id',
    ];

    public function getNameAttribute()
    {
        return App::currentLocale() == 'ar' ? "{$this->name_ar}" : "{$this->name_lt}";
    }

    public function getAddressAttribute()
    {
        return App::currentLocale() == 'ar' ? "{$this->address_ar}" : "{$this->address_lt}";
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
