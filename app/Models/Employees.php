<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table = 'employees';
    protected $fillable = [
        'first_name',
        'last_name',
        'company_id',
        'email',
        'phone'
    ];
}
