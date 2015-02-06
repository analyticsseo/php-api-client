<?php
namespace Aseo\Api\V3\Serps;

/**
* Analytics SEO PHP CLient
*
* Serach Engine results page CLient
*
* @version 3
*
* @author Nuno Franco da Costa <nuno@francodacosta.com>
* @copyright 2014 Analytics SEO ltd
* @license http://www.opensource.org/licenses/mit-license.php MIT
* @link https://github.com/analyticsseo/api-client/
*/

class SerpsRequest
{
    /**
     * Internal search engine name
     * @var string
     */
    private $search_engine;

    /**
     * Region code
     * @var string
     */
    private $region;

    /**
     * town name
     * @var string
     */
    private $town;

    /**
     * The search type
     * @var string
     */
    private $search_type = 'web';

    /**
     * Language code
     * @var string
     */
    private $language;

    /**
     * Maximun number of results to return
     * @var integer
     */
    private $max_results = 10;

    /**
     * The phrase to search for.
     * @var string
     */
    private $phrase;

    /**
     * return universal search results
     * @var boolean
     */
    private $universal = false;

    /**
     * Set to use a specific strategy
     * @var string
     */
    private $strategy = 'standard';

    /**
     * strategy configuration
     * @var object
     */
    private $parameters;

    public function __set($name, $value)
    {
        if (false == property_exists($this, $name)) {
            throw new \InvalidArgumentException('This object does not accept a property named ' . $name);
        }

        $this->$name = $value;
    }

    public function __get($name)
    {
        if (false == property_exists($this, $name)) {
            throw new \InvalidArgumentException('This object does not accept a property named ' . $name);
        }

        return $this->$name;
    }

    public function __toString()
    {
        return json_encode(get_object_vars($this));
    }
}
