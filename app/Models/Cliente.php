<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable =[
        'id',
        'nome',
        'telefone',
        'telefone2',
        'cpf',
        'email',
        'endereco',
        'data',
        'data_exclusao',
        'tipo'
    ];
}
