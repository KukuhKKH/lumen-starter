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
            $error_msg = 'Aksi gagal ';
            if($statusCode == 0) $statusCode = 500;
            if ($statusCode == 500) {
                $message = (env('APP_ENV') == "local" && env('APP_DEBUG') == "true") ? $error_msg . " [" . $message. "]" : $error_msg;
            }
            return $factory->make([
                'status' => false,
                'message' => $message
            ], $statusCode);
        });
    }
}
