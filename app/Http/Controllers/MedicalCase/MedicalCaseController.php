<?php

namespace App\Http\Controllers\MedicalCase;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Exception;

class MedicalCaseController extends Controller {

    public function index(Request $request) {
        $page = $request->query('page', 1);

        $response = $this->api->request(Request::METHOD_GET, "cases?page={$page}");

        $body = json_decode($response->getBody());
        
        $paginator = new LengthAwarePaginator($body->data->medical_cases, $body->total, 1, \Illuminate\Pagination\Paginator::resolveCurrentPage(), ['path' => $request->path()]);

        return view('medical_case.index', ['paginator' => $paginator]);
    }

    public function create(Request $request, $id = null) {
        if ($request->method() == Request::METHOD_GET) {
            if (is_null($id)) {
                return view('medical_case.add');
            } else {
                $response = $this->api->request(Request::METHOD_GET, "patients/{$id}");
                $body1 = json_decode($response->getBody());

                return view('medical_case.add', [
                    'med_case_num' => sprintf("MCN-%s%s", strtotime('now'), mt_rand(10000, 99999)),
                    'patient' => $body1->data->patient,
                ]);
            }
        }
    }

    public function store(Request $request) {
        $request->flash();

        $this->validate($request, [
            'txt_med_case_num' => 'bail|required',
            'hdn_patient_id' => 'bail|required',
            'hdn_departments' => 'bail|required',
            'hdn_diagnoses' => 'bail|required',
        ]);

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
