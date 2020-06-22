<?php

namespace App\Http\Controllers\DataSheet;

use Illuminate\Database\Eloquent\Model;

class ClassTable extends Model
{
    protected $table = 'user_class';
    protected $fillable =   [ 
                                'id',
                                'department_id',
                                'name',
                                'created_at',
                                'updated_at'
                            ];

    
}