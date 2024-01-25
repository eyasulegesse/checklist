<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'branch_id',
        'department_id',
        'sub_checklist_id',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    public function spoilageMaintenances(): HasMany
    {
        return $this->hasMany(SpoilageMaintenance::class);
    }

    public function breakageMaintenances(): HasMany
    {
        return $this->hasMany(BreakageMaintenance::class);
    }

    public function taskAssignedBy(): HasMany
    {
        return $this->hasMany(TaskAssignedBy::class);
    }
    public function taskAssignedTo(): HasMany
    {
        return $this->hasMany(TaskAssignedTo::class);
    }

    public function inventoryCount(): HasMany
    {
        return $this->hasMany(InventoryCount::class);
    }



    public function subChecklist(): BelongsTo
    {
        return $this->belongsTo(SubChecklist::class);
    }

    public function sendReportBy(): HasMany
    {
        return $this->hasMany(SendReportBy::class);
    }
    public function sendReportTo(): HasMany
    {
        return $this->hasMany(sendReportTo::class);
    }
    public function checklist(): HasMany
    {
        return $this->hasMany(Checklist::class);
    }
}
