<?php

// Miguel Angel Martinez

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    /**
     * ATTRIBUTES
     * $this->attributes['id'] - int - contains the product primary key (id)
     * $this->attributes['name'] - string - contains the product name
     * $this->attributes['price'] - float - contains the product price
     * $this->attributes['description'] - string - contains the product description
     * $this->attributes['brand'] - string - contains the product brand
     * $this->attributes['size'] - float - contains the product size
     * $this->attributes['quantity'] - int - contains the product quantity
     * $this->attributes['image'] - string - contains the product image path
     * $this->attributes['created_at'] - timestamp - contains the product creation date
     * $this->attributes['updated_at'] - timestamp - contains the product last update date
     *
     * RELATIONS
     * $this->items - HasMany - contains the items that use this product
     */
    protected $fillable = ['name', 'price', 'description', 'brand', 'size', 'quantity', 'image'];

    public static function validate($request): void
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'required|max:255',
            'brand' => 'required|max:255',
            'size' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable',
        ]);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getPrice(): float
    {
        return $this->attributes['price'];
    }

    public function setPrice(float $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getBrand(): string
    {
        return $this->attributes['brand'];
    }

    public function setBrand(string $brand): void
    {
        $this->attributes['brand'] = $brand;
    }

    public function getSize(): float
    {
        return $this->attributes['size'];
    }

    public function setSize(float $size): void
    {
        $this->attributes['size'] = $size;
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function setImage(string $imagePath): void
    {
        $this->attributes['image'] = $imagePath;
    }

    public function getImage(): string
    {
        return $this->attributes['image'];
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
     * Get items that use this product
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    /**
     * Get items for this product
     */
    public function getItems()
    {
        return $this->items;
    }
}
