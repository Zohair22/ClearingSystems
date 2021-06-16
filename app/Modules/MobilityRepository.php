<?php


namespace App\Modules;


use App\Models\Mobility;

class MobilityRepository
{
    private Mobility $mobility;

    public function __construct()
    {
        $this->mobility = new Mobility();
    }

    public function disapprove($id, $data)
    {
        $mobility = Mobility::findOrFail($id);
        $data['acceptable'] = 0;
        $data['admin'] = 1;
        return $mobility->update($data);
    }

    public function approve($id, $data)
    {
        $mobility = Mobility::findOrFail($id);
        $data['acceptable'] = 1;
        $data['admin'] = 1;
        return $mobility->update($data);
    }

    public function all(Mobility $mobility): array
    {
        $mobilities = $mobility->orderBy('updated_at','DESC')->get();
        return compact('mobilities');
    }

}
