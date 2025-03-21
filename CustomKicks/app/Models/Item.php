<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model {
    protected $table = 'item';
    protected $fillable = ['subtotal', 'product_id', 'customization_id', 'order_id'];
    // temporal attribute to test
    public $product_price;

    //relations

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class);
    }

    public function customization(): BelongsTo {
        return $this->belongsTo(Customization::class);
    }

    
    public function calculateSubtotal() {
        //return $this->product->price;
        return $this->product_price;
    }
    
    //getters & setters

    public function getSubtotal(): int
    {
        return $this->attributes['subtotal'];
    }

    public function setSubtotal($subtotal) : void
    {
        $this->attributes['subtotal']=$subtotal;
    }

    public function getProductId(): int {
        return $this->attributes['product_id'];
    }

    public function setProductId($product_id): void {
        $this->attributes['product_id'] = $product_id;
    }

    public function getCustomizationId(): ?int {
        return $this->attributes['customization_id'];
    }

    public function setCustomizationId(?int $customization_id): void {
        $this->attributes['customization_id'] = $customization_id;
    }

    public function getOrderId(): int {
        return $this->attributes['order_id'];
    }

    public function setOrderId(int $order_id): void {
        $this->attributes['order_id'] = $order_id;
    }


}