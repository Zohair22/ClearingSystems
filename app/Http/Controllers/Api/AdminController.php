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

    public function index()
    {
        return new AdminCollection($this->adminRepository->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store()
    {
        $data = request()->validate([
            'phone' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'group_by' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        return new AdminCollection($this->adminRepository->store($data));
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email'=> ['required','email'],
            'password'=>['required'],
        ]);

        $this->adminRepository->login($data);

        if ($this->adminRepository->login($data)){
            return new AdminCollection(route('homeAdmin'));
        }else{
            return new AdminCollection(back()->with('message','something went wrong'));
        }
    }
}
