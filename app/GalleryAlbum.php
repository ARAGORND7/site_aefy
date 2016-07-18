<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryAlbum extends Model
{
    protected $table = 'gallery_album';

    protected $fillable = ['name', 'description', 'user_id'];
}
