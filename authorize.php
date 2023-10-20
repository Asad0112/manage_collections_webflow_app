<?php
error_reporting(1);
ini_set('display_errors', true);
require_once('vendor/autoload.php');
require_once('config/app.php');
session_start();

try {
    # Get the Authorization Code.
    if (isset($_GET['code'])) {
        $code = $_GET['code'];

        $client = new \GuzzleHttp\Client();

        # Call the API using the received Authorization code to get the Bearer Access Token.
        $acessTokenResponse = $client->request('POST', 'https://api.webflow.com/oauth/access_token', [
            'form_params'       => [
                'client_id'     => CLIENT_ID,
                'client_secret' => CLIENT_SECRET,
                'code'          => $code,
                'grant_type'    => GRANT_TYPE
            ],
        ]);

        $acessTokenResponseJson = $acessTokenResponse->getBody();

        if ($acessTokenResponseJson) {

            $responseArr = json_decode($acessTokenResponseJson, TRUE);

            # Call the API using the extracted Access Token to fetch the User Details.
            if (isset($responseArr['access_token'])) {
                $accessToken = $responseArr['access_token'];

                $authorizedUserResponse = $client->request('GET', 'https://api.webflow.com/v2/token/authorized_by', [
                    'headers'            => [
                        'accept'         => 'application/json',
                        'authorization'  => 'Bearer ' . $accessToken,
                    ],
                ]);


                $authorizedUserResponseJson = $authorizedUserResponse->getBody();

                $authorizedUserResponseArr = json_decode($authorizedUserResponseJson, TRUE);


                $_SESSION['userDetails'] = $authorizedUserResponseArr;


                if (!empty($authorizedUserResponseArr)) {
                    header('Location: '.NG_ROK_URL.'/projects/replace_text_webflow_app/public/?access_token=' . $authorizedUserResponseJson);
                } else {
                    header('Location: '.NG_ROK_URL.'/projects/replace_text_webflow_app/');
                }
            }
        }
    }
} catch (GuzzleHttp\Exception\ClientException $e) {
    header('Location: '.NG_ROK_URL.'/projects/replace_text_webflow_app/');
}
