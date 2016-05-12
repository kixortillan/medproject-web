<?php

namespace App\Http\Controllers\MedicalCase;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class PatientController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(Request $request) {
        $page = $request->query('page', 1);

        $response = $this->api->request(Request::METHOD_GET, "patients?page={$page}");

        $body = json_decode($response->getBody());

        $paginator = new LengthAwarePaginator($body->data->patients, $body->total, 1, \Illuminate\Pagination\Paginator::resolveCurrentPage(), ['path' => $request->path()]);

        return view('patient.index', ['paginator' => $paginator]);
    }

    public function store(Request $request) {
        if ($request->method() == Request::METHOD_GET) {
            return view('patient.add');
        }

        $firstName = $request->input('txt_first_name', '');
        $middleName = $request->input('txt_middle_name', '');
        $lastName = $request->input('txt_last_name', '');
        $address = $request->input('txt_address', '');
        $postalCode = $request->input('txt_postal_code', '');

        $response = $this->api->request('POST', 'patients', [
            'json' => [
                'first_name' => $firstName,
                'middle_name' => $middleName,
                'last_name' => $lastName,
                'address' => $address,
                'postal_code' => $postalCode,
            ]
        ]);

        return redirect('patients')->with('message', 'Successfully added patient');
    }

    public function edit(Request $request, $id = null) {
        if ($request->method() == Request::METHOD_GET) {
            $response = $this->api->request("GET", "patients/{$id}");

            $body = json_decode($response->getBody());

            return view('patient.edit', ['patient' => $body->data->patient]);
        }

        $this->validate($request, [
            'hdn_patient_id' => 'bail|required',
            'txt_first_name' => 'bail|required|alpha_num',
            'txt_middle_name' => 'bail|required|alpha_num',
            'txt_last_name' => 'bail|required|alpha_num',
            'txt_address' => 'bail|required',
            'txt_postal_code' => 'required',
        ]);

        $patientId = $request->input('hdn_patient_id');
        $firstName = $request->input('txt_first_name');
        $middleName = $request->input('txt_middle_name');
        $lastName = $request->input('txt_last_name');
        $address = $request->input('txt_address');
        $postalCode = $request->input('txt_postal_code');

        $this->api->request("PUT", "patients/{$patientId}", [
            'json' => [
                'first_name' => $firstName,
                'middle_name' => $middleName,
                'last_name' => $lastName,
                'address' => $address,
                'postal_code' => $postalCode,
            ]
        ]);
        
        return redirect('patients')->with('message', 'Successfully updated patient information.');
    }

    public function delete(Request $request, $id) {
        $response = $this->api->request("DELETE", "patients/{$id}");
        
        if($response->getStatusCode() != Response::HTTP_OK){
            
        }
            
        return redirect('patients')->with('message', 'Successfully deleted patient.');
    }

}
