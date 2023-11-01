<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE PATCH');
require_once('classes/Api.php');

$api = new Api();

$response = $api->setEndPoint($_REQUEST['endPoint'])->setMethod($_REQUEST['method'] ?? 'GET')
    ->setAccessToken('6d82f04f3b18947bf4e9ffb797117ba8d5e385ffd35728751724fe787e97eae3')
    ->setParams($_REQUEST['params'])
    ->callApi()
    ->sendResponse();
