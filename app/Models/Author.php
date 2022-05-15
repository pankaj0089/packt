<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function posts() {
      return $this->hasMany('App\Models\Post');
    }

    public function country() {
      return $this->belongsTo('App\Models\Country');
    }

}
