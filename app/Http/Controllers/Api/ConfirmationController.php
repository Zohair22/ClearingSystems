<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConfirmationCollection;
use App\Modules\ConfirmationRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ConfirmationController extends Controller
{
    private ConfirmationRepository $confirmationRepository;

    public function __construct(){
        $this->confirmationRepository = new ConfirmationRepository();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return ConfirmationCollection
     */
    public function update($id): ConfirmationCollection
    {
        return new ConfirmationCollection($this->confirmationRepository->update($id));
    }

    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return ConfirmationCollection
     */
    public function subjectAccepted($id): ConfirmationCollection
    {
        return new ConfirmationCollection($this->confirmationRepository->confirmed($id));
    }

    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return ConfirmationCollection
     */
    public function subjectRejected($id): ConfirmationCollection
    {
        return new ConfirmationCollection($this->confirmationRepository->confirmed($id));
    }



}
