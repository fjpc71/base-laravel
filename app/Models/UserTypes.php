<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTypes extends Model
{
    protected $fillable = ["name", "class"];
    public $timestamps = false;
    use HasFactory;

    public function users() {
        return $this->hasMany('App\Models\User');
    }
}