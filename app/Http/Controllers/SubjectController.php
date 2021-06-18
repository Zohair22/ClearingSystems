<?php

namespace App\Http\Controllers;

use App\Modules\SubjectRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
        $this->subjectRepository->store($request);
        return back()->with('message','Subject Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        return view('teacher.subject.updateSubject',$this->subjectRepository->edit($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param Request $request
     * @return string
     */
    public function update($id,Request $request): string
    {
        $this->subjectRepository->update($id,$request);
        return back()->with('message','The Subject Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->subjectRepository->destroy($id);
        return back()->with('message','Subject Deleted successfully');

    }
}
