<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable =[
        'cost',
        'currency'
    ];

    protected $attributes = [
        'completed' => false,
        'saved' => 0
    ];
   
}
