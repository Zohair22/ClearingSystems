<?php


namespace App\Modules;


use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectRepository
{

    private Subject $subject;

    public  function __construct()
    {
        $this->subject = new Subject();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'int'],
            'title' => ['required', 'int'],
            'description' => ['required'],
            'chr' => ['required', 'int'],
            'uni_id' => ['required', 'int'],
        ]);
        $code = $data['code'];
        $title = $data['title'];
        $uni_id = $data['uni_id'];
        $request->validate([
            'code'=> Rule::unique('subjects')->where(function ($query) use ($title, $code, $uni_id,$request) {
                return $query
                    ->where('code',$code)
                    ->where('title',$title)
                    ->where('uni_id',$uni_id);
            }) ,
        ]);

        return Subject::create($data);
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $users = User::all();
        return compact('subject','users');
    }

    public function update($id, $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'int'],
            'title' => ['required', 'int'],
            'description' => ['required'],
            'chr' => ['required', 'int'],
            'uni_id' => ['required', 'int'],
        ]);
        $code = $data['code'];
        $title = $data['title'];
        $uni_id = $data['uni_id'];
        $request->validate([
            'code'=> Rule::unique('subjects')->ignore($id)->where(function ($query) use ($title, $code, $uni_id,$id,$request) {
                return $query
                    ->where('code',$code)
                    ->where('title',$title)
                    ->where('uni_id',$uni_id);
            }) ,
        ]);
        $subject = Subject::findOrFail($id);
        return $subject->update($data);
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
    }

}
