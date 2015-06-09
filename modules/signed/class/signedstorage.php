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
 */
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'signedobject.php';
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'xmlarray.php';
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'xmlwrapper.php';

/**
 * 
 * @author Simon Roberts <simon@labs.coop>
 * @author Leshy Cipherhouse <leshy@slams.io>
 *
 */
class signedStorage extends signedObject
{
	
	/**
	 * 
	 * @var unknown
	 */
	var $_method ='';
	
	/**
	 *
	 * @var unknown
	 */
	var $_root = 'signed';
		
	/**
	 *
	 * @var unknown
	 */
	var $_methods ='';
	
	/**
	 *
	 * @var unknown
	 */
	var $_extensions = array();

	/**
	 *
	 * @var unknown
	 */
	var $fingerprints = array();
	
	/**
	 * 
	 * @param string $method
	 */
	function __construct($method='json')
	{
		$this->_method = $method;
		$this->_methods = array('json'=>'parseJSON', 'xml'=>'parseXML', 'serial'=>'parseSerialisation');
		$this->_extensions = array('json'=>'json', 'xml'=>'xml', 'serial'=>'serial');
	}
	
	static function getInstance($method = 'json')
	{
		static $object = array();
		if (!isset($object[$method]))
			$object[$method] = new signedStorage($method);
		$object[$method]->intialise();
		return $object[$method];
	}

	/**
	 *
	 * @param string $path
	 * @param string $filetitle
	 * @return multitype:
	 */
	function save($data = array(), $path = '', $filetitle = '', $root = 'signed', $method = '')
	{
		if (empty($method)||!in_array($method, $this->_methods))
			$method = $this->_method;
		if (empty($root))
			$root = $this->_root;
		if (isset($data['fingerprint']))
			unset($data['fingerprint']);
		$this->fingerprints[$method][md5($path.DIRECTORY_SEPARATOR.$filetitle)] = $data['fingerprint'] = signedCiphers::getInstance()->fingerprint($data, 'sha1');
		$content = $this->parse($data, $root, $method);
		$this->deleteFiles($path, $filetitle);
		if (!empty($content)) {
			if (!is_dir($path))
				mkdir($path, 0777, true);
			return $this->saveFile($content, $filename = $path . DIRECTORY_SEPARATOR . $filetitle . '.' . $this->_extensions[$method]);
		}
		if(isset($_SESSION["signed"]['signedSignature'][$filetitle]) && !empty($_SESSION["signed"]['signedSignature']))
		{
			switch ($path)
			{
				case constant("_PATH_REPO_SIGNATURES"):
					$_SESSION["signed"]['signedSignature'][$filetitle]->setVar('bytes', filesize($filename));
					$_SESSION["signed"]['signedSignature'][$filetitle]->setVar('saved', time());
					break;
				case constant("_PATH_REPO_VALIDATION"):
					if ($content['verification']['expired'] != false)
					{
						$_SESSION["signed"]['signedSignature'][$filetitle]->setVar('expired', time());
						$_SESSION["signed"]['signedSignature'][$filetitle]->setVar('state', 'inactive');
					}
					break;
				case constant("_PATH_REPO_SIGNED"):
					if (isset($content['signid']) && !empty($content['signid']))
					{				
						$GLOBALS['eventCurrent']->setVar('comment', $content['pathway']['ip'] . ' signed --- document identity: ' . $content['pathway']['document']['identity'] . ' document title: ' . $content['pathway']['document']['identity']);
						$GLOBALS['eventHandler']->insert($GLOBALS['eventCurrent'], true);
					}
					break;
					
			}
		}
		return true;
	}
	
	/**
	 * 
	 * @param string $path
	 * @param string $filetitle
	 * @return multitype:
	 */
	function load($path = '', $filetitle = '', $root = 'signed') 
	{
		$data = array();
		$method = $this->_method;
		if (empty($root))
			$root = $this->_root;
		foreach($this->_methods as $extension => $function)
		{
			if ($filename = $this->file_exists($path, $filetitle)) {
				$function = $this->_methods[$method = $extension];
				$data = $this->convert($this->readFile($filename), $root, $extension);
			}
		}
		if (!isset($data['fingerprint']))
			$this->fingerprints[$method][md5($path.DIRECTORY_SEPARATOR.$filetitle)] = $data['fingerprint'] = signedCiphers::getInstance()->fingerprint($data, 'sha1');
		else
			$this->fingerprints[$method][md5($path.DIRECTORY_SEPARATOR.$filetitle)] = $data['fingerprint'];
		if(isset($data['signid']) && !empty($data['signid']))
		{
			$signaturesHandler = xoops_getmodulehandler('signatures', 'signed');
			if (!is_object($_SESSION["signed"]['signedSignature'][$filetitle]))
			{
				$_SESSION["signed"]['signedSignature'][$filetitle] = $signaturesHandler->get($data['signid']);
			}
		} 
		return $data;
	}
	
	function file_exists($path = '', $filetitle = '')
	{
		foreach($this->_methods as $extension => $function)
		{
			if (file_exists($file = $path . DIRECTORY_SEPARATOR . $filetitle . '.' . $extension))
				return $file;
				
		}
		return false;
	}

	/**
	 *
	 */
	private function modifyNumericKeys($array = '', $convert = false, $spatial = '___')
	{
		if (!$convert) {
			$changed = false;
			$values = array();
			foreach(array_reverse(array_keys($array)) as $key)
			{
				if (is_numeric($key))
				{
					$changed = true;
					$newkey = $spatial . $key . $spatial;
					if (is_array($values[$key]))
						$values[$newkey] = $this->modifyNumericKeys($array[$key], $convert);
					else
						$values[$newkey] = $array[$key];
					unset($array[$key]);
				}
			}
			if ($changed == true) {
				foreach(array_reverse(array_keys($values)) as $key)
				{
					$array[$key] = $values[$key];
				}
			}
		} else {
			$changed = false;
			$values = array();
			foreach(array_reverse(array_keys($array)) as $key)
			{
				if (substr($key, 0, strlen($spatial)) == $spatial && substr($key, strlen($key) - strlen($spatial), strlen($spatial)) == $spatial )
				{
					$changed = true;
					$newkey = substr($key, strlen($spatial), strlen($key) - strlen($spatial) - strlen($spatial));
					if (is_array($values[$key]))
						$values[$newkey] = $this->modifyNumericKeys($array[$key], $convert);
					else
						$values[$newkey] = $array[$key];
					unset($array[$key]);
				}
			}
			if ($changed == true) {
				foreach(array_reverse(array_keys($values)) as $key)
				{
					$array[$key] = $values[$key];
				}
			}
		}
		return $array;
	}
	
	/**
	 *
	 * @param string $filename
	 * @return boolean|string
	 */
	private function parse($array = array(), $root = 'signed', $method = '')
	{
		if (empty($method)||!in_array($method, $this->_methods))
			$method = $this->_method;
		if (empty($root))
			$root = $this->_root;
		$function = $this->_methods[$method];
		return $this->$function((!empty($root)?array($root => $array):$array));
	}
	
	/**
	 *
	 * @param string $filename
	 * @return boolean|string
	 */
	private function convert($content = '', $root = 'signed', $method = '')
	{
		if (empty($method)||!in_array($method, $this->_methods))
			$method = $this->_method;
		if (empty($root))
			$root = $this->_root;
		$function = $this->_methods[$method];
		$ret = $this->$function($content);
		return (isset($ret[$root])?$ret[$root]:$ret);
	}
	
	/**
	 * 
	 * @param string $mixed
	 * @param string $action
	 * @return string|mixed|boolean
	 */
	private function parseJSON($mixed = '', $action = '')
	{
		if (empty($action)) 
		{
			if (is_array($mixed))
				$action = 'pack';
			else 
				$action = 'unpack';
		}
		switch ($action)
		{
			case "pack":
				return json_encode($mixed);
				break;
			case "unpack":
				return json_decode($mixed, true);
				break;
		}
		return false;
	}
	

	/**
	 *
	 * @param string $mixed
	 * @param string $action
	 * @return string|mixed|boolean
	 */
	private function parseXML($mixed = '', $action = '')
	{
		if (empty($action))
		{
			if (is_array($mixed))
				$action = 'pack';
			else
				$action = 'unpack';
		}
		switch ($action)
		{
			case "pack":
				$dom = new XmlDomConstruct('1.0', 'utf-8');
				$dom->fromMixed($this->modifyNumericKeys($array, false));
				return $dom->saveXML();
				break;
			case "unpack":
				return $this->modifyNumericKeys(XML2Array::createArray($mixed), true);
				break;
		}
		return false;
	}
	

	/**
	 *
	 * @param string $mixed
	 * @param string $action
	 * @return string|mixed|boolean
	 */
	private function parseSerialisation($mixed = '', $action = '')
	{
		if (empty($action))
		{
			if (is_array($mixed))
				$action = 'pack';
			else
				$action = 'unpack';
		}
		switch ($action)
		{
			case "pack":
				return serialize($mixed);
				break;
			case "unpack":
				return unserialize($mixed);
				break;
		}
		return false;
	}
	/**
	 *
	 * @param string $filename
	 * @return boolean|string
	 */
	private function deleteFiles($path = '', $filetitle = '')
	{
		foreach($this->_methods as $extension => $function)
		{
			if ($file = $this->file_exists($path, $filetitle))
				unlink($file);
			
		}
		return true;
	}

	
	/**
	 * 
	 * @param string $filename
	 * @return boolean|string
	 */
	private function readFile($filename = '')
	{
		if (!file_exists($filename))
			return false;
		$data = file_get_contents($filename);
		if ($GLOBALS['logger'] = signedLogger::getInstance())
			$GLOBALS['logger']->logBytes(strlen($data), 'io-read');
		return $data;
	}
	
	/**
	 * 
	 * @param string $content
	 * @param string $filename
	 * @return boolean
	 */
	private function saveFile($content = '', $filename = '')
	{
		if (file_exists($filename))
			unlink($filename);
		
		if (empty($content))
			return false;

		$f = fopen($filename, 'w');
		fwrite($f, $content, strlen($content));
		fclose($f);
		
		if ($GLOBALS['logger'] = signedLogger::getInstance())
			$GLOBALS['logger']->logBytes(strlen($content), 'io-write');
		
		return $filename;
	}
}