<?php


namespace App\Modules;

use App\Models\Collage;
use App\Models\GradeSystem;
use Illuminate\Validation\Rule;

class GradingSystemRepository
{
    private GradeSystem $gradeSystem;

    public function __construct()
    {
        $this->gradeSystem = new GradeSystem();
    }

    public function index($id)
    {
        return Collage::findOrFail($id)->load('grades');
    }


    public function store($data,$request)
    {
        $grade = $data['grade'];
        $from = $data['from'];
        $to = $data['to'];
        $uni_id = $data['uni_id'];

        $request->validate([
            'code'=> Rule::unique('subjects')->where(function ($query) use ($grade, $from, $to, $uni_id,$request) {
                return $query
                    ->where('grade',$grade)
                    ->where('from',$from)
                    ->where('to',$to)
                    ->where('uni_id',$uni_id);
            }) ,

        ]);

        $insert = array();

        if (!empty($from)) {
            foreach ($data['grade'] as $key => $grade) {
                $insert[$key]['grade'] = $grade;
            }
            foreach ($data['from'] as $key => $from) {
                $insert[$key]['from'] = $from;
            }
            foreach ($data['to'] as $key => $to) {
                $insert[$key]['to'] = $to;
                $insert[$key]['uni_id'] = $data['uni_id'];
            }

            foreach ($insert as $ins) {
                GradeSystem::create($ins);
            }
        }
    }


    public function edit($id)
    {
        return GradeSystem::findOrFail($id);
    }


    public function update($id,$data,$request)
    {
        $system = GradeSystem::findOrFail($id);
        $grade = $data['grade'];
        $uni_id = $data['uni_id'];

        $request->validate([
            'code'=> Rule::unique('subjects')->where(function ($query) use ($grade, $uni_id, $request) {
                return $query
                    ->where('grade',$grade)
                    ->where('uni_id',$uni_id);
            }) ,

        ]);

        if ($system->update($data)){

            return $uni_id;
        }else {
            return false;
        }
    }


    public function destroy(int $id)
    {
        $system = GradeSystem::findOrFail($id);
        return $system->delete();
    }

}
