<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Customization extends Model  
{
    /**
     * LUMI USER ATTRIBUTES
     * $this->attributes['id'] - int - contains the customization primary key (id)
     * $this->attributes['color'] - string - contains the color
     * $this->attributes['design'] - string - contains the design type
     * $this->attributes['pattern'] - string - contains the pattern type
     * $this->attributes['item'] - int - contains the item id
     * $this->attributes['created_at'] - timestamp - contains the creaate date
     * $this->attributes['updated_at'] - timestamp - contains the update date
     */

    protected $fillable = ['color', 'design', 'pattern'];

    public static function validations($request)
{
    $request->validate([
        'color' => 'required|string',
        'design' => 'required|string',
        'pattern' => 'required|string',
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

    public function item() {
        #return $this->belongsTo(Item::class);
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
