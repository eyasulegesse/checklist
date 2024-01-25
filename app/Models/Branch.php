<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'

    ];
    public function inventoryCount(): HasMany
    {
        return $this->hasMany(InventoryCount::class);
    }
    public function breakageMaintenance(): HasMany
    {
        return $this->hasMany(BreakageMaintenance::class);
    }

    public function spoilageMaintenance(): HasMany
    {
        return $this->hasMany(SpoilageMaintenance::class);
    }
    public function checklist(): HasMany
    {
        return $this->hasMany(Checklist::class);
    }
}
