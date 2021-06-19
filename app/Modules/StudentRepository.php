<?php


namespace App\Modules;


use App\Models\Collage;
use App\Models\Student;
use Illuminate\Validation\Rule;

class StudentRepository
{

    private Student $student;

    public function __construct()
    {
        $this->student = new Student();
    }


    public function all(Student $student)
    {
        $students = $student->latest()->get();
        return compact('students');
    }


    public function store()
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255', 'unique:students'],
            'nationality' => ['required', 'string', 'max:255'],
            'qualification' => ['required', 'string', 'max:255'],
            'grade' => ['required', 'string', 'max:255'],
            'percentage' => ['required', 'string', 'max:255'],
            'qualification_year' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'max:255'],
            'semester' => ['required', 'string', 'max:255'],
            'uni_id' => ['required'],
        ]);
        $id = Student::create($data)->id;
        return $id;
    }


    public function edit($id)
    {
        $collages = Collage::all();
        $student = Student::findOrFail($id);
        return compact('student','collages');
    }


    public function update($id)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('students')->ignore($id)],
            'nationality' => ['required', 'string', 'max:255'],
            'qualification' => ['required', 'string', 'max:255'],
            'qualification_year' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'max:255'],
            'semester' => ['required', 'string', 'max:255'],
            'uni_id' => ['required'],
        ]);
        $student = Student::findOrFail($id);
        return $student->update($data);
    }


    public function destroy($id)
    {
        $student = Student::findOrFail($id);
       return $student->delete();
    }


}
