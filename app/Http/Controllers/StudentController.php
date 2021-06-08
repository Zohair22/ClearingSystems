<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Modules\StudentRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    private StudentRepository $studentRepository;

    public function __construct()
    {
        $this->studentRepository = new StudentRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Student $student)
    {
        return view('teacher.student.students',$this->studentRepository->all($student));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Application|RedirectResponse
     */
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
        return redirect(route('addSubjects',$this->studentRepository->store($data)));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        return view('teacher.student.editStudentInfo',$this->studentRepository->edit($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function update($id): RedirectResponse
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
        $this->studentRepository->update($id,$data);
        return redirect(route('showStudent'))->with('message','The Student Information Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->studentRepository->destroy($id);
        return back()->with('message','The Student Deleted successfully');
    }
}
