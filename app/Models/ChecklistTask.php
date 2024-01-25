<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChecklistTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'task',
        'sub_checklist_id'

    ];


    public function subChecklist(): BelongsTo
    {
        return $this->belongsTo(SubChecklist::class);
    }
    public function checklist(): HasMany
    {
        return $this->hasMany(Checklist::class);
    }
}
