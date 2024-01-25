<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssignTask extends Model
{
    use HasFactory;
    protected $fillable = [
        'task',
        'date',
        'status',
        'task_assigned_by_id',
        'task_assigned_to_id'


    ];



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function taskAssignedBy(): BelongsTo
    {
        return $this->belongsTo(TaskAssignedBy::class);
    }
    public function taskAssignedTo(): BelongsTo
    {
        return $this->belongsTo(TaskAssignedTo::class);
    }
}
