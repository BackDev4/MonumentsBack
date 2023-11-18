<?php

namespace App\Monuments\Services\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{

    protected $guarded = ['id'];

    protected $fillable = [
        'title',
        'content',
        'image',
    ];
}
