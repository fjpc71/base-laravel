<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    protected $fillable = ["iso_code", "name"];
    public $timestamps = false;
    use HasFactory;

    public function users() {
        return $this->hasMany('App\Models\User');
    }
}
