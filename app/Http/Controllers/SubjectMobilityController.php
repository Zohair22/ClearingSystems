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

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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

        $stu_id = $data['stu_id'];
        $sub_id = $data['sub_id'];
        $request->validate([
            'sub_id'=> Rule::unique('subject_mobilities')->where(function ($query) use ($sub_id, $stu_id,$request) {
                return $query
                    ->where('sub_id',$sub_id)
                    ->where('stu_id',$stu_id);
            }) ,
        ]);

        $this->subjectMobilityRepository->store($data);
        return back()->with('message','Student mobility Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {

        return view('teacher.student.studentMobility',$this->subjectMobilityRepository->show($id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  $id
     * @return RedirectResponse
     */
    public function update($id ,Request $request): RedirectResponse
    {
        $this->subjectMobilityRepository->update($id,$request);
        return back()->with('message','the Mobility Added successfully');
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
