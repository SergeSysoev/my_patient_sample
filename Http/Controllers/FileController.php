<?php

namespace App\Http\Controllers;

use App\File;
//use App\Http\Requests\File\Create;
//use App\Http\Requests\File\Update;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function get($name)
    {
        return response()->file('/storage/files/' . $name);
    }

//    public function create(Create $request)
//    {
//        $city = File::create($request->all());
//        return $this->json(200, 'OK', $city);
//    }
//
//    public function update(Update $request, $id)
//    {
//        $city = File::findOrFail($id);
//        $city->update($request->all());
//        return $this->json(200, 'OK', $city);
//    }
//
//    public function delete($id)
//    {
//        File::findOrFail($id)->delete();
//        return $this->json(200, 'OK');
//    }
}
