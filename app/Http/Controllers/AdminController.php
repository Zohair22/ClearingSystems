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
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        $this->adminRepository->store();
        return back()->with('message', 'Added successfully');
    }

}
