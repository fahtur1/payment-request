<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = 'position';
    protected $primaryKey = 'id_position';
    public $timestamps = false;

    protected $fillable = [
        'nama_position',
        'id_subposition',
        'is_active'
    ];

    protected $attributes = [
        'is_active' => '1'
    ];

    public function subposition()
    {
        return $this->belongsTo(SubPosition::class, 'id_subposition', 'id_subposition');
    }
}
