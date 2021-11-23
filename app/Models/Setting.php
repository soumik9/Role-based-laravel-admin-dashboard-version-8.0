<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;


class Setting extends Model
{
    use HasFactory, Loggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_title',
        'website_logo_dark',
        'website_logo_light',
        'website_logo_small',
        'website_favicon',
        'meta_title',
        'meta_description',
        'meta_tag',
        'currency_id',
        'address',
        'phone',
        'email',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'github',
    ];

    public function currency()
    {
        return $this->belongsTo(currency::class, 'currency_id');
    }

}
