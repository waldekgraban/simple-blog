<?php

namespace App\Http\Repositories;

abstract class Repository
{
    protected function getContent($stream)
    {
        $response = $stream->getBody()->getContents();

        return json_decode($response, true);
    }
}