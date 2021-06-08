<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GradeSystem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function collages(): BelongsTo
    {
        return $this->belongsTo(Collage::class,'uni_id','id');
    }
}
