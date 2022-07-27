<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PasswordResets extends Model
{
  use HasFactory;
  protected $table = "password_resets";
  protected $primaryKey = null;
  public $incrementing = false;
  // deactivate update_at line
  public function setUpdatedAt($value)
  {
    return NULL;
  }

  protected $fillable = ["email", "token"];

  public static function createToken($email)
  {
    $token = Str::random(100);
    PasswordResets::where("email", $email)->delete();
    return PasswordResets::create(["email" => $email, "token" => $token]);
  }
}
