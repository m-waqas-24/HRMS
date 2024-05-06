<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = intval(str_replace(',', '', $value));
    }

    public function getPriceAttribute($value)
    {
        $formattedPrice = number_format($value, 0, '.', ',');

        $formattedPrice = str_replace(',', ',', $formattedPrice);

        return $formattedPrice;
    }

}
