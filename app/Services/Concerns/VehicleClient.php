<?php

namespace App\Services\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

trait VehicleClient
{
    protected function withBaseUrl(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl);
    }

    protected function getRequest(string $path, array $params = []): Response
    {
        return $this->withBaseUrl()->get($path, array_merge([
            'format' => 'json'
        ], $params));
    }
}
