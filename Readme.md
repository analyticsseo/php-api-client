# Analytics SEO Official PHP API client

## PHP Client

### Pre requisites
1. a working php version > 5.3
2. composer should be installed, see [composer](http://www.getcomposer.org) for details how to install

### Installation

1. clone repository
2. go to the cloned folder folder
3. run ```composer.phar install``` _(please refer to composer documentation for your operating system to find the proper way to execute it, on windows systems ```composer install``` seems to do the trick)_

to test the installation go to ```tests\functional``` folder and run ```php serps.php```

_integration into packagist.org is comming soon_

## Sample Usage
```php
<?php
include __DIR__ . '/../../vendor/autoload.php';

define('API_KEY', 'a');
define('API_SECRET', 'b');
define('SALT', 'c');

// initialize the HTTP Transport Layer
$guzzle = new Guzzle\Http\Client('http://v3.api.analyticsseo.com');

// Setup Request Authentication
$auth = new Aseo\Api\Auth\KeyAuth;
$auth->setApiKey(API_KEY);
$auth->setApiSecret(API_SECRET);
$auth->setSalt(SALT);


// The V3 SERPs Client
$serps = new Aseo\Api\V3\Serps\SerpsApiClient($guzzle, $auth);

$serps->debug = false; // set to true to output raw http requests

// Define query paramaters, as per documentation
$query = array(
    'region'=>'global',
    'search_engine' => 'google',
    'phrase' => 'abc',
    'universal' => 0,
);

// create a SERPs request object
$data = new Aseo\Api\V3\Serps\SerpsRequest($query);

// make the call
$searchResultsResponse = $serps->searchResults($data);

// store the job id, it will be usedfull to fetch the data as soon as the job is done
$jobId = $searchResultsResponse['jid'];

// check to see if job is ready, if not try again later
// you can also execute all queries, store the job ids and later query to see each job id is ready
while (true) {
    $fetchJobResponse = $serps->fetchJobData($jobId);
    if (false == $fetchJobResponse['ready']) {
        sleep(3);
        continue;
    }
    var_export($fetchJobResponse);
    break;
}
```
