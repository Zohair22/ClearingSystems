<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectMobilityCollection;
use App\Http\Resources\SubjectMobilityResource;
use App\Modules\SubjectMobilityRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\Rule;

class SubjectMobilityController extends Controller
{
    private SubjectMobilityRepository $subjectMobilityRepository;
    public function __construct()
    {
        $this->subjectMobilityRepository = new SubjectMobilityRepository();
    }

    public function all($id): SubjectMobilityCollection
    {
        return new SubjectMobilityCollection($this->subjectMobilityRepository->all($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return SubjectMobilityResource
     */
    public function store(Request $request): SubjectMobilityResource
    {
        return new SubjectMobilityResource($this->subjectMobilityRepository->store($request));
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
