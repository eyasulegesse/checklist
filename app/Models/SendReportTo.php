<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SendReportTo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',

    ];

    protected $table = 'send_report_to';

    public function sendReport(): HasMany
    {
        return $this->hasMany(SendReport::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
