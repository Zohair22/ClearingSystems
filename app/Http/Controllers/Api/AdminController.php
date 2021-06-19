<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminCollection;
use App\Modules\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminController extends Controller
{
    private AdminRepository $adminRepository;

    public function __construct()
    {
        $this->adminRepository = new AdminRepository();
    }

    public function index(): AdminCollection
    {
        return new AdminCollection($this->adminRepository->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(): AdminCollection
    {
        return new AdminCollection($this->adminRepository->store());
    }

    public function login(Request $request): AdminCollection
    {
        if ($this->adminRepository->login($request)){
            return new AdminCollection(route('home'));
        }else{
            return new AdminCollection(back()->with('message','something went wrong'));
        }
    }

}
