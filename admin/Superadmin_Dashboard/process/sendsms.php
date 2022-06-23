<?php
// require __DIR__ . '/vendor/autoload.php';
require '/vendor/autoload.php';

use Twilio\Rest\Client;


// Your Account SID and Auth Token from twilio.com/console
$account_sid = getenv('AC55002d14ff85987b3e98a9d11b68749d');
$auth_token = getenv('7e406202fe3d776219d620d53836d37a');
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

// A Twilio number you own with SMS capabilities
$twilio_number = "+1 850 721 1391";

$client = new Client($account_sid, $auth_token);
$client->messages->create(
    // Where to send a text message (your cell phone?)
    '+639091430379',
    array(
        'from' => $twilio_number,
        'body' => 'I sent this message in under 10 minutes!'
    )
);
