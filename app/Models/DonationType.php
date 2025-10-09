<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonationType extends Model
{
    use HasFactory;

    protected $fillable = ['project', 'type', 'summary', 'description', 'amount', 'target'];

    /**
     * Get the donations for the donation type.
     */
    public function donations()
    {
        return $this->hasMany(Donation::class, 'donation_types_id');
    }
}