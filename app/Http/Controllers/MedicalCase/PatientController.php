<?php

namespace App\Http\Controllers\MedicalCase;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PatientController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(Request $request) {
        $page = $request->query('page', 1);

        $response = $this->api->request(Request::METHOD_GET, "patients?page={$page}");

        $body = json_decode($response->getBody());

        $paginator = new LengthAwarePaginator($body->data->patients, $body->total, 1, \Illuminate\Pagination\Paginator::resolveCurrentPage(), ['path' => $request->path()]);

        return view('patient.index', ['result' => $paginator]);
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

    public function edit(Request $request, $id) {
        
    }

    public function delete(Request $request, $id) {
        
    }

    public function fileCase(Request $request, $id) {
        return view('medical_case.add');
    }

}
