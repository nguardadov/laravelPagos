<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $primaryKey= 'iso';
    protected $incrementing = false;

    protected $fillable = [
        'iso'
    ];
}
