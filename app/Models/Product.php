<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'sku',
        'name',
        'category_id',
        'supplier_id',
        'purchase_price',
        'selling_price',
        'current_stock',
        'minimum_stock',
        'description',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function incomingStock(): HasMany
    {
        return $this->hasMany(IncomingStock::class);
    }

    public function outgoingStock(): HasMany
    {
        return $this->hasMany(OutgoingStock::class);
    }
}
