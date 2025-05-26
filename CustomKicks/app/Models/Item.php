<?php

// Santiago Rodriguez
// Jacobo Restrepo

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    /**
     * ATTRIBUTES
     * $this->attributes['id'] - int - contains the item primary key (id)
     * $this->attributes['subtotal'] - int - contains the price of each item
     * $this->attributes['product_id'] - int - contains the product id
     * $this->attributes['customization_id'] - int - contains the customization id
     * $this->attributes['order_id'] - int - contains the order id
     * $this->attributes['created_at'] - timestamp - contains the item creation date
     * $this->attributes['updated_at'] - timestamp - contains the item update date
     *
     * RELATIONS
     * $this->product - BelongsTo - contains the product for this item
     * $this->order - BelongsTo - contains the order that contains this item
     * $this->customization - BelongsTo - contains the customization for this item
     */
    protected $fillable = ['subtotal', 'product_id', 'customization_id', 'order_id'];

    public static function validate($request): void
    {
        $request->validate([
            'subtotal' => 'required|integer',
            'product_id' => 'required|integer',
            'customization_id' => 'required|integer',
            'order_id' => 'required|integer',
        ]);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getSubtotal(): int
    {
        return $this->attributes['subtotal'];
    }

    public function setSubtotal(int $subtotal): void
    {
        $this->attributes['subtotal'] = $subtotal;
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function setProductId(int $productId): void
    {
        $this->attributes['product_id'] = $productId;
    }

    public function getCustomizationId(): int
    {
        return $this->attributes['customization_id'];
    }

    public function setCustomizationId(int $customizationId): void
    {
        $this->attributes['customization_id'] = $customizationId;
    }

    public function getOrderId(): int
    {
        return $this->attributes['order_id'];
    }

    public function setOrderId(int $orderId): void
    {
        $this->attributes['order_id'] = $orderId;
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'];
    }

    /**
     * Get the product for this item
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get product for this item
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Get the order that contains this item
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get order for this item
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Get the customization for this item
     */
    public function customization(): BelongsTo
    {
        return $this->belongsTo(Customization::class);
    }

    /**
     * Get customization for this item
     */
    public function getCustomization()
    {
        return $this->customization;
    }
}
