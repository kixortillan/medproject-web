<?php

namespace App\Http\Controllers\MedicalCase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class DiagnosisController extends Controller {

    public function index(Request $request) {
        $response = $this->api->request('GET', 'departments');

        $departments = json_decode($response->getBody());

        return view('diagnosis.index', ['diagnoses' => $departments->data->departments]);
    }

    public function search(Request $request) {
        $keyword = $request->query('query', null);

        $response = $this->api->request("GET", "search/diagnoses?keyword={$keyword}");

        $apiResult = json_decode($response->getBody());

        $json = [];

        foreach ($apiResult->data->diagnoses as $item) {
            $json[] = [
                'name' => $item->name,
                'desc' => $item->desc,
            ];
            //$json[] = $item->name;
        }

        return response()->json($json);
        //return response()->json(["query" => $keyword, "suggestions" => $json]);
    }

}
