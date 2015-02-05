<?php
namespace Aseo\Api\Auth;

/**
* Analytics SEO API Authentication
*
* @version 1
*
* @author Nuno Franco da Costa <nuno@francodacosta.com>
* @copyright 2014 Analytics SEO ltd
* @license http://www.opensource.org/licenses/mit-license.php MIT
* @link https://github.com/analyticsseo/api-client/
*/

/**
 * interface authentication provides must implement
 */
interface AuthInterface
{
    /**
     * computes the authentication hash
     */
    public function computeHash();
}
