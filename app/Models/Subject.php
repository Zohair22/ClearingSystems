<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subjectMobilities(): HasMany
    {
        return $this->hasMany(SubjectMobility::class,'sub_id');
    }

    public function collages(): BelongsTo
    {
        return $this->belongsTo(Collage::class,'uni_id','id');
    }

}
