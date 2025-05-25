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
     * $this->attributes['id'] - int - contains the order primary key (id)
     * $this->attributes['subtotal'] - int - contains the price of each item
     * $this->attributes['product_id'] - int - contains the product id
     * $this->attributes['customization_id'] - int - contains the customization id
     * $this->attributes['created_at'] - timestamp - contains the item creation date
     * $this->attributes['updated_at'] - timestamp - contains the item update date
     */
    protected $fillable = ['subtotal', 'product_id', 'customization_id', 'order_id'];

    public static function validations($request)
    {
        $request->validate([
            'subtotal' => 'required|integer',
            'product_id' => 'required|integer',
            'customization_id' => 'required|integer',
            'order_id' => 'required|integer',
        ]);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function customization(): BelongsTo
    {
        return $this->belongsTo(Customization::class);
    }

    public function getSubtotal(): int
    {
        return $this->attributes['subtotal'];
    }

    public function setSubtotal($subtotal): void
    {
        $this->attributes['subtotal'] = $subtotal;
    }

    public function createdAt()
    {
        return $this->attributes['created_at'];
    }

    public function updatedAt()
    {
        return $this->attributes['updated_at'];
    }
}
