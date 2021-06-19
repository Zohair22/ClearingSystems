<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectResource;
use App\Modules\SubjectRepository;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    private SubjectRepository $subjectRepository;
    public function __construct()
    {
        $this->subjectRepository = new SubjectRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return SubjectResource
     */
    public function store(Request $request): SubjectResource
    {
        return new SubjectResource($this->subjectRepository->store($request));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return SubjectResource
     */
    public function edit($id): SubjectResource
    {
        return new SubjectResource($this->subjectRepository->edit($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param Request $request
     * @return SubjectResource
     */
    public function update($id,Request $request): SubjectResource
    {
        return new SubjectResource($this->subjectRepository->update($id,$request));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return SubjectResource
     */
    public function destroy($id): SubjectResource
    {
        return new SubjectResource($this->subjectRepository->destroy($id));
    }

}
