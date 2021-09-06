<?php

namespace App\Macro\Response;

use App\Macro\Contracts\ResponseMacroContract;

class Error implements ResponseMacroContract
{
    /**
     * Run macro.
     *
     * @param ResponseFactory $factory
     * @return void
     */
    public function run($factory)
    {
        $factory->macro('error', function ($message = 'bad request', $statusCode = 400) use ($factory) {
            return $factory->make([
                'status' => false,
                'message' => $message
            ], $statusCode);
        });
    }
}
