<?php

namespace App\Http\Controllers\REST\V1\Auth;

use App\Http\Controllers\REST\BaseREST;
use Firebase\JWT\JWT;

class Account extends BaseREST
{
    public function __construct(
        ?array $payload = [],
        ?array $file = [],
        ?array $auth = []
    ) {
        $this->payload = $payload;
        $this->file = $file;
        $this->auth = $auth;
    }

    /**
     * @var array Property that contains the payload rules
     */
    protected $payloadRules = [];

    /**
     * @var array Property that contains the privilege data
     */
    protected $privilegeRules = [];


    /**
     * The method that starts the main activity
     * @return null
     */
    protected function mainActivity($id = null)
    {
        return $this->nextValidation();
    }

    /**
     * Handle the next step of payload validation
     * @return void
     */
    private function nextValidation()
    {
        return $this->get();
    }

    /** 
     * Function to get data 
     * @return object
     */
    public function get()
    {
        $reqTime = time();
        $expTime = $reqTime + (3600 * 24); // 1 Hour * 24: Expires in 24 hours
        $jwtObject = [
            'iss' => 'Putsutech JWT Authentication',
            'iat' => $reqTime,
            'exp' => $expTime,
            'uid_b64' => base64_encode($this->auth['uuid']),
            'username' => $this->auth['username']
        ];

        $response = [
            'token' => JWT::encode($jwtObject, env('APP_KEY'), 'HS256'),
        ];

        return $this->respond(200, $response);
    }
}
