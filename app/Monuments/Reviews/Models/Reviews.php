<?php

namespace App\Monuments\Reviews\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'content',
    ];
}
