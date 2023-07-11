<?php

namespace LeandroFerreiraMa\GoogleAuth;

class Auth
{
    private string $apiUrl;
    private string $endpoint;
    private array $fields;
    private string $method;
    protected ?object $response;

    public function __construct()
    {
        $this->apiUrl = 'https://www.googleapis.com/oauth2/v4';
        $this->method = 'POST';
        $this->endpoint = 'token';
    }

    public function url(string $clientId, string $uriRedirect, string $scope = 'https://www.googleapis.com/auth/calendar'): string
    {
        $param = [
            'scope' => $scope,
            'redirect_uri' => $uriRedirect,
            'response_type' => 'code',
            'access_type' => 'offline',
            'client_id' => $clientId,
            'prompt' => 'select_account consent'
        ];

        $param = array_map("strip_tags", $param);

        return "https://accounts.google.com/o/oauth2/auth?".http_build_query($param);
    }

    public function accessToken(string $clientId, string $uriRedirect, string $clientSecret, string $code): ?object
    {
        $this->fields = array_map("strip_tags", [
            'client_id' => $clientId,
            'redirect_uri' => $uriRedirect,
            'client_secret' => $clientSecret,
            'code' => $code,
            'grant_type' => 'authorization_code'
        ]);

        $this->dispatch();
        return $this->response;
    }

    public function refreshToken(string $clientId, string $clientSecret, string $refreshToken): ?object
    {
        $this->fields = array_map("strip_tags", [
            'client_id' => $clientId,
            'client_secret' => $clientSecret, 
            'refresh_token' => $refreshToken,
            'access_type' => 'consent',
            'grant_type' => 'refresh_token'
        ]);

        $this->dispatch();
        return $this->response;
    }

    private function dispatch(): void
    {
        $curl = curl_init();
        $fields = http_build_query($this->fields);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "{$this->apiUrl}/{$this->endpoint}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $this->method,
            CURLOPT_POSTFIELDS => $fields,
            CURLOPT_HTTPHEADER => [],
        ));

        $this->response = json_decode(curl_exec($curl));
        curl_close($curl);
    }
}