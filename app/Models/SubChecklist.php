<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubChecklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'main_check_list_id'
    ];

    public function mainCheckList(): BelongsTo
    {
        return $this->belongsTo(MainCheckList::class);
    }


    public function checklistTask(): HasMany
    {
        return $this->hasMany(ChecklistTask::class);
    }
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function checklist(): HasMany
    {
        return $this->hasMany(Checklist::class);
    }
}
