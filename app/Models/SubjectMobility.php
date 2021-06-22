<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubjectMobility extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function mobilities(): BelongsTo
    {
        return $this->belongsTo(Mobility::class,'mobility_id','id');
    }

    public function subjects(): BelongsTo
    {
        return $this->belongsTo(Subject::class,'sub_id','id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class,'stu_id','id');
    }

}
