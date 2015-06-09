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
 * @license         General Software Licence (https://web.labs.coop/public/legal/general-software-license/10,3.html)
 * @package         signed
 * @since           2.07
 * @author          Simon Roberts <wishcraft@users.sourceforge.net>
 * @author          Leshy Cipherhouse <leshy@slams.io>
 * @subpackage		class
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */


defined('_PATH_ROOT') or die('Restricted access');

/**
 *
 * @author Simon Roberts <simon@labs.coop>
 *
*/
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'signedarrays.php';
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'signedlogger.php';
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'signedsecurity.php';


/**
 *
 * @author Simon Roberts <simon@labs.coop>
 *
 */
class signedObject
{

	/**
	 *
	 * @var unknown
	 */
	var $_arrays = NULL;
	
	/**
	 *
	 * @var unknown
	 */
	var $_logger = NULL;

	/**
	 *
	 * @var unknown
	 */
	var $_io = NULL;

	/**
	 *
	 * @var unknown
	 */
	var $_security = NULL;
	

	/**
	 *
	 * @var unknown
	 */
	var $_processes = NULL;

	/**
	 * 
	 */
	function intialise()
	{
		$this->_arrays = $GLOBALS['arrays'] = signedArrays::getInstance();
		$this->_logger = $GLOBALS['logger'] = signedLogger::getInstance();
		$this->_security = $GLOBALS['security'] = signedSecurity::getInstance();
	}
}