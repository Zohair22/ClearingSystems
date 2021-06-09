<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CollageCollection;
use App\Http\Resources\CollageResource;
use App\Modules\CollageRepository;
use Illuminate\Http\Request;

class CollageController extends Controller
{
    private CollageRepository $collageRepository;

    public function __construct(){
        $this->collageRepository = new CollageRepository();
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'uni_name' => ['required', 'string', 'max:255'],
            'collage' => ['required', 'string', 'max:255'],
        ]);

        return new CollageResource($this->collageRepository->store($request,$data));
    }
}
