<?php
require_once 'vendor/autoload.php';
require_once 'class-db.php';
  
define('GOOGLE_CLIENT_ID', '874596594417-nuprht6pm4t7rm07k6dlg64hpic5du4f.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
  
$config = [
    'callback' => 'https://astro-24/EKundali/Sheets/callback.php',
    'keys'     => [
                    'id' => GOOGLE_CLIENT_ID,
                    'secret' => GOOGLE_CLIENT_SECRET
                ],
    'scope'    => 'https://www.googleapis.com/auth/spreadsheets',
    'authorize_url_parameters' => [
            'approval_prompt' => 'force', // to pass only when you need to acquire a new refresh token.
            'access_type' => 'offline'
    ]
];
  
$adapter = new Hybridauth\Provider\Google( $config );