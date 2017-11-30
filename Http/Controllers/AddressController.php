<?php

namespace App\Http\Controllers;

use App\Address;
use App\Http\Requests\Address\Create;
use App\Http\Requests\Address\Update;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function all()
    {
        return $this->json(200, 'OK', Address::all());
    }

    public function create(Create $request)
    {
        $address = Address::create($request->all());
        return $this->json(200, 'OK', $address);
    }

    public function update(Update $request, $id)
    {
        $address = Address::findOrFail($id);
        $address->update($request->all());
        return $this->json(200, 'OK', $address);
    }

    public function delete($id)
    {
        Address::findOrFail($id)->delete();
        return $this->json(200, 'OK');
    }
}
