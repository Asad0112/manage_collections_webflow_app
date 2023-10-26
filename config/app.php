<?php

# Application's Name
define('APP_NAME', 'Manage Collections Webflow App in PHP');

# Your application's root URL.
define('APP_URL', 'https://b07c-2406-b400-d5-737e-f127-16ee-3edd-15e3.ngrok-free.app/projects/webflow_applications/manage_collections_app/');

# Your application's Client ID.
define('CLIENT_ID', '6cf70d05ffdea4b21ca10bbc6cc36902108563e8c42844fbc4537447faccda25');

# Your application's Client Secret.
define('CLIENT_SECRET', '5211aaaf688c0f8e6fb11cd91ca13b28b454190409c61196b6c3b6262485b65a');

# Define the Scopes that your app needs here.
define('SCOPES', 'assets:read assets:write authorized_user:read cms:read cms:write custom_code:read custom_code:write forms:read forms:write pages:read pages:write sites:read sites:write');

# End-point to start the process of Authroization.
define('AUTHORIZATION_URL', 'https://webflow.com/oauth/authorize');

# Default Response Type.
define('RESPONSE_TYPE', 'code');

# Default Grant Type.
define('GRANT_TYPE', 'authorization_code');

