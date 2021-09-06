<?php

namespace App\Macro\Contracts;

interface ResponseMacroContract
{
    /**
     * Run macro.
     * 
     * @param ResponseFactory $factory
     * @return void
     */
    public function run($factory);
}