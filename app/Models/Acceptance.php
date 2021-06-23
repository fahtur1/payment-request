<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acceptance extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_acceptance';

    public $incrementing = false;

    protected $fillable = [
        'id_acceptance', 'id_request', 'id_staff'
    ];

    public function newCollection(array $models = [])
    {
        return new AcceptanceCollection($models);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'id_staff', 'id_staff');
    }

}
