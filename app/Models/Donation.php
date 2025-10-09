<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'message', 'amount', 'email', 'donation_types_id', 'status'];

    /**
     * Get the donation type that owns the donation.
     */
    public function type()
    {
        return $this->belongsTo(DonationType::class, 'donation_types_id');
    }
}