<?php

namespace App\Http\Controllers;

use App\Models\OurGrade;
use App\Modules\GradingSystemRepository;
use App\Modules\OurGradeRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('teacher.subject.ourGrade', $this->ourGradeRepository->index());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->ourGradeRepository->store($request);
        return back()->with('message','The Grades Added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $grade = $this->ourGradeRepository->edit($id);
        return view('teacher.subject.updateOurGrade',compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request,$id): RedirectResponse
    {
        $this->ourGradeRepository->update($id,$request);
        return back()->with('message','The Grades Updated successfully');
    }

}
