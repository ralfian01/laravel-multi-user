<?php

namespace App\Http\Controllers\REST\V1\Endpoints;

use App\Http\Controllers\REST\BaseREST;

class Endpoint2 extends BaseREST
{
    public function __construct(
        ?array $payload = [],
        ?array $file = [],
        ?array $auth = [],
        // ?DBRepo $dbRepo = null
    ) {

        $this->payload = $payload;
        $this->file = $file;
        $this->auth = $auth;
        // $this->dbRepo = $dbRepo ?? new DBRepo();
        return $this;
    }

    /**
     * @var array Property that contains the payload rules
     */
    protected $payloadRules = [];

    /**
     * @var array Property that contains the privilege data
     */
    protected $privilegeRules = [
        'ADMIN_MANAGE_VIEW'
    ];


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
        return $this->respond(200);
    }
}
