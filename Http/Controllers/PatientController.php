<?php

namespace App\Http\Controllers;

use App\Address;
use App\Analysis;
use App\AnalysisType;
use App\Patient;
use App\Http\Requests\Patient\Create;
use App\Http\Requests\Address\Create as AddressCreate;
use App\Http\Requests\Address\Update as AddressUpdate;
use App\Http\Requests\Patient\Update;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function all()
    {
        return $this->json(200, 'OK', Patient::all());
    }

    public function create(Create $request)
    {
        $validator = Validator::make($request->input('address'), with(new AddressCreate)->rules());
        if($validator->fails())
        {
            throw new ValidationException('Address validation error.');
        }
        $address = Address::create($request->input('address'));
        $patient = Patient::create($request->except('address') + ['address_id' => $address->id]);
        return $this->json(200, 'OK', $patient);
    }

    public function update(Update $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->update($request->all());
        return $this->json(200, 'OK');
    }

    public function delete($id)
    {
        Patient::findOrFail($id)->delete();
        return $this->json(200, 'OK');
    }

    public function clinicalInformation($id)
    {
        $patient = Patient::findOrFail($id);
        return $this->json(200, 'OK', $patient->clinicalInformation);
    }

    public function get($id)
    {
        return $this->json(200, 'OK', Patient::findOrFail($id));
    }

    public function withDiagnoses($id)
    {
        $patient = Patient::findOrFail($id);
        $result = $patient->with('diagnoses.type')->get();
        $result[0]->address = $patient->address->full_address;
        //fuck android!
        foreach ($result[0]->diagnoses as &$diagnosis) {
            $diagnosis->name = $diagnosis->type->name;
            unset($diagnosis->type);
        }
        return $this->json(200, 'OK', $result[0]);
    }

    public function analyses($id)
    {
        $patient = Patient::findOrFail($id);
        return $this->json(200, 'OK', $patient->with('analyses.type')->get());
    }

    public function analysesTypes($id, $typeId = false)
    {
        $patient = Patient::findOrFail($id);
        if($typeId)
        {
            $patient = $patient->with('analyses.files')->where('id', $id)->first();
            return $this->json(200, 'OK', $patient->analyses->where('type_id', '=', $typeId)->except('id'));
        }
        return $this->json(200, 'OK', $patient->analysesTypes($typeId));
    }

    public function temperatures($id)
    {
        return $this->json(200, 'OK', Patient::findOrFail($id)->temperatures);
    }

    public function pressures($id)
    {
        return $this->json(200, 'OK', Patient::findOrFail($id)->pressures);
    }

    public function diuresis($id)
    {
        return $this->json(200, 'OK', Patient::findOrFail($id)->diuresis);
    }
}
