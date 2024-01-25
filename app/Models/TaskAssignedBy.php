<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskAssignedBy extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',



    ];
    protected $table = 'task_assigned_by';
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function assignTask(): HasMany
    {
        return $this->hasMany(AssignTask::class);
    }
}
