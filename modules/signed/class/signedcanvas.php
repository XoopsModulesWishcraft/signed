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
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'signedobject.php';


/**
 *
 * @author Simon Roberts <simon@labs.coop>
 *
 */
class signedCanvas extends signedObject
{

	/**
	 *
	 * @var unknown
	 */
	var $_headers = array();
	
	/**
	 *
	 * @return Ambigous <NULL, signedProcessess>
	 */
	static function getInstance()
	{
		ini_set('display_errors', true);
		error_reporting(E_ERROR);
		
		static $object = NULL;
		if (!is_object($object))
			$object = new signedCanvas();
		$object->intialise();
		return $object;
	}
		

	/**
	 *
	 * @param string $src
	 * @param string $content
	 * @param string $name
	 * @param unknown $attributes
	 */
	function addScript($src = '', $content = '', $name = '', $attributes = array())
	{
		return $GLOBALS['xoTheme']->addScript($src, $content, $name, $attributes);
	}
	
	/**
	 *
	 * @param string $src
	 * @param string $content
	 * @param string $name
	 * @param unknown $attributes
	 */
	function addStylesheet($src = '', $content = '', $name = '', $attributes = array())
	{
		return $GLOBALS['xoTheme']->addStylesheet($src, $content, $name, $attributes);
	}
	
	/**
	 *
	 * @param unknown $rel
	 * @param string $href
	 * @param unknown $attributes
	 * @param string $name
	 */
	function addLink($rel, $href = '', $attributes = array(), $name = '')
	{
		return $GLOBALS['xoTheme']->addLink($rel, $href, $attributes, $name);
	}
	

	/**
	 *
	 */
	function getContentBuffer($prompt = '', $step = '')
	{
		if (file_exists($file = _PATH_ROOT . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . trim($_SESSION["signed"]['prompts'][$prompt]['type']) . DIRECTORY_SEPARATOR . trim($_SESSION["signed"]['prompts'][$prompt]['for']) . DIRECTORY_SEPARATOR . trim($_SESSION["signed"]['prompts'][$prompt]['class']) . '.php')) {
			$_SESSION["signed"]['step'] = $step;
			return include($file);
		} else {
			die("Missing: $file");
		}
	}
	

	/**
	 *
	 */
	function getHeader($key = '')
	{
		if (!empty($key))
			if (isset($this->_headers[$key]))
				return $this->_headers[$key];
		return array();
	}
}