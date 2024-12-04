<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevModel extends Model
{
    use HasFactory;
    // Nome da tabela no banco de dados
    protected $table = 'devs';

    protected $fillable = [
        'nivel_id',
        'sexo',
        'data_nascimento',
        'hobby',
        'nome',
    ];

    protected $casts = [
        'id' => 'integer',
        'data_nascimento' => 'date',
    ];

    public $timestamps = false;

    public function nivel()
    {
        return $this->belongsTo(NivelModel::class, 'nivel_id');
    }
}
