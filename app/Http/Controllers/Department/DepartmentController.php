<?php

namespace App\Http\Controllers\Department;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class DepartmentController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(Request $request) {
        $response = $this->api->request('GET', 'departments');

        $body = json_decode($response->getBody());

        $paginator = new LengthAwarePaginator($body->data->departments, $body->total, 1, Paginator::resolveCurrentPage(), ['path' => $request->path()]);

        return view('department.index', [
            'paginator' => $paginator
        ]);
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

    public function edit(Request $request, $id) {
        if ($request->method() == Request::METHOD_GET) {
            $response = $this->api->request("GET", "departments/{$id}");

            $body = json_decode($response->getBody());

            return view('department.edit', ['department' => $body->data->department]);
        }
    }

    public function delete(Request $request, $id) {
        try {
            $response = $this->api->request('DELETE', "departments/{$id}");

            $result = json_decode($response->getBody());

            return redirect('departments');
        } catch (Exception $ex) {
            
        }
    }

    public function search(Request $request) {
        $keyword = $request->query('query', null);

        $response = $this->api->request("GET", "search/departments?keyword={$keyword}");

        $departments = json_decode($response->getBody());

        $json = [];

        foreach ($departments->data->departments as $item) {
            $json[] = [
                'name' => $item->name,
                'code' => $item->code,
                'desc' => $item->desc,
            ];
        }

        return response()->json($json);
    }

}
