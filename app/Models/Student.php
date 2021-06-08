<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function confirmation(): HasOne
    {
        return $this->HasOne(Confirmation::class,'stu_id','id');
    }

    public function collages(): BelongsTo
    {
        return $this->belongsTo(Collage::class, 'uni_id', 'id');
    }
}
