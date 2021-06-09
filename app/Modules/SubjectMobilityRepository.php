<?php


namespace App\Modules;


use App\Models\Confirmation;
use App\Models\Mobility;
use App\Models\Student;
use App\Models\SubjectMobility;
use Illuminate\Http\Request;

class SubjectMobilityRepository
{
    private SubjectMobility $subjectMobility;

    public function __construct()
    {
        $this->subjectMobility = new SubjectMobility();
    }

    public function store($data)
    {
        $data['stu_id'] = request('stu_id');
        $student = Student::findOrFail(request('stu_id'));

        $inserts = array();
        foreach ($data['sub_id'] as  $key =>$sub_id)
        {
            $inserts[$key]['sub_id'] = $sub_id;
        }
        foreach ($data['grade'] as  $key =>$grade)
        {
            $inserts[$key]['grade'] = $grade;
            $inserts[$key]['stu_id'] = $data['stu_id'];
        }

        if (isset($student->confirmation))
        {
            $confirm_id = $student->confirmation->id;
        }else{
            $confirm_id = Confirmation::create([
                'admin'=>1,
                'stu_id'=>$data['stu_id']
            ])->id;
        }
        $id = Mobility::create([
            'ours_id'=>$data['ours_id'],
            'confirm_id'=>$confirm_id,
            'teacher'=>$data['teacher'],
            'doctor'=>$data['doctor'],
        ])->id;

        foreach ($inserts as $insert){
            $insert['mobility_id'] = $id;
            SubjectMobility::create($insert);
        }
    }

    public function show($id): array
    {
        $student = Student::findOrFail($id);
        return compact('student');
    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        $mobility = Mobility::findOrFail($id);

        $data['ours_id'] = $mobility->ours_id;
        $data['doctor'] = $mobility->doctor;

        $mobility_id = Mobility::create([
            "ours_id" => $mobility->ours_id,
            "doctor" => $mobility->doctor,
            "teacher" => $data["teacher"],
        ])->id;

        $insert = array();

        foreach ($data['sub_id'] as $key => $sub_id) {
            $insert[$key]['sub_id'] = $sub_id;
        }
        foreach ($data['grade'] as $key => $grade) {
            $insert[$key]['grade'] = $grade;
            $insert[$key]['mobility_id'] = $mobility_id;
        }

        foreach ($insert as $ins){

            SubjectMobility::create([
                'grade' => $ins['grade'],
                'sub_id' => $ins['sub_id'],
                'mobility_id' => $ins['mobility_id'],
            ]);
        }
    }

    public function destroy($id)
    {
        $mobility = Mobility::findOrFail($id);
        $mobility->delete();
    }

}
