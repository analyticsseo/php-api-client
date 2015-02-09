<?php

include __DIR__ . '/../../vendor/autoload.php';

// define('API_KEY', 'a');
// define('API_SECRET', 'b');
// define('SALT', 'c');

include 'settings.php';

$guzzle = new Guzzle\Http\Client('http://v3.api.analyticsseo.com');

$auth = new Aseo\Api\Auth\KeyAuth;
$auth->setApiKey(API_KEY);
$auth->setApiSecret(API_SECRET);
$auth->setSalt(SALT);

$serps = new Aseo\Api\V3\Serps\SerpsApiClient($guzzle, $auth);
$serps->debug = true;

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
