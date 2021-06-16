<?php

namespace App\Http\Controllers;

use App\Modules\ConfirmationRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    private ConfirmationRepository $confirmationRepository;
    public function __construct(){
        $this->confirmationRepository = new ConfirmationRepository();
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function subjectAccepted($id)
    {
        return view('admin.subjectAccepted',$this->confirmationRepository->confirmed($id));
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function subjectRejected($id)
    {
        return view('admin.subjectRejected',$this->confirmationRepository->confirmed($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function update($id): RedirectResponse
    {
        $this->confirmationRepository->update($id);
        return back()->with('message','Confirmed Successfully');
    }

}
