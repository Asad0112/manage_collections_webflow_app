<?php

error_reporting(1);
ini_set('display_errors', true);
require_once('vendor/autoload.php');
require_once('config/app.php');
session_start();

class Api
{
    protected $endPoint;
    protected $method = 'GET';
    protected $accessToken;
    protected $response = [];
    protected $params = [];
    protected $apiBaseUrl = 'https://api.webflow.com/v2/';

    public function __construct()
    {
    }

    public function setEndPoint($endPoint)
    {
        $this->endPoint = $endPoint;
        return $this;
    }

    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    public function callApi()
    {
        try {
            $client = new \GuzzleHttp\Client();

            $url = $this->apiBaseUrl . $this->endPoint;

            if ($this->method == 'GET') {
                $data = [
                    'headers' => [
                        'accept' => 'application/json',
                        'authorization' => 'Bearer ' . $this->accessToken,
                    ]
                ];
            } else if ($this->method == 'PATCH') {
                $data = [
                    'headers' => [
                        'accept' => 'application/json',
                        'authorization' => 'Bearer ' . $this->accessToken,
                    ],
                    'body' => $this->params
                ];
            }

            $response = $client->request($this->method, $url, $data);

            $this->response = json_decode($response->getBody(), TRUE);
        } catch (Exception $e) {
            $this->response = ['message' => $e->getMessage(), 'url' => $url];
        }
        return $this;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function sendResponse()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($this->response);
    }
}
