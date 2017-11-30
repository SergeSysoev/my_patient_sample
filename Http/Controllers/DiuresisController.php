<?php

namespace App\Http\Controllers;

use App\Diuresis;
use App\Http\Requests\Diuresis\Create;
use App\Http\Requests\Diuresis\Update;

class DiuresisController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function all()
    {
        return $this->json(200, 'OK', Diuresis::all());
    }

    public function create(Create $request)
    {
        Diuresis::create($request->all());
        return $this->json(200, 'OK');
    }

    public function update(Update $request, $id)
    {
        $Diuresis = Diuresis::findOrFail($id);
        $Diuresis->update($request->all());
        return $this->json(200, 'OK');
    }

    public function delete($id)
    {
        Diuresis::findOrFail($id)->delete();
        return $this->json(200, 'OK');
    }
}
