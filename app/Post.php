<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Post extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $table = 'posts';
    protected $fillable = ['title','content'];
    /*
     *  add use Spatie\MediaLibrary\Models\Media;
     *  на лету изменить изображение на более мелкий размер
     *  конвертация изображении
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(250)->height(250);
        $this->addMediaConversion('origin')->width(1920)->height(1080);
    }
    /*
     *
     */

}
