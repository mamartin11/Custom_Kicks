<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{

    protected $fillable = ['subtotal', 'product_id', 'customization_id', 'order_id'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    
    public function customization(): BelongsTo
    {
        return $this->belongsTo(Customization::class);
    }

    public function calculateSubtotal()
    {
        // return $this->product->price;
        return $this->product_price;
    }

    public function getSubtotal(): int
    {
        return $this->attributes['subtotal'];
    }

    public function setSubtotal($subtotal): void
    {
        $this->attributes['subtotal'] = $subtotal;
    }

}
