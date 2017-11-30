<?php

namespace App\Http\Controllers;

use App\Temperature;
use App\Http\Requests\Temperature\Create;
use App\Http\Requests\Temperature\Update;

class TemperatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function all()
    {
        return $this->json(200, 'OK', Temperature::all());
    }

    public function create(Create $request)
    {
        Temperature::create($request->all());
        return $this->json(200, 'OK');
    }

    public function update(Update $request, $id)
    {
        $Temperature = Temperature::findOrFail($id);
        $Temperature->update($request->all());
        return $this->json(200, 'OK');
    }

    public function delete($id)
    {
        Temperature::findOrFail($id)->delete();
        return $this->json(200, 'OK');
    }
}
