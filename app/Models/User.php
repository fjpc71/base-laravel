<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nif',
        'telephone',
        'username',
        'access',
        'user_types_id',
        'lang_id',
        'country_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function routes()
    {
        $prefix = [];

        switch ($this->type->slug) {
            case 'admin':
                
                $prefix['main'] = [
                    [
                        "name" => "Inicio",
                        "route" => "/private/home",
                        "icon" => "icon-home"
                    ],
                    [
                        "name" => "Configuración",
                        "route" => "/private/users/lists",
                        "icon" => "icon-config",
                    ]
                ];
                break;
            
            
        }

        return $prefix;
    }

    public function getDetails()
    {
        return $this->type->class::where("users_id", $this->getKey())->first();
    }

    public function details()
    {
        return $this->belongsTo($this->type->class, "users_id");
    }

    public function type()
    {
        return $this->belongsTo(UserTypes::class, "user_types_id");
    }

    public function lang()
    {
        return $this->belongsTo(Lang::class, "lang_id");
    }

    public function country()
    {
        return $this->belongsTo(Country::class, "country_id");
    }
}
