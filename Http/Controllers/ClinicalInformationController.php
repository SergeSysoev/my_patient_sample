<?php

namespace App\Http\Controllers;

use App\ClinicalInformation;
use App\Http\Requests\ClinicalInformation\Create;
use App\Http\Requests\ClinicalInformation\Update;

class ClinicalInformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function all()
    {
        return $this->json(200, 'OK', ClinicalInformation::all());
    }

    public function create(Create $request)
    {
        ClinicalInformation::create($request->all());
        return $this->json(200, 'OK');
    }

    public function update(Update $request, $id)
    {
        $ClinicalInformation = ClinicalInformation::findOrFail($id);
        $ClinicalInformation->update($request->all());
        return $this->json(200, 'OK');
    }

    public function delete($id)
    {
        ClinicalInformation::findOrFail($id)->delete();
        return $this->json(200, 'OK');
    }
}
