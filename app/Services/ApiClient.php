<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class ApiClient
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.api.base_url');
    }

    protected function client(): PendingRequest
    {
        $request = Http::baseUrl($this->baseUrl)
            ->acceptJson();

        if (session()->has('api_token')) {
            $request = $request->withToken(session('api_token'));
        }

        return $request;
    }

    public function get(string $endpoint, array $query = [])
    {
        return $this->client()->get($endpoint, $query);
    }

    public function post(string $endpoint, array $data = [])
    {
        return $this->client()->post($endpoint, $data);
    }

    /**
     * Upload file (POST)
     */
    public function postMultipart(
        string $endpoint,
        array $data = [],
        ?UploadedFile $file = null,
        string $field = 'image'
    ) {
        $request = $this->client();

        if ($file instanceof UploadedFile) {
            $request = $request->attach(
                $field,
                file_get_contents($file->getRealPath()),
                $file->getClientOriginalName()
            );
        }

        return $request->post($endpoint, $data);
    }

    /**
     * Upload file (PUT)
     */
    
    public function putMultipart(
        string $endpoint,
        array $data = [],
        ?UploadedFile $file = null,
        string $field = 'image'
    ) {
        $request = $this->client();

        $data['_method'] = 'PUT';

        if ($file instanceof UploadedFile) {
            $request = $request->attach(
                $field,
                file_get_contents($file->getRealPath()),
                $file->getClientOriginalName()
            );
        }

        return $request->post($endpoint, $data); 
    }

    public function patch(string $endpoint, array $data = [])
    {
        return $this->client()->patch($endpoint, $data);
    }

    public function put(string $endpoint, array $data = [])
    {
        return $this->client()->put($endpoint, $data);
    }

    public function delete(string $endpoint)
    {
        return $this->client()->delete($endpoint);
    }
}
