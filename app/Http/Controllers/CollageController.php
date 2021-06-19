<?php

namespace App\Http\Controllers;

use App\Modules\CollageRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CollageController extends Controller
{
    private CollageRepository $collageRepository;

    public function __construct(){
        $this->collageRepository = new CollageRepository();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $collage = $this->collageRepository->store($request);
        return back()->with('message','Collage '.$collage->collage.' for '.$collage->uni_name.' University Added successfully');
    }
}
