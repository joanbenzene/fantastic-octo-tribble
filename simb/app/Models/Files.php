<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'passport',
        'carte'
    ];

    protected $primaryKey = 'id';

    protected $table = 'files';
}
