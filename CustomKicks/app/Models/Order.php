<?php
//Jacobo Restrepo
//Nicolas Hurtado


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /**
     * ATTRIBUTES
     * $this->attributes['id'] - int - contains the order primary key (id)
     * $this->attributes['total'] - int - contains the total amount of the order
     * $this->attributes['user_id'] - int - contains the user id
     * $this->attributes['details'] - array - contains the order details
     * $this->attributes['order_date'] - date - contains the order date
     * $this->attributes['created_at'] - timestamp - contains the order creation date
     * $this->attributes['updated_at'] - timestamp - contains the order update date
     * $this->attributes['shipping_type'] - string - contains the shipping type (standard/express)
     */
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'shipping_type',
        'shipping_cost',
        'tracking_number'
    ];

    public static function validate($request): void
    {
        $request->validate([
            'total' => 'required|integer',
            'order_date' => 'required|date',
            'user_id' => 'required|integer',
            'shipping_type' => 'required|string|in:standard,express'
        ]);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTotal(): float
    {
        return $this->total ?? 0.00;
    }

    public function setTotal(int $total): void
    {
        $this->attributes['total'] = $total;
    }

    public function getOrderDate(): string
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }

    public function setOrderDate(string $orderDate): void
    {
        $this->attributes['order_date'] = $orderDate;
    }

    public function setDetails(array $details): void
    {
        $this->attributes['details'] = json_encode($details);
    }

    public function getDetails(): array
    {
        return json_decode($this->attributes['details'], true) ?? [];
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getShippingType(): string
    {
        return $this->shipping_type ?? 'standard';
    }

    public function getStatus(): string
    {
        return $this->status ?? 'pending';
    }

    public function setShippingType(string $shippingType): void
    {
        if (!in_array($shippingType, ['standard', 'express'])) {
            throw new \InvalidArgumentException('El tipo de envío debe ser "standard" o "express"');
        }
        $this->attributes['shipping_type'] = $shippingType;
    }
}
