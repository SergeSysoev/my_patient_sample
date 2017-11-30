<?php

namespace App\Http\Controllers;

use App\Analysis;
use App\File;
use App\Http\Requests\Analysis\Create;
use App\Http\Requests\Analysis\Update;
use App\Traits\FileTrait;

class AnalysisController extends Controller
{
    use FileTrait;
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function all()
    {
        return $this->json(200, 'OK', Analysis::all());
    }

    public function create(Create $request)
    {
        $fileName = $request->input('date').$request->input('type_id').$request->input('patient_id');
        $input = $request->except('file');
        $analysis = Analysis::create($input);
        File::create([
            'name' => $fileName,
            'file' => $this->createFile($request->input('file.base64'), $fileName, $request->input('file.ext')),
            'belongs_to' => File::ANALYSIS,
            'belongs_to_id' => $analysis->id,
        ]);
        return $this->json(200, 'OK', $analysis);
    }

    public function update(Update $request, $id)
    {
        $input = $request->except('file');
        $analysis = Analysis::findOrFail($id);
        $analysis->update($input);
        if($request->has('file'))
        {
            $fileName = $request->input('date').$request->input('type_id').$request->input('patient_id');
            File::create([
                'name' => $fileName,
                'file' => $this->createFile($request->input('file.base64'), $fileName, $request->input('file.ext')),
                'belongs_to' => File::ANALYSIS,
                'belongs_to_id' => $analysis->id,
            ]);
        }

        return $this->json(200, 'OK', $analysis);
    }

    public function delete($id)
    {
        Analysis::findOrFail($id)->delete();
        return $this->json(200, 'OK');
    }
}
