<?php

include __DIR__ . '/../../vendor/autoload.php';

// Uncommoment the following lines and add the proper values
// define('API_KEY', 'a');
// define('API_SECRET', 'b');
// define('SALT', 'c');

// optionaly you can define the constansts in a file named settings.php
@include 'settings.php';

$guzzle = new Guzzle\Http\Client('http://v3.api.analyticsseo.com');

$auth = new Aseo\Api\Auth\KeyAuth;
$auth->setApiKey(API_KEY);
$auth->setApiSecret(API_SECRET);
$auth->setSalt(SALT);

$serps = new Aseo\Api\V3\Serps\SerpsApiClient($guzzle, $auth);
$serps->debug = false;

$query = array(
    'region'=>'global',
    'search_engine' => 'google',
    'phrase' => 'abc',
    'universal' => 0,
);

$data = new Aseo\Api\V3\Serps\SerpsRequest($query);

$searchResultsResponse = $serps->searchResults($data);


$jobId = $searchResultsResponse['jid'];

while (true) {
    $fetchJobResponse = $serps->fetchJobData($jobId);

    if (false == $fetchJobResponse['ready']) {
        sleep(3);
        continue;
    }

    var_export($fetchJobResponse);
    break;
}
