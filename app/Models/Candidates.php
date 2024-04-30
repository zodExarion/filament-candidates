<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use IbrahimBougaoua\FilamentSortOrder\Traits\SortOrder;

class Candidates extends Model
{
    use HasFactory;
    use SortOrder;

    protected $guarded = [];

    protected $casts = [
        'languages' => 'array',
    ];

    public function languages(){
        return $this->hasMany(Language::class);
    }
}
