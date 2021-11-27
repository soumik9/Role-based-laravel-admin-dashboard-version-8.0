<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;


class CmsPage extends Model
{
    use HasFactory, Loggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'cms_category_id',
        'description',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function cmscategory()
    {
        return $this->belongsTo(CmsCategory::class,'cms_category_id');
    }

}
