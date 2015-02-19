# Analytics SEO Official PHP API client

## Installation
### Via Composer
1. Run the command: ```composer require "aseo/api:*"```

### Manual Installation
1. Clone this repository: ``git clone git@github.com:analyticsseo/php-api-client.git``
2. Change to the cloned folder, e.g.: ``cd php-api-client``
3. Run command ```composer install``` 

## Testing Your Installation
1. Browse to folder ```tests\functional```
2. Edit file ```serps.php```, add your credentials, and save.
3. Run ```php serps.php```

> **Do not forget to edit the ```serps.php``` file and add your credentials, or all tests will fail**

## Sample Usage
```php
<?php
// Uncomment the following if you run this file directly, any modern framework
// deals with autoloading out of the box.
// include  '<PATH TO COMPOSER AUTOLOAD FILE'; 

// Initialize the HTTP Transport Layer.
$guzzle = new Guzzle\Http\Client('http://v3.api.analyticsseo.com');

// Setup Request Authentication.
$auth = new Aseo\Api\Auth\KeyAuth;

// Do not forget to change API_KEY, API_SECRET, and SALT with
// the values provided by Analytics SEO.
$auth->setApiKey(API_KEY);
$auth->setApiSecret(API_SECRET);
$auth->setSalt(SALT);


// The V3 SERPs Client.
$serps = new Aseo\Api\V3\Serps\SerpsApiClient($guzzle, $auth);

// Set to true to output raw http requests.
$serps->debug = false;

// Define query paramaters, as per documentation.
$query = array(
  'region'=>'global',
  'search_engine' => 'google',
  'phrase' => 'abc',
  'universal' => 0,
);

// Create a SERPs request object.
$data = new Aseo\Api\V3\Serps\SerpsRequest($query);

// Make the call.
$searchResultsResponse = $serps->searchResults($data);

// Store the job id, this will be used to fetch the data as soon as the job is
// done.
$jobId = $searchResultsResponse['jid'];

// Check to see if job is ready. If not, try again later. You can also execute
// all queries, store the job ids, and later query to see each job id is ready.
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
