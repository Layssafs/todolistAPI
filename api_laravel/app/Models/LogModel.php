<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogModel extends Model
{
    use HasFactory;

    protected $table = 'logs';

    public $timestamps = true;

    protected $fillable = [
        'acao',
        'detalhe',
        'usuario_id',
        'timestamp',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
    ];
}
