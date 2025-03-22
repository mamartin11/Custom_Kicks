<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * ATTRIBUTES
     * $this->attributes['id'] - int - contains the order primary key (id)
     * $this->attributes['total'] - int - contains the total amount of the order
     * $this->attributes['order_date'] - date - contains the order date
     * $this->attributes['created_at'] - timestamp - contains the order creation date
     * $this->attributes['updated_at'] - timestamp - contains the order update date
     */
    public static function validate($request)
    {
        $request->validate([
            'total' => 'required|integer',
            'order_date' => 'required|date',
        ]);
    }

    public function getTotal(): int
    {
        return $this->attributes['total'];
    }

    public function setTotal(int $total): void
    {
        $this->attributes['total'] = $total;
    }

    public function getOrderDate(): string
    {
        return $this->attributes['order_date']
            ? date('Y-m-d', strtotime($this->attributes['order_date']))
            : null;

    }

    public function setOrderDate(string $orderDate): void
    {
        $this->attributes['order_date'] = $orderDate;
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function item()
    {
        // return $this->hasMany(Item::class);
    }

    public function user()
    {
        // return $this->belongsTo(User::class);
    }
}
