<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory, SoftDeletes;//, LogsActivity;

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults();
    // }

    static $logFillable = true;
    protected static $logName = 'state';
    protected $fillable = [
        'name',
        'name_ar',
        'name_en',
        'name_fr',
        'country_code',
        'fips_code',
        'iso2',
        'latitude',
        'longitude',
        'flag',
        'wikiDataId',
        'country_id',
    ];

    public function getNameAttribute()
    {
        return App::currentLocale() == 'ar' && !empty($this->name_ar) ?
               "{$this->name_ar}" : (App::currentLocale() == 'en' || App::currentLocale() == 'ar' ? "{$this->name_en}" : "{$this->name_fr}");
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
