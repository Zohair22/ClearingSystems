<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectMobilityResource;
use App\Modules\SubjectMobilityRepository;
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
     * @return SubjectMobilityResource
     */
    public function store(Request $request): SubjectMobilityResource
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

        return new SubjectMobilityResource($this->subjectMobilityRepository->store($data));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return SubjectMobilityResource
     */
    public function edit($id): SubjectMobilityResource
    {
        return new SubjectMobilityResource($this->subjectMobilityRepository->show($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return SubjectMobilityResource
     */
    public function update(Request $request, $id): SubjectMobilityResource
    {
        return new SubjectMobilityResource($this->subjectMobilityRepository->update($id,$request));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return SubjectMobilityResource
     */
    public function destroy($id): SubjectMobilityResource
    {
        return new SubjectMobilityResource($this->subjectMobilityRepository->destroy($id));
    }
}
