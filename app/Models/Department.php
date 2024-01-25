<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'branch_id'
    ];
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
    public function reportType(): HasMany
    {
        return $this->hasMany(ReportType::class);
    }
    public function checklist(): HasMany
    {
        return $this->hasMany(Checklist::class);
    }

    public function breakageMaintenance(): HasMany
    {
        return $this->hasMany(BreakageMaintenance::class);
    }

    public function spoilageMaintenance(): HasMany
    {
        return $this->hasMany(SpoilageMaintenance::class);
    }
}
