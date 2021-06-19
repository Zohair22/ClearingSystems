<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GradingSystemResource;
use App\Modules\GradingSystemRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class GradingSystemController extends Controller
{
    private GradingSystemRepository $gradingSystemRepository;

    public function __construct(){
        $this->gradingSystemRepository = new GradingSystemRepository();
    }

    /**
     * Display a listing of the resource.
     * @param $id
     * @return GradingSystemResource
     */
    public function index($id): GradingSystemResource
    {
        return new GradingSystemResource($this->gradingSystemRepository->index($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return GradingSystemResource
     */
    public function store(Request $request): GradingSystemResource
    {
        $data = $request->validate([
            'grade' => ['required'],
            'from' => ['required'],
            'to' => ['required'],
            'uni_id' => ['required'],
        ]);
        return new GradingSystemResource($this->gradingSystemRepository->store($data,$request));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return GradingSystemResource
     */
    public function edit($id): GradingSystemResource
    {
        return new GradingSystemResource($this->gradingSystemRepository->edit($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  $id
     * @return GradingSystemResource
     */
    public function update(Request $request, $id): GradingSystemResource
    {
        $data = request()->validate([
            'grade' => ['required'],
            'from' => ['required'],
            'to' => ['required'],
            'uni_id' => ['required'],
        ]);
        return new GradingSystemResource($this->gradingSystemRepository->update($id,$data,$request));
    }


}
