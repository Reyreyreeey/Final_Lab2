<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class User2Service{

    use ConsumesExternalService;

    /**
     * The base uri to consume the User2 Service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to consume the User2 Service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.users2.base_uri');
      
    }
}