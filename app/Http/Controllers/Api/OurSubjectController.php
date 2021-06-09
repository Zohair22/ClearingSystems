<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OurSubjectResource;
use App\Modules\OurSubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OurSubjectController extends Controller
{
    private OurSubjectRepository $ourSubjectRepository;

    public function __construct()
    {
        $this->ourSubjectRepository =new OurSubjectRepository();
    }

    public function all(): OurSubjectResource
    {
        return new OurSubjectResource($this->ourSubjectRepository->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return OurSubjectResource
     */
    public function store(Request $request): OurSubjectResource
    {
        $data = $request->validate([
            'code' => ['required', 'int'],
            'title' => ['required','string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'chr' => ['required'],
            'description' => '',
            'doctor' => ['int'],
        ]);

        return new OurSubjectResource($this->ourSubjectRepository->store($data,$request));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return OurSubjectResource
     */
    public function edit($id): OurSubjectResource
    {
        return new OurSubjectResource($this->ourSubjectRepository->edit($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return OurSubjectResource
     */
    public function update(Request $request, $id): OurSubjectResource
    {
        $data = $request->validate([
            'code' => ['required', 'int'],
            'title' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'chr' => '',
            'description' => '',
            'doctor' => ['int'],
        ]);

        return new OurSubjectResource($this->ourSubjectRepository->update($id,$data));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return OurSubjectResource
     */
    public function destroy($id): OurSubjectResource
    {
        return new OurSubjectResource($this->ourSubjectRepository->destroy($id));
    }
}
