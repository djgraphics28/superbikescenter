<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the monthlyDue that owns the PaymentHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function monthlyDue(): BelongsTo
    {
        return $this->belongsTo(MonthlyDue::class, 'monthly_due_id', 'id');
    }
}
