<?php

namespace App\Http\Controllers;

use App\Chamber;
use App\Http\Requests\Chamber\Create;
use App\Http\Requests\Chamber\Update;

class ChamberController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function all()
    {
        return $this->json(200, 'OK', Chamber::all());
    }

    public function create(Create $request)
    {
        Chamber::create($request->all());
        return $this->json(200, 'OK');
    }

    public function update(Update $request, $id)
    {
        $chamber = Chamber::findOrFail($id);
        $chamber->update($request->all());
        return $this->json(200, 'OK');
    }

    public function delete($id)
    {
        Chamber::findOrFail($id)->delete();
        return $this->json(200, 'OK');
    }

    public function withPatients()
    {
        $chambers = Chamber::with(['patients'])->get();
        return $this->json(200, 'OK', $chambers);
    }
}
