<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MobilityResource;
use App\Models\Mobility;
use App\Modules\MobilityRepository;

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
     * @param Mobility $mobility
     * @return MobilityResource
     */
    public function all(Mobility $mobility): MobilityResource
    {
        return new MobilityResource($this->mobilityRepository->all($mobility));
    }

    public function disapprove($id): MobilityResource
    {
        $data = request()->validate([
            'acceptable' => ['int'],
            'admin' => ['int'],
        ]);
        return new MobilityResource($this->mobilityRepository->disapprove($id,$data));
    }

    public function approve($id): MobilityResource
    {
        $data = request()->validate([
            'acceptable' => ['int'],
            'admin' => ['int'],
        ]);
        return new MobilityResource($this->mobilityRepository->approve($id,$data));
    }
}
