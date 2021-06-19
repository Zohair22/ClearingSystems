<?php


namespace App\Modules;


use App\Models\Collage;
use Illuminate\Validation\Rule;

class CollageRepository
{
    private Collage $collage;

    /**
     * CollageRepository constructor.
     */
    public function __construct()
    {
        $this->collage = new Collage();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $data = request()->validate([
            'uni_name' => ['required', 'string', 'max:255'],
            'collage' => ['required', 'string', 'max:255'],
        ]);
        $name = $data['uni_name'];
        $collageName = $data['collage'];

        $request->validate([
            'collage' => Rule::unique('collages')->where(function ($query) use ($collageName, $name, $request) {
                return $query
                    ->where('uni_name',$name)
                    ->where('collage',$collageName);
            }) ,
        ]);

        $id = Collage::create($data)->id;
        return Collage::findOrFail($id);
    }

}
