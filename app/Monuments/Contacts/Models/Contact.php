<?php

namespace App\Monuments\Contacts\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $guarded = ['id'];

    protected $fillable = [
        'type',
        'data',
    ];

}
