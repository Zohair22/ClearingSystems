<?php

namespace App\Http\Controllers;

use App\Modules\AdminRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{

    private AdminRepository $adminRepository;

    public function __construct()
    {
        $this->adminRepository = new AdminRepository();
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home', $this->adminRepository->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(): RedirectResponse
    {
        $data = request()->validate([
            'phone' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'group_by' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $this->adminRepository->store($data);
        return back()->with('message', 'Added successfully');
    }
}
