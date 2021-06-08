<?php


namespace App\Modules;


use App\Models\OurSubject;
use App\Models\User;
use Illuminate\Validation\Rule;

class OurSubjectRepository
{
    private OurSubject $ourSubject;

    public function __construct()
    {
        $this->ourSubject = new OurSubject();
    }

    public function all()
    {
        $subjects = OurSubject::all();
        $users = User::all();
        return compact('subjects','users');
    }

    public function store($data,$request)
    {
        $title = $data['title'];
        $code = $data['code'];

        $request->validate([
            'code'=> Rule::unique('our_subjects')->where(function ($query) use ($title, $code,$request) {
                return $query
                    ->where('code',$code)
                    ->where('title',$title);
            }) ,

        ]);

        $id = OurSubject::create($data)->id;
        return OurSubject::findOrFail($id);
    }

    public function edit($id)
    {
        $subject = OurSubject::findOrFail($id);
        $users = User::all();
        return compact('subject','users');
    }

    public function update($id, $data)
    {
        $subject = OurSubject::findOrFail($id);
        return $subject->update($data);
    }

    public function destroy($id)
    {
        $subject = OurSubject::findOrFail($id);
        $subject->delete();
    }

}
