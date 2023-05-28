<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The products that belong to the order
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['quantity', 'total_price'])
            ->withTimestamps();
    }

    /**
     * get the total price products that belong to the order
     *
     * @return BelongsToMany
     */
    public function totalPriceProductsMerchant(): BelongsToMany
    {
        return $this->products();
    }
}
