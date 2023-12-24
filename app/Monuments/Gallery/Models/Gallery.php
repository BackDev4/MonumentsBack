<?php

namespace App\Monuments\Gallery\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $fillable = [
        'title',
        'image',
    ];
}
