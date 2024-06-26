<?php

namespace App\Models;

use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inquiry extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    /**
     * Get the province that owns the Inquiry
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }

    /**
     * Get the city that owns the Inquiry
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }

     /**
     * Get the barangay that owns the Inquiry
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function barangay(): BelongsTo
    {
        return $this->belongsTo(Barangay::class, 'barangay', 'id');
    }
}
