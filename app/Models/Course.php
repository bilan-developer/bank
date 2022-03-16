<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['bank_id', 'name', 'code', 'rate', 'exchange_date'];
}
