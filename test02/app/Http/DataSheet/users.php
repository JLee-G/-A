<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table = 'users';
    protected $fillable =   [ 
                                'name',
                                'email',
                                'email_verified_at',
                                'password',
                                'remember_token'
                            ];

}