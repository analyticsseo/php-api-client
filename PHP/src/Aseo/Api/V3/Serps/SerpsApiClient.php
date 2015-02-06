<?php
namespace Aseo\Api\V3\Serps;

/**
* Analytics SEO PHP CLient
*
* Serach Engine results page CLient

* @version 3
*
* @author Nuno Franco da Costa <nuno@francodacosta.com>
* @copyright 2014 Analytics SEO ltd
* @license http://www.opensource.org/licenses/mit-license.php MIT
* @link https://github.com/analyticsseo/api-client/
*/

use Aseo\Api\Auth\AuthInterface;
use \Guzzle\Http\Client as GuzzleClient;

class SerpsApiClient
{
    /**
     * HTTP transport
     * @var \Guzzle\Http\Client
     */
    private $transport;

    /**
     * AUthentication Mechanism
     * @var AuthInterface
     */
    private $auth;

    public function __construct(\Guzzle\Http\Client $transport, AuthInterface $auth)
    {
        $this->setTransport($transport);
        $this->setAuth($auth);
    }

    /**
     * Get the value of HTTP transport
     *
     * @return \Guzzle\Http\Client
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Set the value of HTTP transport
     *
     * @param \Guzzle\Http\Client transport
     *
     * @return self
     */
    public function setTransport(\Guzzle\Http\Client $transport)
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * Get the value of AUthentication Mechanism
     *
     * @return AuthInterface
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * Set the value of AUthentication Mechanism
     *
     * @param AuthInterface auth
     *
     * @return self
     */
    public function setAuth(AuthInterface $auth)
    {
        $this->auth = $auth;

        return $this;
    }


    /**
     * executes the api call
     *
     * @param string $data
     */
    public function searchResults($data)
    {
        $authHeader = $this->getAuth()->computeHash();
        $authParts = explode(':', $authHeader);

        $this->transport->addSubscriber(\Guzzle\Plugin\Log\LogPlugin::getDebugPlugin());
        $request =  $this->transport->post(
            '/search_results/',
            [
                'Content-Type' => "application/json",
                $authParts[0] => $authParts[1],
            ]
        );

        $request->setBody($data); #set body!

        $response = $request->send();

        return $response->json();
    }

    /**
     * executes the api call
     *
     * @param string $id the job id
     */
    public function fetchJobData($id)
    {
        $authHeader = $this->getAuth()->computeHash();
        $authParts = explode(':', $authHeader);

        $this->transport->addSubscriber(\Guzzle\Plugin\Log\LogPlugin::getDebugPlugin());

        $request =  $this->transport->get('/search_results/' . $id);
        $response = $request->send();

        return $response->json();
    }
}
