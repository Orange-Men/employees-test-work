<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;

    public const STATUS_RATE = 0;
    public const STATUS_HOURLY_RATE = 1;

    public const DEFAULT_LIMIT = 10;
    public const DEFAULT_WORK_HOURS = 160;

    protected $fillable = [
        'name',
        'birthday',
        'position',
        'payment_type',
        'payment',
        'department_id',
    ];

    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
