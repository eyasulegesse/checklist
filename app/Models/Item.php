<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function spoilageMaintenances(): HasMany
    {
        return $this->hasMany(SpoilageMaintenance::class);
    }

    public function breakageMaintenances(): HasMany
    {
        return $this->hasMany(BreakageMaintenance::class);
    }
    public function inventoryCount(): HasMany
    {
        return $this->hasMany(InventoryCount::class);
    }
}
