<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    public function software(): BelongsToMany
    {
        return $this->belongsToMany(Software::class)
            ->withPivot('quantity', 'price', 'subtotal');
    }
}
