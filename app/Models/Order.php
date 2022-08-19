<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id', 'product_id', 'qty', 'price'
    ];
      /**
     * reviews
     *
     * @return void
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
     /**
     * product
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
