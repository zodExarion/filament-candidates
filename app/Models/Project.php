<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function candidates(): BelongsTo
    {
        return $this->belongsTo(Candidate::class);
    }
}
