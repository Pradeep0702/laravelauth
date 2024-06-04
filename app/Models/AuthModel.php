<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AuthModel extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "register_users";

    protected $fillable = [
        'name',
        'email',
        'mobile_number',
    ];

    public function scopeEmailCheck($query,$email){
        return $query->where('email',$email);
    }


}
