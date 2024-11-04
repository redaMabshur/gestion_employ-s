<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;
    protected $guarded =[''];

    /**
     * Get the user that owns the Employer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }
    /**
     * Get all of the Payments for the Employer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Payments()
    {
        return $this->hasMany(Payment::class);
    }
}
