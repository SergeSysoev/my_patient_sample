<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 8/14/17
 * Time: 6:39 PM
 */

namespace App\Http\Controllers;


use App\Role;
use App\Http\Requests\Role\Create;
use App\Http\Requests\Role\Update;

class RoleController extends Controller
{
    public function all()
    {
        return $this->json(200, 'OK', Role::all());
    }

    public function create(Create $request)
    {
        Role::create($request->all());
        return $this->json(200, 'OK');
    }

    public function update(Update $request, $id)
    {
        $Role = Role::findOrFail($id);
        $Role->update($request->all());
        return $this->json(200, 'OK');
    }

    public function delete($id)
    {
        Role::findOrFail($id)->delete();
        return $this->json(200, 'OK');
    }
}
