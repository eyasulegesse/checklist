<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpoilageMaintenance extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'item_id',
        'user_id',
        'branch_id',
        'department_id',
        'quantity',
        'remark',
        'image'
    ];



    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
