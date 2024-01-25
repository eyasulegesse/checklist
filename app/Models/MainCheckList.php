<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MainCheckList extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];


    public function subChecklist(): HasMany
    {
        return $this->hasMany(SubChecklist::class);
    }
    public function checklist(): HasMany
    {
        return $this->hasMany(Checklist::class);
    }
}
