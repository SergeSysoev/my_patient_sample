<?php

namespace App\Http\Controllers;

use App\Pressure;
use App\Http\Requests\Pressure\Create;
use App\Http\Requests\Pressure\Update;

class PressureController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function all()
    {
        return $this->json(200, 'OK', Pressure::all());
    }

    public function create(Create $request)
    {
        Pressure::create($request->all());
        return $this->json(200, 'OK');
    }

    public function update(Update $request, $id)
    {
        $Pressure = Pressure::findOrFail($id);
        $Pressure->update($request->all());
        return $this->json(200, 'OK');
    }

    public function delete($id)
    {
        Pressure::findOrFail($id)->delete();
        return $this->json(200, 'OK');
    }
}
