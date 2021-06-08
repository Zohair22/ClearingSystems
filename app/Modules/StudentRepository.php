<?php


namespace App\Modules;


use App\Models\Collage;
use App\Models\Student;

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


    public function store($data)
    {
        $id = Student::create($data)->id;
        return $id;
    }


    public function edit($id)
    {
        $collages = Collage::all();
        $student = Student::findOrFail($id);
        return compact('student','collages');
    }


    public function update($id, $data)
    {
        $student = Student::findOrFail($id);
        return $student->update($data);
    }


    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
    }


}
