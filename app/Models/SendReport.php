<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SendReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'report_title',
        'report_detail',
        'send_report_by_id',
        'send_report_to_id',
        'date'

    ];

    public function sendReportBy(): BelongsTo
    {
        return $this->belongsTo(SendReportBy::class);
    }

    public function sendReportTo(): BelongsTo
    {
        return $this->belongsTo(SendReportTo::class);
    }
}
