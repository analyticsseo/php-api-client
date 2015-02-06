<?php

include __DIR__ . '/../../vendor/autoload.php';
include 'settings.php';

$guzzle = new Guzzle\Http\Client('http://v3.api.analyticsseo.com');

$auth = new Aseo\Api\Auth\KeyAuth;
$auth->setApiKey(API_KEY);
$auth->setApiSecret(API_SECRET);
$auth->setSalt(SALT);

$serps = new Aseo\Api\V3\Serps\SerpsApiClient($guzzle, $auth);


$query = array(
    'region'=>'global',
    'search_engine' => 'google',
    'phrase' => 'abc',
    'max_results' => 10,
    'universal' => 0,
);

$data = new Aseo\Api\V3\Serps\SerpsRequest($query);

$searchResultsResponse = $serps->searchResults($data);

sleep(10);

$jobId = $searchResultsResponse['jid'];

while (true) {
    $fetchJobResponse = $serps->fetchJobData($jobId);
    if (false == $fetchJobResponse['ready']) {
        sleep(10);
        continue;
    }

    var_export($fetchJobResponse);
}
