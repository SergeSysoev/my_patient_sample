<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\Department\Create;
use App\Http\Requests\Department\Update;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function all()
    {
        return $this->json(200, 'OK', Department::all());
    }

    public function create(Create $request)
    {
        Department::create($request->all());
        return $this->json(200, 'OK');
    }

    public function update(Update $request, $id)
    {
        $department = Department::findOrFail($id);
        $department->name = $request->input('name');
        $department->chief_id = empty($request->input('chief_id')) ? $department->chief_id : $request->input('chief_id');
        if($department->save())
        {
            return $this->json(200, 'OK');
        }
    }

    public function delete($id)
    {
        Department::findOrFail($id)->delete();
        return $this->json(200, 'OK');
    }
}
