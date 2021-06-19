<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OurGradeCollection;
use App\Modules\OurGradeRepository;
use Illuminate\Http\Request;

class OurGradeController extends Controller
{
    private OurGradeRepository $ourGradeRepository;

    public function __construct(){
        $this->ourGradeRepository = new OurGradeRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return OurGradeCollection
     */
    public function index(): OurGradeCollection
    {
        return new OurGradeCollection($this->ourGradeRepository->index());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return OurGradeCollection
     */
    public function store(Request $request): OurGradeCollection
    {
        return new OurGradeCollection($this->ourGradeRepository->store($request));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return OurGradeCollection
     */
    public function edit($id): OurGradeCollection
    {
        return new OurGradeCollection($this->ourGradeRepository->edit($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return OurGradeCollection
     */
    public function update(Request $request,$id): OurGradeCollection
    {
        return new OurGradeCollection($this->ourGradeRepository->update($id,$request));
    }
}
