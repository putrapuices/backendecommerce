<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'invoice', 'customer_id', 'courier', 'courier_service', 'courier_cost', 'weight', 'name', 'phone', 'city_id', 'province_id', 'address', 'status', 'grand_total', 'snap_token'
    ];
}
