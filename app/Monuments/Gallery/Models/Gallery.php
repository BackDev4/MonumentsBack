<?php

namespace App\Monuments\Gallery\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

    protected $guarded = ['id'];

    protected $fillable = [
        'title',
        'image',
    ];

}
