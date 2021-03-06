<?php

namespace App\Http\Controllers;

use App\Modules\SubjectMobilityRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectMobilityController extends Controller
{
    private SubjectMobilityRepository $subjectMobilityRepository;
    public function __construct()
    {
        $this->subjectMobilityRepository = new SubjectMobilityRepository();
    }


    public function all($id)
    {
        return view('teacher.mobility.addStudentSubject', $this->subjectMobilityRepository->all($id));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->subjectMobilityRepository->store($request);
        return back()->with('message','Student mobility Added successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        return view('teacher.student.studentMobility',$this->subjectMobilityRepository->show($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->subjectMobilityRepository->destroy($id);
        return back()->with('message','Deleted successfully');
    }
}
