<?php

namespace App\Http\Controllers;

use App\DiagnosisType;
use App\Http\Requests\DiagnosisType\Create;
use App\Http\Requests\DiagnosisType\Update;

class DiagnosisTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function all()
    {
        return $this->json(200, 'OK', DiagnosisType::all());
    }

    public function create(Create $request)
    {
        DiagnosisType::create($request->all());
        return $this->json(200, 'OK');
    }

    public function update(Update $request, $id)
    {
        $DiagnosisType = DiagnosisType::findOrFail($id);
        $DiagnosisType->update($request->all());
        return $this->json(200, 'OK');
    }

    public function delete($id)
    {
        DiagnosisType::findOrFail($id)->delete();
        return $this->json(200, 'OK');
    }
}
