<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class User1Service{

    use ConsumesExternalService;

    /**
     * The base uri to consume the User1 Service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to consume the User1 Service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.users1.base_uri');
       
    }
}