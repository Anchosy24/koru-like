<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundProject extends Model
{
    protected $fillable = ['title', 'description', 'amount', 'email'];
}