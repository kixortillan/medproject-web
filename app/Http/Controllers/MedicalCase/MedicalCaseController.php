<?php

namespace App\Http\Controllers\MedicalCase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Exception;

class MedicalCaseController extends Controller {

    public function index() {
        return view('medical_case.index');
    }

    public function store(Request $request) {
        if ($request->method() == Request::METHOD_GET) {
            return view('medical_case.add');
        }
        
        try{
            return redirect('cases');
        } catch (Exception $ex) {

        }
    }

    public function edit() {
        
    }

    public function delete() {
        
    }

}
