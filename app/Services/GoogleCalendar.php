<?php

namespace App\Services;
use Google\Service\Directory;
use Google\Client;
use Google\Service\Calendar;

class GoogleCalendar
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
        // Configure the Google Client with your credentials and other settings
    }

    public function getClient()
    {
    $client = new Client();
    $client->setApplicationName(config('app.name'));
    $client->setScopes(Directory::ADMIN_DIRECTORY_RESOURCE_CALENDAR_READONLY);
    $client->setAuthConfig(storage_path('keys/client_secret.json'));
    $client->setAccessType('offline');
    //$client->setApprovalPrompt('force');
    $client->setPrompt('consent');
    $redirect_uri = url('/google-calendar/auth-callback');
    $client->setRedirectUri($redirect_uri);
    return $client;
    }

    public function oauth()

    {

    $client = $this->getClient();



    // Load previously authorized credentials from a file.

    $credentialsPath = storage_path('keys/client_secret_generated.json');

    if (!file_exists($credentialsPath)) {

    return false;

    }



    $accessToken = json_decode(file_get_contents($credentialsPath), true);

    $client->setAccessToken($accessToken);



    // Refresh the token if it's expired.

    if ($client->isAccessTokenExpired()) {

    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());

    file_put_contents($credentialsPath, json_encode($client->getAccessToken()));

    }

    return $client;



    }


function getResource($client)

{

$service = new Calendar($client);
// On the user's calenda print the next 10 events .
$calendarId = 'primary';

$optParams = array(

  'maxResults' => 10,

  'orderBy' => 'startTime',

  'singleEvents' => true,

  'timeMin' => date('c'),

);

$results = $service->events->listEvents($calendarId, $optParams);

$events = $results->getItems();



if (empty($events)) {

    print "No upcoming events found.\n";

} else {

    print "Upcoming events:\n";

    foreach ($events as $event) {

        $start = $event->start->dateTime;

        if (empty($start)) {

            $start = $event->start->date;

        }

        printf("%s (%s)\n", $event->getSummary(), $start);

    }

}

}
}

