<?php

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
     * $this->attributes['order_date'] - date - contains the order date
     * $this->attributes['created_at'] - timestamp - contains the order creation date
     * $this->attributes['updated_at'] - timestamp - contains the order update date
     */

    protected $fillable = ['total', 'order_date', 'user_id', 'item_ids'];
    public static function validate($request)
    {
        $request->validate([
            'total' => 'required|integer',
            'order_date' => 'required|date',
            'user_id' => 'required|integer',
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

    public function setItemIds(array $itemIds): void
    {
        $this->attributes['item_ids'] = json_encode($itemIds);
    }
 
    public function getItemIds(): array
    {
        return json_decode($this->attributes['item_ids'], true) ?? [];
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt()
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
}
