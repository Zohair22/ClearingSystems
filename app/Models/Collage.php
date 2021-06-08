<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Collage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class,'uni_id','id');
    }

    public function grades(): HasMany
    {
        return $this->hasMany(GradeSystem::class,'uni_id','id');
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class,'uni_id','id');
    }


    public function uniSubject($id)
    {
        return Collage::where('uni_id',$id)->withMobilities()->get();
    }

    public function scopeWithMobilities(Builder $query): Builder
    {
        return $query->leftJoinSub(
            'select id as subID, sub_name, code, title, uni_id ,description ,regulation ,chr from subjects',
            'subjects',
            'uni_id',
            'collages.id',
        )->leftJoinSub(
            'select id AS subMobID, grade ,sub_id ,mobility_id from subject_mobilities',
            'subMobilities',
            'sub_id',
            'subjects.subID',
        )->leftJoinSub(
            'select id AS mobID,acceptable, doctor, teacher ,ours_id ,stu_id from mobilities',
            'mobilities',
            'mobilities.mobID',
            'subMobilities.mobility_id',
        );
    }

}
