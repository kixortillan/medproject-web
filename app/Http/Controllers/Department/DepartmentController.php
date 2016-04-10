<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DepartmentController extends Controller {

    public function index() {
        $client = new Client([
            'base_uri' => config('api.url'),
            'timeout' => '5'
        ]);

        $response = $client->request('GET', '/departments');

        $departments = json_decode($response->getBody());

        return view('department.index', ['departments' => $departments]);
    }

    public function addDepartment(Request $request) {
        $deptCode = $request->input('txt_dept_code');
        $deptName = $request->input('txt_dept_name');
        $deptDesc = $request->input('txt_dept_desc');

        $client = new Client([
            'base_uri' => config('api.url'),
            'timeout' => '5'
        ]);

        $response = $client->request('POST', '/departments', [
            'json' => [
                'code' => $deptCode,
                'name' => $deptName,
                'desc' => $deptDesc,
            ]
        ]);

        return view('add.index')->with('message', 'Successfully added department');
    }

}
