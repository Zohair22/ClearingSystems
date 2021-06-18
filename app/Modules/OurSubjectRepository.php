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

    public function store($request)
    {
        $data = $request->validate([
            'code' => ['required', 'int'],
            'title' => ['required','string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'chr' => ['required'],
            'description' => '',
            'doctor' => ['int'],
        ]);
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

    public function update($id,$request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'int'],
            'title' => ['required', 'int'],
            'description' => ['required'],
            'chr' => ['required', 'int'],
        ]);
        $code = $data['code'];
        $title = $data['title'];
        $request->validate([
            'code'=> Rule::unique('our_subjects')->ignore($id)->where(function ($query) use ($title, $code,$request) {
                return $query
                    ->where('code',$code)
                    ->where('title',$title);
            }) ,
        ]);
        $subject = OurSubject::findOrFail($id);
        return $subject->update($data);
    }

    public function destroy($id)
    {
        $subject = OurSubject::findOrFail($id);
        $subject->delete();
    }

}
