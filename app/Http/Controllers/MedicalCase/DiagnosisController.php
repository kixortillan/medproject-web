<?php

namespace App\Http\Controllers\MedicalCase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class DiagnosisController extends Controller {
    
    public function search(Request $request) {
        $keyword = $request->query('query', null);

        $response = $this->api->request("GET", "search/diagnoses?keyword={$keyword}");

        $apiResult = json_decode($response->getBody());

        $json = [];

        foreach ($apiResult->data->diagnoses as $item) {
            $json[] = [
                'value' => $item->name,
                'data' => $item->desc,
            ];
        }

        return response()->json(["query" => $keyword, "suggestions" => $json]);
    }
}
