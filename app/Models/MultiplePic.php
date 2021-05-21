<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiplePic extends Model
{
    use HasFactory;

    protected $fillable = [
        'images',
    ];
}
