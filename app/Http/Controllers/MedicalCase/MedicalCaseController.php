<?php

namespace App\Http\Controllers\MedicalCase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class MedicalCaseController extends Controller {

    public function index() {
        return view('medical_case.index');
    }

    public function store(Request $request, $id = null) {
        if ($request->method() == Request::METHOD_GET) {
            if (is_null($id)) {
                return view('medical_case.add');
            } else {
                $response = $this->api->request(Request::METHOD_GET, "patients/{$id}");
                $body1 = json_decode($response->getBody());

                $response = $this->api->request(Request::METHOD_GET, "departments?per_page=-1");
                $body2 = json_decode($response->getBody());

                return view('medical_case.add', [
                    'patient' => $body1->data->patient,
                    'departments' => $body2->data->departments
                ]);
            }
        }

        try {
            return redirect('cases');
        } catch (Exception $ex) {
            
        }
    }

    public function edit() {
        
    }

    public function delete() {
        
    }

}
