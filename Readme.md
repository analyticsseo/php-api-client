# Analytics SEO Official PHP API client

## Instalation
### Via Composer
1. run ```composer require  require "aseo/api:*"```

### Manual installation
1. clone repository
2. go to the cloned folder folder
3. run ```composer install``` 

to test the installation go to ```tests\functional``` folder and run ```php serps.php```
> **Do not forget to edit the file and add your credentials, or all tests will fail**

## Sample Usage
```php
<?php
// only  needed if you run it directly, any modern framework deals with autoloading out of the box
// include  '<PATH TO COMPOSER AUTOLOAD FILE'; 



// initialize the HTTP Transport Layer
$guzzle = new Guzzle\Http\Client('http://v3.api.analyticsseo.com');

// Setup Request Authentication
$auth = new Aseo\Api\Auth\KeyAuth;
$auth->setApiKey(API_KEY); // do not forget to change this with the values provided by Analytics SEO
$auth->setApiSecret(API_SECRET);  // do not forget to change this with the values provided by Analytics SEO
$auth->setSalt(SALT);  // do not forget to change this with the values provided by Analytics SEO


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

// store the job id, it will be used to fetch the data as soon as the job is done
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
