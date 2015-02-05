<?php
namespace Aseo\Api\Serps;

/**
* Analytics SEO PHP CLient
*
* @author Nuno Franco da Costa <nuno@francodacosta.com>
* @copyright 2014 Analytics SEO ltd
* @license http://www.opensource.org/licenses/mit-license.php MIT
* @link https://github.com/analyticsseo/api-client/
*/
class SerpsApiClient3
{
    const END_POINT = 'https://v3.api.analyticsseo.com';

    public function __construct($transport)
    {
        $this->setTransport($transport);
    }
}
