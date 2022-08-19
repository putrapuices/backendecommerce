<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
      /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'rating', 'review', 'product_id', 'order_id', 'customer_id'
    ];
}
