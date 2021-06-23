<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPosition extends Model
{
    use HasFactory;

    protected $table = 'subposition';

    public $timestamps = false;

    protected $fillable = [
        'nama_subposition',
        'allowed_to_accept_request',
        'allowed_to_input_donator'
    ];

    protected $attributes = [
        'allowed_to_accept_request' => 0,
        'allowed_to_input_donator' => 0
    ];

    protected $casts = [
        'allowed_to_accept_request' => 'boolean',
        'allowed_to_input_donator' => 'boolean'
    ];

}
