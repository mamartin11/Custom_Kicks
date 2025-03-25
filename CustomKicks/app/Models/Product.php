<?php
//Miguel Angel Martinez
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * ATTRIBUTES
     * $this->attributes['id'] - int - contains the product primary key (id)
     * $this->attributes['name'] - string - contains the product name
     * $this->attributes['price'] - string - contains the product price
     * $this->attributes['description'] - int - contains the product description
     * $this->attributes['brand'] - string - contains the product brand
     * $this->attributes['size'] - float - contains the product size
     * $this->attributes['quantity'] - int - contains the product quantity
     * $this->attributes['image'] - string - contains the product image path
     * $this->attributes['created_at'] - timestamp - contains the product creation date
     * $this->attributes['updated_at'] - timestamp - contains the product last update date
     */
    public static function validate($request)
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

    public function setName($name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getPrice(): float
    {
        return $this->attributes['price'];
    }

    public function setPrice($price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription($description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getBrand(): string
    {
        return $this->attributes['brand'];
    }

    public function setBrand($brand): void
    {
        $this->attributes['brand'] = $brand;
    }

    public function getSize(): float
    {
        return $this->attributes['size'];
    }

    public function setSize($size): void
    {
        $this->attributes['size'] = $size;
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function setQuantity($quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function setImage($imagePath)
    {
        $this->attributes['image'] = $imagePath;
    }

    public function getImage()
    {
        return $this->attributes['image'];
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }
}
