<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Modules\StudentRepository;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    private StudentRepository $studentRepository;

    public function __construct()
    {
        $this->studentRepository = new StudentRepository();
    }

    public function index(Student $student): StudentResource
    {
        return new StudentResource($this->studentRepository->all($student));
    }

    public function store(): StudentResource
    {
        return new StudentResource(redirect(route('addSubjects',$this->studentRepository->store())));
    }

    public function edit($id): StudentResource
    {
        return new StudentResource($this->studentRepository->edit($id));
    }

    public function update($id): StudentResource
    {
        return new StudentResource($this->studentRepository->update($id));
    }

    public function destroy($id): StudentResource
    {
        return new StudentResource($this->studentRepository->destroy($id));
    }

}
