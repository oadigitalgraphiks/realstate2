<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

/**
 * App\Models\Slider
 *
 * @property int $id
 * @property string|null $photo
 * @property int $published
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider whereUpdatedAt($value)
 * @mixin \Eloquent
 */

class Slider extends Model
{
    protected $table      = 'sliders';
    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $brand_translation = $this->hasMany(\App\Models\SliderTranslation::class)->where('lang', $lang)->first();
        return $brand_translation != null ? $brand_translation->$field : $this->$field;
    }

    public function slider_translations(){
      return $this->hasMany(SliderTranslation::class);
    }
}
