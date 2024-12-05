<?php

namespace App\Models;

use App\Http\Controllers\DevController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NivelModel extends Model
{
    use HasFactory;
    protected $table = 'niveis';

    protected $fillable = [
        'id',
        'nivel'
    ];

}
