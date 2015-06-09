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


class signedArrays 
{

	/**
	 *
	 */
	function __construct()
	{
	
	}
	
	/**
	 *
	 */
	function __destruct()
	{
	
	}
	
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
			$object = new signedArrays();
		return $object;
	}
		
	/**
	 *
	 */
	function makeAlphaCount($num = 0)
	{
		static $ret = array();
		if (!isset($ret[$num])) {
			$ret[$num] = 'aaaaaaaaaa';
			for($i=0;$i<$num;$i++)
				$ret[$num]++;
				$ret[$num]++;
				$ret[$num] = 'n'+$num+'-' . $ret[$num];
		}
		return $ret[$num];
	}

	/**
	 * 
	 * @param number $key
	 * @return string|number
	 */
	function reverseAlphaCount($key = 0)
	{
		if (substr($key,0,1)==='n' && strpos($key, '-'))
		{
			$parts = explode('-', $key);
			return substr($parts[0], 1, strlen($parts[0])-1);
		}
		return $key;
	}
	
	/**
	 *
	 */
	function collapseArray($array = array())
	{
		return json_encode($array);
	}
	
	/**
	 *
	 * @return array
	 */
	function returnKeyed($key = '', $function = "", $class = '')
	{
	
		if (empty($class)) {
			foreach(get_declared_classes() as $classname) {
				if (method_exists($classname, $function)) {
					$class = $classname;
					continue;
				}
			}
		}
		if (method_exists($class, $function)) {
			if (method_exists($class, 'getInstance')) {
				$object = $class::getInstance();
			} else {
				$object = new $class();
			}
			$data = $object->$function();
			if (isset($data[$key]))
				return $data[$key];
			else
				return $data;
		} elseif (function_exists($function)) {
			return $function();
		}
		return false;
	}
	
	
	/**
	 *
	 * @return array
	 */
	function returnKey($key = '', $function = "", $class = '')
	{
		return returnKeyed($key, $function, $class);
	}
	
	/**
	 * 
	 * @param unknown $array
	 * @return mixed
	 */
	function trimExplode($array = array()) {
		static $arrays = array();
		if (!isset($arrays[md5(self::collapseArray($array))]))
		{
			$arrays[md5(self::collapseArray($array))] = array();
			foreach($array as $key => $value) {
				if (is_array($value))
					$arrays[md5(self::collapseArray($array))][$key] = $this->trimExplode($value);
				else
					$arrays[md5(self::collapseArray($array))][$key] = str_replace(array("\n", "\r"), "", trim($value));
			}
		}
		return $arrays[md5(self::collapseArray($array))];
	}
}