<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;//, LogsActivity;

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults();
    // }

    protected static $logName = 'country';
    static $logFillable = true;

    protected $fillable = ['id', 'name_en', 'name_ar', 'name_fr', 'nationality', 'nationality_ar', 'iso3', 'iso2', 'phonecode', 'capital',
                           'currency', 'currency_symbol', 'native', 'region', 'subregion', 'timezones', 'translations',
                           'latitude', 'longitude', 'emoji', 'emojiU', 'created_at', 'updated_at', 'flag', 'wikiDataId'];

    public function getNameAttribute()
    {
        return App::currentLocale() == 'ar' ? "{$this->name_ar}" : (App::currentLocale() == 'en' ? "{$this->name_en}" : "{$this->name_fr}");
    }

    public function name($certificateName)
    {
        return $certificateName == 'form-a-en' ? "{$this->name_name_enlt}" : ($certificateName == 'formule-a-fr' ? "{$this->name_fr}" : "{$this->name_ar}");
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
