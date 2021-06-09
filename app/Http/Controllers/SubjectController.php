<?php

namespace App\Http\Controllers;

use App\Modules\SubjectRepository;
use Illuminate\Http\RedirectResponse;
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
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'int'],
            'title' => ['required', 'int'],
            'description' => ['required'],
            'chr' => ['required', 'int'],
            'uni_id' => ['required', 'int'],
        ]);
        $this->subjectRepository->store($data,$request);
        return back()->with('message','Subject Added Successfully');
    }
}
