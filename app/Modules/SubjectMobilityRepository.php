<?php


namespace App\Modules;

use App\Models\Confirmation;
use App\Models\GradeSystem;
use App\Models\Mobility;
use App\Models\OurGrade;
use App\Models\OurSubject;
use App\Models\Student;
use App\Models\SubjectMobility;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectMobilityRepository
{

    /**
     * @param $id
     * @return array
     */
    public function all($id): array
    {
        $student = Student::findOrFail($id);
        $ours = OurSubject::all();
        $users = User::all();
        return compact('student','ours','users');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'stu_id' => 'required',
            'sub_id' => 'required',
            'mobility_id' => '',
            'ours_id' => 'required',
            'doctor' => 'required',
            'admin' => '',
            'teacher' => 'required',
            'confirm_id' => '',
            'grade' => 'required',
        ]);
        $data['stu_id'] = request('stu_id');
        $student = Student::findOrFail(request('stu_id'));
        $confirmation = Confirmation::findOrFail($student->confirmation->id);
        $subMobs = SubjectMobility::where('sub_id',$data['sub_id'])->get();
        $grades = GradeSystem::where('grade',$data['grade'])->get();

        $stu_id = $data['stu_id'];
        $sub_id = $data['sub_id'];
        $request->validate([
            'sub_id'=> Rule::unique('subject_mobilities')->where(function ($query) use ($sub_id, $stu_id,$request) {
                return $query
                    ->where('sub_id',$sub_id)
                    ->where('stu_id',$stu_id);
            }) ,
        ]);

        if (isset($student->confirmation))
        {
            $confirmation->update([
                'admin'=>1,
                'confirmed'=>0,
                'stu_id'=>$student->id
            ]);
            $confirm_id = $student->confirmation->id;
        }else{
            $confirm_id = Confirmation::create([
                'admin'=>1,
                'confirmed'=>0,
                'stu_id'=>$data['stu_id']
            ])->id;
        }

        if (SubjectMobility::where('sub_id',$data['sub_id'])->get()->count() >= 1)
        {
            foreach ($subMobs as $subMob){
                $Mob = Mobility::findOrFail($subMob->mobility_id);
                if ($Mob->ours_id == $data['ours_id']) {
                    foreach ($grades as $grade) {
                        if($grade->from < 60) {
                            $id = Mobility::create([
                                'ours_id' => $data['ours_id'],
                                'confirm_id' => $confirm_id,
                                'acceptable' => 0,
                                'admin' => $Mob->admin,
                                'reason' => 'Grade less than 60% it mean ur failed in this subject',
                                'teacher' => $data['teacher'],
                                'doctor' => $data['doctor'],
                            ])->id;
                        }else{
                            $id = Mobility::create([
                                'ours_id' => $data['ours_id'],
                                'confirm_id' => $confirm_id,
                                'acceptable' => $Mob->acceptable,
                                'admin' => $Mob->admin,
                                'reason' => $Mob->reason,
                                'teacher' => $data['teacher'],
                                'doctor' => $data['doctor'],
                            ])->id;
                        }
                        break;
                    }
                }else{
                    foreach ($grades as $grade) {
                        if($grade->from < 60) {
                            $id = Mobility::create([
                                'ours_id' => $data['ours_id'],
                                'confirm_id' => $confirm_id,
                                'acceptable' => 0,
                                'admin' => $Mob->admin,
                                'reason' => 'Grade less than 60% it mean ur failed in this subject',
                                'teacher' => $data['teacher'],
                                'doctor' => $data['doctor'],
                            ])->id;
                        }else{
                            $id = Mobility::create([
                                'ours_id'=>$data['ours_id'],
                                'confirm_id'=>$confirm_id,
                                'teacher'=>$data['teacher'],
                                'doctor'=>$data['doctor'],
                            ])->id;
                        }
                        break;
                    }
                }
                break;
            }
        }else{
            foreach ($grades as $grade) {
                if($grade->from < 60) {
                    $id = Mobility::create([
                        'ours_id' => $data['ours_id'],
                        'confirm_id' => $confirm_id,
                        'acceptable' => 0,
                        'admin' => 1,
                        'reason' => 'Grade less than 60% it mean ur failed in this subject',
                        'teacher' => $data['teacher'],
                        'doctor' => $data['doctor'],
                    ])->id;
                }else{
                    $id = Mobility::create([
                        'ours_id'=>$data['ours_id'],
                        'confirm_id'=>$confirm_id,
                        'teacher'=>$data['teacher'],
                        'doctor'=>$data['doctor'],
                    ])->id;
                }
                break;
            }
        }

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
        foreach ($inserts as $insert)
        {
            $insert['mobility_id'] = $id;
            SubjectMobility::create($insert);
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function show($id): array
    {
        $student = Student::findOrFail($id);
        $ourGrades = OurGrade::all();
        return compact('student','ourGrades');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $mobility = Mobility::findOrFail($id);
        return $mobility->delete();
    }


}
