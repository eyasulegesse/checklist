<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checklist extends Model
{
    use HasFactory;
    protected $fillable = [
        'branch_id',
        'date',
        'department_id',
        'main_check_list_id',
        'sub_checklist_id',
        'checklist_task_id',
        'user_id'
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    public function mainCheckList(): BelongsTo
    {
        return $this->belongsTo(MainCheckList::class);
    }
    public function subChecklist(): BelongsTo
    {
        return $this->belongsTo(SubChecklist::class);
    }
    public function checklistTask(): BelongsTo
    {
        return $this->belongsTo(ChecklistTask::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
