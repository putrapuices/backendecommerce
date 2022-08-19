<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
      /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'province_id', 'name'
    ];
       /**
     * cities
     *
     * @return void
     */
    public function cities()
    {
        return $this->hasMany(City::class, 'province_id');
    }
}
