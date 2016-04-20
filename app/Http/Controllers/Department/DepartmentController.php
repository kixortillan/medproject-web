<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class DepartmentController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $response = $this->api->request('GET', 'departments');

        $departments = json_decode($response->getBody());

        return view('department.index', ['departments' => $departments->data]);
    }

    public function store(Request $request) {
        if ($request->method() == Request::METHOD_GET) {
            return view('department.add');
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

    public function edit(Request $request) {
        
    }

    public function delete(Request $request, $id) {
        try {
            $response = $this->api->request('DELETE', "departments/{$id}");

            $result = json_decode($response->getBody());

            return redirect('departments');
        } catch (Exception $ex) {
            
        }
    }

}
