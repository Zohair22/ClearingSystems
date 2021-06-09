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
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'int'],
            'title' => ['required', 'int'],
            'description' => ['required'],
            'chr' => ['required', 'int'],
            'uni_id' => ['required', 'int'],
        ]);
        return new SubjectResource($this->subjectRepository->store($data,$request));
    }
}
