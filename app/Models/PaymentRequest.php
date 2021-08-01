<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_request';

    public $incrementing = false;

    protected $fillable = [
        'id_request', 'id_staff', 'tanggal_pengajuan', 'status'
    ];

    protected $hidden = [
        'id_staff'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'id_staff', 'id_staff');
    }

    public function item()
    {
        return $this->hasMany(ListItem::class, 'id_request', 'id_request');
    }

    public function acceptance()
    {
        return $this->hasMany(Acceptance::class, 'id_request', 'id_request');
    }

}
