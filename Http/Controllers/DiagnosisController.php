<?php

namespace App\Http\Controllers;

use App\Diagnosis;
use App\Http\Requests\Diagnosis\Create;
use App\Http\Requests\Diagnosis\Update;

class DiagnosisController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function all()
    {
        return $this->json(200, 'OK', Diagnosis::all());
    }

    public function create(Create $request)
    {
        Diagnosis::create($request->all());
        return $this->json(200, 'OK');
    }

    public function update(Update $request, $id)
    {
        $Diagnosis = Diagnosis::findOrFail($id);
        $Diagnosis->update($request->all());
        return $this->json(200, 'OK');
    }

    public function delete($id)
    {
        Diagnosis::findOrFail($id)->delete();
        return $this->json(200, 'OK');
    }
}
