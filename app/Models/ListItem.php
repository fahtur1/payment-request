<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_item';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_item', 'description', 'references', 'budget_available', 'amount',
        'quantity', 'unit_of_measurement', 'estimated_unit_price',
        'project', 'account_code', 'id_request'
    ];

    protected $casts = [
        'amount' => 'integer',
        'quantity' => 'integer'
    ];

}
