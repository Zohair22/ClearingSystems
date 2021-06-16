<?php


namespace App\Modules;


use App\Models\Confirmation;
use App\Models\OurGrade;
use App\Models\Student;

class ConfirmationRepository
{
    private Confirmation $confirmation;
    public function __construct(){
        $this->confirmation = new Confirmation();
    }

    public function update($id)
    {
        $confirm = Confirmation::findOrFail($id);
        $confirm->update([
            'confirmed'=> 1,
            'stu_id'=> request('stu_id'),
            'admin'=> request('admin')
        ]);
        return $confirm;
    }

    public function confirmed($id): array
    {
        $student = Student::findOrFail($id);
        $ourGrades = OurGrade::all();
        return compact('student','ourGrades');
    }

}
