<?php

namespace App\Http\Controllers;

use App\Region;
use App\Http\Requests\Region\Create;
use App\Http\Requests\Region\Update;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function all()
    {
        return $this->json(200, 'OK', Region::all());
    }

    public function create(Create $request)
    {
        $region = Region::create($request->all());
        return $this->json(200, 'OK', $region);
    }

    public function update(Update $request, $id)
    {
        $region = Region::findOrFail($id);
        $region->update($request->all());
        return $this->json(200, 'OK', $region);
    }

    public function delete($id)
    {
        Region::findOrFail($id)->delete();
        return $this->json(200, 'OK');
    }

    public function cities($id)
    {
        $region = Region::findOrFail($id);
        return $this->json(200, 'OK', $region->cities);
    }
}
