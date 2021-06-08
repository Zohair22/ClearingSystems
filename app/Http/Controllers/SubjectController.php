<?php

namespace App\Http\Controllers;

use App\Models\Collage;
use App\Models\Mobility;
use App\Models\OurSubject;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SubjectMobility;
use App\Models\User;
use App\Modules\SubjectRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectController extends Controller
{

    private SubjectRepository $subjectRepository;

    public function __construct()
    {
        $this->subjectRepository = new SubjectRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function all($id)
    {
        return view('teacher.mobility.addStudentSubject',$this->subjectRepository->all($id));
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
