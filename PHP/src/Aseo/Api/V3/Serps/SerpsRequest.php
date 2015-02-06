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
    private $search_type ;

    /**
     * Language code
     * @var string
     */
    private $language;

    /**
     * Maximun number of results to return
     * @var integer
     */
    private $max_results;

    /**
     * The phrase to search for.
     * @var string
     */
    private $phrase;

    /**
     * return universal search results
     * @var boolean
     */
    private $universal;

    /**
     * Set to use a specific strategy
     * @var string
     */
    private $strategy;

    /**
     * strategy configuration
     * @var object
     */
    private $parameters;

    /**
     * list of supported search engines
     *
     * @var string[]
     */
    private $supportedSearchEngines = ['bing', 'google', 'yahoo', 'yandex'];

    public function __construct(array $data)
    {
        $this->populate($data);
    }

    /**
     * Populates this class with the values provided in the associative array.
     * the key must match one of the class properties
     *
     * @param  string[]  $data
     *
     * @return void
     */
    public function populate(array $data)
    {
        foreach ($data as $key => $value) {
            $this->populateField($key, $value);
        }
    }

    /**
     * Populates a class propertie.
     * This is done by calling the appropriate class setter
     *
     * @param string $field
     * @param mixed $value
     *
     * @return void
     */
    public function populateField($field, $value)
    {
        $methodName = "set" . $this->toCamelCase($field);

        if (false === method_exists($this, $methodName)) {
            throw new \OutOfBoundsException('SERPS call does not support the parameter ' . $field);
        }

        $this->$methodName($value);
    }

    /**
     * converts a string to CamelCase
     *
     * @param string $value
     *
     * @return string
     */
    private function toCamelCase($value)
    {
        $parts = explode('_', $value);
        $name = '';
        foreach ($parts as $part) {
            $name .= ucfirst($part);
        }

        return $name;
    }

    public function __toString()
    {
        $json = [];

        foreach (get_object_vars($this) as $variable => $value) {
            if ("supportedSearchEngines" == $variable) {
                continue;
            }

            if (null != $value) {
                $json[$variable] = $value;
            }
        }
        return json_encode($json);
    }

    /**
     * Set the value of Internal search engine name
     *
     * @param string search_engine
     *
     * @return self
     */
    public function setSearchEngine($search_engine)
    {

        if (false === in_array($search_engine, $this->getSupportedSearchEngines())) {
            throw new \InvalidArgumentException('Search Engine is not supported');
        }

        $this->search_engine = $search_engine;

        return $this;
    }

    /**
     * Set the value of Region code
     *
     * @param string region
     *
     * @return self
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Set the value of town name
     *
     * @param string town
     *
     * @return self
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Set the value of The search type
     *
     * @param string search_type
     *
     * @return self
     */
    public function setSearchType($search_type)
    {
        $this->search_type = $search_type;

        return $this;
    }

    /**
     * Set the value of Language code
     *
     * @param string language
     *
     * @return self
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Set the value of Maximun number of results to return
     *
     * @param integer max_results
     *
     * @return self
     */
    public function setMaxResults($max_results)
    {
        $this->max_results = $max_results;

        return $this;
    }

    /**
     * Set the value of The phrase to search for.
     *
     * @param string phrase
     *
     * @return self
     */
    public function setPhrase($phrase)
    {
        $this->phrase = $phrase;

        return $this;
    }

    /**
     * Set the value of return universal search results
     *
     * @param boolean universal
     *
     * @return self
     */
    public function setUniversal($universal)
    {
        $this->universal = $universal;

        return $this;
    }

    /**
     * Set the value of Set to use a specific strategy
     *
     * @param string strategy
     *
     * @return self
     */
    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;

        return $this;
    }

    /**
     * Set the value of strategy configuration
     *
     * @param object parameters
     *
     * @return self
     */
    public function setParameters(object $parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }


    /**
     * Get the value of list of supported search engines
     *
     * @return string[]
     */
    public function getSupportedSearchEngines()
    {
        return $this->supportedSearchEngines;
    }

    /**
     * Set the value of list of supported search engines
     *
     * @param string[] supportedSearchEngines
     *
     * @return self
     */
    public function setSupportedSearchEngines(array $supportedSearchEngines)
    {
        $this->supportedSearchEngines = $supportedSearchEngines;

        return $this;
    }

}
