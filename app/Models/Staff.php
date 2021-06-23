<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_staff';

    public $incrementing = false;

    protected $fillable = [
        'id_staff',
        'nama_staff',
        'email_staff',
        'tanggal_masuk',
        'tanggal_lahir',
        'password',
        'amount_pr_requested',
        'id_role',
        'id_position'
    ];

    protected $hidden = [
        'password', 'id_role', 'id_position'
    ];

    protected $attributes = [
        'amount_pr_requested' => '0'
    ];

    protected $casts = [
        'amount_pr_requested' => 'integer'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'id_position', 'id_position');
    }

}
