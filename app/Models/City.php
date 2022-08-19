<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
     /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'province_id', 'city_id', 'name'
    ];
    /**
     * province
     *
     * @return void
     */
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
}
