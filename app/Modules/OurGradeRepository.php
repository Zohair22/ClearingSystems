<?php


namespace App\Modules;


use App\Models\Collage;
use App\Models\GradeSystem;
use App\Models\OurGrade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class OurGradeRepository
{
    private OurGrade $ourGrade;

    public function __construct()
    {
        $this->ourGrade = new OurGrade();
    }

    public function index(): array
    {
        $grades = OurGrade::all();
        return compact('grades');
    }

    public function store($request)
    {
        $data = $request->validate([
            'grade' => ['required'],
            'from' => ['required'],
            'to' => ['required'],
        ]);
        $grade = $data['grade'];
        $from = $data['from'];
        $to = $data['to'];

        $request->validate([
            'code'=> Rule::unique('our_grades')->where(function ($query) use ($grade, $from, $to,$request) {
                return $query
                    ->where('grade',$grade)
                    ->where('from',$from)
                    ->where('to',$to);
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
                OurGrade::create($ins);
            }
        }
    }

    public function edit($id)
    {
        return OurGrade::findOrFail($id);
    }

    public function update($id,$request)
    {
        $data = request()->validate([
            'grade' => ['required'],
            'from' => ['required'],
            'to' => ['required'],
        ]);
        $system = OurGrade::findOrFail($id);
        $grade = $data['grade'];
        $from = $data['from'];
        $to = $data['to'];

        $request->validate([
            'code'=> Rule::unique('our_grades')->ignore($id)->where(function ($query) use ($grade, $from, $to,$request) {
                return $query
                    ->where('grade',$grade)
                    ->where('from',$from)
                    ->where('to',$to);
            }) ,

        ]);
        $system->update($data);
    }

    public function destroy(int $id)
    {
        $system = OurGrade::findOrFail($id);
        return $system->delete();
    }

}
