<?php

// Nicolas Hurtado A

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customization extends Model
{
    use HasFactory;
    /**
     * ATTRIBUTES
     * $this->attributes['id'] - int - contains the customization primary key (id)
     * $this->attributes['color'] - string - contains the color type
     * $this->attributes['design'] - string - contains the design type
     * $this->attributes['pattern'] - string - contains the pattern type
     * $this->attributes['image'] - string - contains the image path
     * $this->attributes['created_at'] - timestamp - contains the create date
     * $this->attributes['updated_at'] - timestamp - contains the update date
     *
     * RELATIONS
     * $this->items - HasMany - contains the items that use this customization
     */
    protected $fillable = ['color', 'design', 'pattern', 'image'];

    public static function validate($request): void
    {
        $request->validate([
            'color' => 'required|string',
            'design' => 'required|string',
            'pattern' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getColor(): string
    {
        return $this->attributes['color'];
    }

    public function setColor(string $color): void
    {
        $this->attributes['color'] = $color;
    }

    public function getDesign(): string
    {
        return $this->attributes['design'];
    }

    public function setDesign(string $design): void
    {
        $this->attributes['design'] = $design;
    }

    public function getPattern(): string
    {
        return $this->attributes['pattern'];
    }

    public function setPattern(string $pattern): void
    {
        $this->attributes['pattern'] = $pattern;
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
     * Get items that use this customization
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'customization_id');
    }

    /**
     * Get items for this customization
     */
    public function getItems()
    {
        return $this->items;
    }
}
