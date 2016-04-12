<?php

namespace App\Http\Controllers\MedicalCase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Exception;

class PatientController extends Controller {

    public function index() {
        return view('patient.index');
    }

}
