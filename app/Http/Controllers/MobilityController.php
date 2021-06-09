<?php

namespace App\Http\Controllers;

use App\Models\Mobility;
use App\Modules\MobilityRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MobilityController extends Controller
{

    private MobilityRepository $mobilityRepository;
    public function __construct()
    {
        $this->mobilityRepository = new MobilityRepository();
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function all(Mobility $mobility)
    {
        return view('doctor.all',$this->mobilityRepository->all($mobility));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
    public function store(): RedirectResponse
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function disapprove($id): RedirectResponse
    {
        $data = request()->validate([
            'acceptable' => ['int'],
            'admin' => ['int'],
        ]);

        $this->mobilityRepository->disapprove($id,$data);
        return back()->with('message','The Mobility Updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function approve($id): RedirectResponse
    {
        $data = request()->validate([
            'acceptable' => ['int'],
            'admin' => ['int'],
        ]);

        $this->mobilityRepository->approve($id,$data);
        return back()->with('message','The Mobility Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}