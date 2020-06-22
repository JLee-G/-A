<?php

namespace App\Http\Controllers\DataSheet;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable =   [
                                'id',
                                'name',
                                'Competence',
                                'password'
                            ];
    // public $timestamps = false;
}