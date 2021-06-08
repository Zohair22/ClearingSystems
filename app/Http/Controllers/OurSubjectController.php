<?php

namespace App\Http\Controllers;

use App\Modules\OurSubjectRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OurSubjectController extends Controller
{

    private OurSubjectRepository $ourSubjectRepository;

    public function __construct()
    {
        $this->ourSubjectRepository =new OurSubjectRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function all()
    {
        return view('teacher.subject.ourSubView',$this->ourSubjectRepository->all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'code' => ['required', 'int'],
            'title' => ['required','string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'chr' => ['required'],
            'description' => '',
            'doctor' => ['int'],
        ]);

        $Sub = $this->ourSubjectRepository->store($data,$request);
        return back()->with('message','The Subject '.$Sub->name.' Added successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        return view('teacher.subject.updateOurSubject',$this->ourSubjectRepository->edit($id));
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
        $data = $request->validate([
            'code' => ['required', 'int'],
            'title' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'chr' => '',
            'description' => '',
            'doctor' => ['int'],
        ]);

        $this->ourSubjectRepository->update($id,$data);
        return redirect()->route('showOurSubjects')->with('message','The Subject Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->ourSubjectRepository->destroy($id);
        return back()->with('message','Subject Deleted successfully');

    }
}
