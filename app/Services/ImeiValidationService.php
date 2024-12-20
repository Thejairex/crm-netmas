<?php

namespace App\Services;

class ImeiValidationService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function checkImeiCompatibility($imei) {
        return (strlen($imei) == 15);
    }
}
