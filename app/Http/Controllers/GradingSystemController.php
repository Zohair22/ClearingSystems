<?php

namespace App\Http\Controllers;

use App\Models\GradeSystem;
use App\Modules\GradingSystemRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class GradingSystemController extends Controller
{
    private GradingSystemRepository $gradingSystemRepository;

    public function __construct(){
        $this->gradingSystemRepository = new GradingSystemRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index($id)
    {
        $collage = $this->gradingSystemRepository->index($id);
        return view('teacher.mobility.gradingSystem',compact('collage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'grade' => ['required'],
            'from' => ['required'],
            'to' => ['required'],
            'uni_id' => ['required'],
        ]);
        $this->gradingSystemRepository->store($data,$request);
        return back()->with('message','The Grades Added successfully');
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
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $grade = $this->gradingSystemRepository->edit($id);
        return view('teacher.mobility.updateGradingSystem',compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request,$id)
    {
        $data = request()->validate([
            'grade' => ['required'],
            'from' => ['required'],
            'to' => ['required'],
            'uni_id' => ['required'],
        ]);

        $uni_id = $this->gradingSystemRepository->update($id,$data,$request);
        return redirect(route('gradingSystem',$uni_id))->with('message','The Grades Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->gradingSystemRepository->destroy($id);
        return back()->with('message','The Grades Deleted successfully');
    }
}
