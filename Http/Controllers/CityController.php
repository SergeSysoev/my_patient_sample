<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests\City\Create;
use App\Http\Requests\City\Update;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function all()
    {
        return $this->json(200, 'OK', City::all());
    }

    public function create(Create $request)
    {
        $city = City::create($request->all());
        return $this->json(200, 'OK', $city);
    }

    public function update(Update $request, $id)
    {
        $city = City::findOrFail($id);
        $city->update($request->all());
        return $this->json(200, 'OK', $city);
    }

    public function delete($id)
    {
        City::findOrFail($id)->delete();
        return $this->json(200, 'OK');
    }
}
