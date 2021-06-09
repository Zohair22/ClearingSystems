<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Modules\StudentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    private StudentRepository $studentRepository;

    public function __construct()
    {
        $this->studentRepository = new StudentRepository();
    }

    public function index(Student $student)
    {
        return new StudentResource($this->studentRepository->all($student));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255', 'unique:students'],
            'nationality' => ['required', 'string', 'max:255'],
            'qualification' => ['required', 'string', 'max:255'],
            'qualification_year' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'max:255'],
            'semester' => ['required', 'string', 'max:255'],
            'uni_id' => ['required'],
        ]);
        return new StudentResource(redirect(route('addSubjects',$this->studentRepository->store($data))));
    }

    public function edit($id)
    {
        return new StudentResource($this->studentRepository->edit($id));
    }

    public function update($id): StudentResource
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
        return new StudentResource($this->studentRepository->update($id,$data));
    }

    public function destroy($id)
    {
        return new StudentResource($this->studentRepository->destroy($id));
    }

}
