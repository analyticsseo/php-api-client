<?php
namespace Aseo\Api;

/**
* Analytics SEO PHP CLient
*
* @author Nuno Franco da Costa <nuno@francodacosta.com>
* @copyright 2014 Analytics SEO ltd
* @license http://www.opensource.org/licenses/mit-license.php MIT
* @link https://github.com/analyticsseo/api-client/
*/

/**
 * Analytics SEO PHP CLient
 */
class ClientFactory
{
    /**
     * Api salt
     * @var string
     */
    private $salt;

    /**
     * Api secret
     * @var string
     */
    private $apiSecret;

    /**
     * Api Key
     * @var string
     */
    private $apiKey;

    /**
     * Api version to use
     * @var integer
     */
    private $apiVersion = 3;

    /**
     * Maps an api version to and endpoint and specific class implementations
     * @var integer
     */
    private $apiEndPointMap = [
        '3' => [
            'endpoint' => 'v3.api.analyticsseo.com',
            'classes' => [
                'serps' => Aseo\Api\Serps\SerpsApiClient3,
                'auth'  => Aseo\Api\Auth\KeyAuth,
            ]
        ],
    ];

    /**
     * Get the value of Api salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set the value of Api salt
     *
     * @param string salt
     *
     * @return self
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get the value of Api secret
     *
     * @return string
     */
    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    /**
     * Set the value of Api secret
     *
     * @param string apiSecret
     *
     * @return self
     */
    public function setApiSecret($apiSecret)
    {
        $this->apiSecret = $apiSecret;

        return $this;
    }

    /**
     * Get the value of Api Key
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set the value of Api Key
     *
     * @param string apiKey
     *
     * @return self
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get the value of Api version to use
     *
     * @return integer
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    private function hasMappingForApiVersion($apiVersion)
    {
        return array_key_exists("$apiVersion", $this->apiEndPointMap);
    }
    /**
     * Set the value of Api version to use
     *
     * @param integer apiVersion
     *
     * @return self
     */
    public function setApiVersion($apiVersion)
    {
        if (false === $this->hasMappingForApiVersion($apiVersion)) {
            throw new \OutOfBoundsException('Api version not supported');
        }

        $this->apiVersion = $apiVersion;

        return $this;
    }

    /**
     * Retuns an api client for the specified client
     *
     * @param  string $client
     * @throws OutOfBoundsException on invalid client name
     *
     * @return mixed
     */
    public function create($client)
    {
        $apiVersion = $this->getApiVersion();

        if (false === $this->hasMappingForApiVersion($apiVersion)) {
            throw new \OutOfBoundsException('Api version not supported');
        }

        if (false === array_key_exists($client, $this->apiEndPointMap[$apiVersion]['classes'])) {
            throw new \OutOfBoundsException('Api version does not support the request Client');
        }

        if (false === array_key_exists('auth', $this->apiEndPointMap[$apiVersion]['classes'])) {
            throw new \OutOfBoundsException('Oops, auth class was not defined, this is a bug!');
        }

        $clientFQDN = $this->apiEndPointMap[$apiVersion]['classes'][$name];
        $authFQDN = $this->apiEndPointMap[$apiVersion]['classes'][$name];

        $authClass = new $authFQDN;
        $authClass->setApiKey($this->getApiKey());
        $authClass->setApiSecret($this->getApiSecret());
        $authClass->setApiSalt($this->getApiSalt());

        $clientClass = new clientFQDN;
        $clientClass->setAuth($authClass);


    }
}
