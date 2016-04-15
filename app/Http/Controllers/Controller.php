<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use GuzzleHttp\Client;
use Exception;

class Controller extends BaseController {

    use AuthorizesRequests,
        AuthorizesResources,
        DispatchesJobs,
        ValidatesRequests;

    protected $api;

    public function __construct() {
        try {
            $this->api = new Client([
                'base_uri' => config('api.url'),
                'timeout' => '5'
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
