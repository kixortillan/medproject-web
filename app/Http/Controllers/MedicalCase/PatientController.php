<?php

namespace App\Http\Controllers\MedicalCase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Exception;

class PatientController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(Request $request) {
        $response = $this->api->request(Request::METHOD_GET, 'patients');

        $patients = json_decode($response->getBody());

        return view('patient.index', ['patients' => $patients->data]);
    }

    public function store(Request $request) {
        if ($request->method() == Request::METHOD_GET) {
            return view('patient.add');
        }

        $deptCode = $request->input('txt_dept_code');
        $deptName = $request->input('txt_dept_name');
        $deptDesc = $request->input('txt_dept_desc');

        $response = $this->api->request('POST', 'departments', [
            'json' => [
                'code' => $deptCode,
                'name' => $deptName,
                'desc' => $deptDesc,
            ]
        ]);

        return redirect('departments')->with('message', 'Successfully added department');
    }

    public function edit(Request $request, $id) {
        
    }

    public function delete(Request $request, $id) {
        
    }

}
