<?php

# Application's Name
define('APP_NAME', 'Webflow App in PHP');

# Your application's Client ID.
define('CLIENT_ID', 'bd884d8711812f585770de92fdac8ab96a4dcf9dcd4b19fdf7eb4b87c4440e68');

# Your application's Client Secret.
define('CLIENT_SECRET', '89d3531e8aa6d9f974f425a43377454cb175e700269ec23c49f78e85b20fdad9');

# Define the Scopes that your app needs here.
define('SCOPES', 'assets:read assets:write authorized_user:read cms:read cms:write custom_code:read custom_code:write forms:read forms:write pages:read pages:write sites:read sites:write');

# End-point to start the process of Authroization.
define('AUTHORIZATION_URL', 'https://webflow.com/oauth/authorize');

# Default Response Type.
define('RESPONSE_TYPE', 'code');

# Default Grant Type.
define('GRANT_TYPE', 'authorization_code');
