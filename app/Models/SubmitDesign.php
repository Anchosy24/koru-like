<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmitDesign extends Model
{
    protected $fillable = ['title', 'description', 'file_path', 'email'];
}
