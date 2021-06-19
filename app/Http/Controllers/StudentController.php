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
        return redirect(route('addSubjects',$this->studentRepository->store()));
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
        $this->studentRepository->update($id);
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
