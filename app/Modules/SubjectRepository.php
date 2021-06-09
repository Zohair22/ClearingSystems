<?php


namespace App\Modules;


use App\Models\OurSubject;
use App\Models\Student;
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

    public function store(array $data, Request $request)
    {
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

}
