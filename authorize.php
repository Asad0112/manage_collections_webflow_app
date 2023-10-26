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

                    # Call the API to Get the Site IDs attached to workplace.
                    $siteList = $client->request('GET', 'https://api.webflow.com/v2/sites', [
                        'headers' => [
                            'accept' => 'application/json',
                            'authorization' => 'Bearer ' . $accessToken,
                        ],
                    ]);
                    $siteListJson = $siteList->getBody();
                    $siteListArr  = json_decode($siteListJson, TRUE);

                    # If Site Id's are not empty
                    if (!empty($siteListArr) && !empty($siteListArr['sites'])) {
                        $siteIds = array_column($siteListArr['sites'], 'id');

                        if (!empty($siteIds)) {
                            foreach ($siteIds as $siteId) {

                                # Call the API to Get the List of Collections assoicated with the list of sites.
                                $collectionsList = $client->request('GET', 'https://api.webflow.com/v2/sites/' . $siteId . '/collections', [
                                    'headers' => [
                                        'accept' => 'application/json',
                                        'authorization' => 'Bearer ' . $accessToken,
                                    ],
                                ]);
                                $collectionListJson = $collectionsList->getBody();
                                $collectionListArr = json_decode($collectionListJson, TRUE);

                                # If list of collections is not empty.
                                if (!empty($collectionListArr) && !empty($collectionListArr['collections'])) {

                                    foreach ($collectionListArr['collections'] as $key =>  $collection) {

                                        # Get the project details attached to the sites in which app is installed.
                                        if ($collection['slug'] == 'project') {
                                            $projectList = $client->request('GET', 'https://api.webflow.com/v2/collections/' . $collection['id'] . '/items', [
                                                'headers' => [
                                                    'accept' => 'application/json',
                                                    'authorization' => 'Bearer ' . $accessToken,
                                                ],
                                            ]);
                                        }
                                    }
                                    $projectJson = $projectList->getBody();

                                    $projectsArr  = json_decode($projectJson, TRUE);


                                    $projectDetails[] = array_column($projectsArr['items'], 'fieldData');
                                }
                            }

                            if (!empty($projectDetails)) {
                                $projectDetails = call_user_func_array('array_merge', $projectDetails);
                                $siteIdDetails = implode(' & ', $siteIds);
                                require_once('project_list.php');
                            } else {
                                header('Location: ' . APP_URL);
                            }
                        }
                    }
                } else {
                    header('Location: ' . APP_URL);
                }
            }
        }
    }
} catch (\GuzzleHttp\Exception\ClientException $e) {
    header('Location: ' . APP_URL);
}
