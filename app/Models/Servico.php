<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;
    protected $table = 'servico';
    protected $primaryKey = 'id_ordem';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable =[
        'id_ordem',
        'id_cliente',
        'obs',
        'tipo',
        'tecnico',
        'preco',
        'situacao',
        'data_entrada',
        'data_retirada',
        'data_exclusao'
    ];
    public function cliente(){
      return $this->belongsTo("App\Models\Cliente", 'id_cliente');
    }
}
