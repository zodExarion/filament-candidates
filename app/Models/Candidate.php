<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use IbrahimBougaoua\FilamentSortOrder\Traits\SortOrder;

class Candidate extends Model
{
    use HasFactory;
    use SortOrder;

    protected $guarded = [];

    protected $casts = [
        'languages' => 'array',
        'projects' => 'array',
    ];

    protected $appends = [
        'languages_names',
        'projects_titles'
    ];

    public function languages()
    {
        return $this->hasMany(Language::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
    

    public function getLanguagesNamesAttribute()
    {
        if ($this->languages) {
            return implode(', ', Language::whereIn('id', $this->languages)->pluck('name')->toArray());
        }
        return "";
    }

    public function getProjectsTitlesAttribute()
    {
        if ($this->projects) {
            return implode(', ', array_column($this->projects, 'title'));
        }

        return "";
    }
}