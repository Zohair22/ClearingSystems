<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mobility extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class,'subject_mobilities','mobility_id','sub_id');
    }

    public function subjectMobilities(): HasMany
    {
        return $this->hasMany(SubjectMobility::class,'mobility_id','id');
    }

    public function confirmation(): BelongsTo
    {
        return $this->belongsTo(Confirmation::class,'confirm_id','id');
    }

    public function ours(): BelongsTo
    {
        return $this->belongsTo(OurSubject::class,'ours_id','id');
    }
}
