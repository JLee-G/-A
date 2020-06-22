<?php

namespace App\Http\Controllers\DataSheet;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'user_department';
    protected $fillable =   [ 
                                'id',
                                'name',
                                'created_at',
                                'updated_at'
                            ];

    
}