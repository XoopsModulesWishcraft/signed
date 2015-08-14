<?php
/**
 * Chronolabs Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Chronolabs Cooperative http://labs.coop
 * @license			General Software Licence (http://labs.coop/briefs/legal/general-software-license/10,3.html)
 * @license			End User License (http://labs.coop/briefs/legal/end-user-license/11,3.html)
 * @license			Privacy and Mooching Policy (http://labs.coop/briefs/legal/privacy-and-mooching-policy/22,3.html)
 * @license			General Public Licence 3 (http://labs.coop/briefs/legal/general-public-licence/13,3.html)
 * @category		signed
 * @since			2.1.9
 * @version			2.2.0
 * @author			Simon Antony Roberts (Aus Passport: M8747409) <wishcraft@users.sourceforge.net>
 * @author          Simon Antony Roberts (Aus Passport: M8747409) <wishcraft@users.sourceforge.net>
 * @subpackage		cache
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			Farming Digital Fingerprint Signatures: https://signed.ringwould.com.au
 * @link			Heavy Hash-info Digital Fingerprint Signature: http://signed.hempembassy.net
 * @link			XOOPS SVN: https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/signed/
 * @see				Release Article: http://cipher.labs.coop/portfolio/signed-identification-validations-and-signer-for-xoops/
 * @filesource
 *
 */

defined('_PATH_ROOT') or die('Restricted access');

/**
 * APC storage engine for cache.
 *
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *                                  1785 E. Sahara Avenue, Suite 490-204
 *                                  Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package cake
 * @subpackage cake.cake.libs.cache
 * @since CakePHP(tm) v 1.2.0.4933
 * @version $Revision: 8066 $
 * @modifiedby $LastChangedBy: beckmi $
 * @lastmodified $Date: 2011-11-06 01:09:33 -0400 (Sun, 06 Nov 2011) $
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * APC storage engine for cache
 *
 * @package cake
 * @subpackage cake.cake.libs.cache
 */
class signedCacheApc extends signedCacheEngine
{
    /**
     * Initialize the Cache Engine
     *
     * Called automatically by the cache frontend
     * To reinitialize the settings call Cache::engine('EngineName', [optional] settings = array());
     *
     * @param array $setting array of setting for the engine
     * @return boolean True if the engine has been successfully initialized, false if not
     * @see	 CacheEngine::__defaults
     * @access public
     */
    function init($settings = array())
    {
        parent::init($settings);
        return function_exists('apc_cache_info');
    }

    /**
     * Write data for key into cache
     *
     * @param string $key Identifier for the data
     * @param mixed $value Data to be cached
     * @param integer $duration How long to cache the data, in seconds
     * @return boolean True if the data was succesfully cached, false on failure
     * @access public
     */
    function write($key, &$value, $duration)
    {
        return apc_store($key, $value, $duration);
    }

    /**
     * Read a key from the cache
     *
     * @param string $key Identifier for the data
     * @return mixed The cached data, or false if the data doesn't exist, has expired, or if there was an error fetching it
     * @access public
     */
    function read($key)
    {
        return apc_fetch($key);
    }

    /**
     * Delete a key from the cache
     *
     * @param string $key Identifier for the data
     * @return boolean True if the value was succesfully deleted, false if it didn't exist or couldn't be removed
     * @access public
     */
    function delete($key)
    {
        return apc_delete($key);
    }

    /**
     * Delete all keys from the cache
     *
     * @return boolean True if the cache was succesfully cleared, false otherwise
     * @access public
     */
    function clear()
    {
        return apc_clear_cache('user');
    }
}

?>