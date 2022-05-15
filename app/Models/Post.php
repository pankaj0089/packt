<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function author() {
      return $this->belongsTo('App\Models\Author');
    }

    public function getUpdatedAtAttribute($date) {
      return date('d-m-Y H:i', strtotime($date));
    }
}
