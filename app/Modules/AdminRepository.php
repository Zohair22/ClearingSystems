<?php


namespace App\Modules;

use App\Models\Collage;
use App\Models\Mobility;
use App\Models\OurSubject;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminRepository
{
    private User $admin;

    public function __construct()
    {
        $this->admin = new User();
    }

    public function all(): array
    {
        $collages = Collage::all();
        $users = User::all();
        $mobilities = Mobility::with(['subjects','subjectMobilities'])->get();
        $ourSubjects = OurSubject::all();
        return compact('collages','users','mobilities','ourSubjects');
    }

    public function store($data)
    {
        $data['password'] = Hash::make(request('password'));
        return User::create($data);
    }

    public function login($data)
    {
        $admin = User::where('email', $data['email'])->first();


        if (isset($admin)) {
            if (Hash::check($data['password'], $admin->password)) {
                auth('admin')->login($admin);
                return redirect(route('home'));
            } else {
                return back()->with('message', 'something went wrong');
            }
        } else {
            return back()->with('message', 'something went wrong');
        }
    }

}
