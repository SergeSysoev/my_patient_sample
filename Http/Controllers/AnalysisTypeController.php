<?php

namespace App\Http\Controllers;

use App\AnalysisType;
use App\Http\Requests\AnalysisType\Create;
use App\Http\Requests\AnalysisType\Update;

class AnalysisTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function all()
    {
        return $this->json(200, 'OK', AnalysisType::all());
    }

    public function create(Create $request)
    {
        AnalysisType::create($request->all());
        return $this->json(200, 'OK');
    }

    public function update(Update $request, $id)
    {
        $AnalysisType = AnalysisType::findOrFail($id);
        $AnalysisType->update($request->all());
        return $this->json(200, 'OK');
    }

    public function delete($id)
    {
        AnalysisType::findOrFail($id)->delete();
        return $this->json(200, 'OK');
    }
}
