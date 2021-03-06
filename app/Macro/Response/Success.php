<?php

namespace App\Macro\Response;

use App\Macro\Contracts\ResponseMacroContract;

class Success implements ResponseMacroContract
{
    /**
     * Run macro.
     *
     * @param ResponseFactory $factory
     * @return void
     */
    public function run($factory)
    {
        $factory->macro('success', function ($data = [], $message = '', $statusCode = 200) use ($factory) {
            return $factory->make([
                'status' => true,
                'message' => $message,
                'data' => $data,
            ], $statusCode);
        });
    }
}
