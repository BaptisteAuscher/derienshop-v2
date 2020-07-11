<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function colors(){
        return $this->hasMany(Color::class);
    }

    public function presentPrice(){
        return money_format('%.2i€', $this->price /100);
    }
}
