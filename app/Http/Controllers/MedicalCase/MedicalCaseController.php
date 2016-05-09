<?php

namespace App\Http\Controllers\MedicalCase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class MedicalCaseController extends Controller {

    public function index() {
        return view('medical_case.index');
    }

    public function create(Request $request, $id = null) {
        if ($request->method() == Request::METHOD_GET) {
            if (is_null($id)) {
                return view('medical_case.add');
            } else {
                $response = $this->api->request(Request::METHOD_GET, "patients/{$id}");
                $body1 = json_decode($response->getBody());

                return view('medical_case.add', [
                    'patient' => $body1->data->patient,
                ]);
            }
        }
    }

    public function store(Request $request) {
        try {
            $medCaseNum = $request->input('txt_med_case_num');
            $patientId = $request->input('hdn_patient_id');
            $departmentIds = $request->input('hdn_departments');
            $diagnoses = $request->input('hdn_diagnoses');

            $this->api->request(Request::METHOD_POST, "cases", [
                'json' => [
                    'serial_num' => $medCaseNum,
                    'patient_id' => $patientId,
                    'departments' => $departmentIds,
                    'diagnosis' => $diagnoses,
                ]
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function edit() {
        
    }

    public function delete() {
        
    }

}
