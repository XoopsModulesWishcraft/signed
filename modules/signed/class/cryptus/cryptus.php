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
 * @subpackage		cryptographic
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */

if (!class_exists("signedCryptus"))
	die('Signed Cryptus Library objectivity need to be loaded first - Restricted Access!');

if (!class_exists("signedCryptusHandler"))
	die('Signed Cryptus handler need to be loaded first - Restricted Access!');

include_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'signedlists.php';


class signedCryptusLibraries extends signedCryptusHandler
{

	
	/**
	 * @var array
	 */
	var $algoritms = array();
	
	/**
	 * @var array
	 */
	var $extensions = array();
	
	/**
	 * @var array
	 */
	var $cipherobjs = array();
	
	
	/**
	 *
	 */
	function __construct()
	{
		foreach(signedLists::getDirListAsArray(__DIR__) as $key => $folder)
		{
			if (file_exists($cipherlib = __DIR__ . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $folder . ".php"))
			{
				$pass = true;
				include_once $cipherlib;
				$class_name = "signedCryptus" . str_replace(array(" "), "", ucwords(str_replace(array("-", ".", "_"), " ", $folder)));
				if (class_exists($class_name))
				{
					$this->cipherobjs[$folder] = new $class_name();
					if (count($this->cipherobjs[$folder]->phplibry)>0)
					{
						foreach($this->cipherobjs[$folder]->phplibry as $extension)
							if (!extension_loaded($extension))
								$pass = false;
					}
					if (count($this->cipherobjs[$folder]->phpfuncs)>0)
					{
						foreach($this->cipherobjs[$folder]->phpfuncs as $function)
							if (!function_exists($function))
								$pass = false;
					}
					if ($pass==true)
					{
						$this->algoritms[$folder] = @$this->cipherobjs[$folder]->getAlgorithms();
						$this->extensions[$folder] = @$this->cipherobjs[$folder]->getFileExtensions();
					} else 
						unset($this->cipherobjs[$folder]);
				}
			}
		}
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
			$object = new signedCryptusLibraries();
		return $object;
	}
	
	
	/**
	 *
	 * @return multitype:multitype:number string
	 */
	static function getKeyBitz($extensions = array())
	{
		if (empty($extensions))
			return false;
		foreach($extensions as $fileext => $values)
			$bits[$values["keyen"]] = $fileext;
		return $bits;
	}
	
	/**
	 * @link http://en.wikipedia.org/wiki/Key_size
	 * @param unknown_type $key
	 * @param unknown_type $lengths
	 */
	static function getKeiyeLength($key = '', $lengths = array())
	{
		foreach($lengths as $id => $length)
			if (strlen($key) == ($length/8))
				return $length;
		return false;
	}
	
	/**
	 * 
	 */
	function getAllByTypals($reverse = false, $remove = array())
	{
		$result = array();
		foreach($this->extensions as $folder => $extensions)
			foreach($extensions as $extension => $values)
				if (!in_array($folder, $remove) || !in_array($extension, $remove))
					if ($reversed == false)
						$result[$this->cipherobjs[$folder]->name . " [*.$extension]"] = $extension;
					else
						$result[$extension] = $this->cipherobjs[$folder]->name . " [*.$extension]";
	}
	
	/*
	 * 
	 */
	function getAllExtensions()
	{
		static $extensions = array();
		if (empty($extensions))
			foreach($this->extensions as $folder => $extensions)
				foreach($extensions as $key => $type)
					$extensions[] = "$folder.$key";
		return $extensions;
	}
	
	/**
	 *
	 * @return array:
	 */
	function kieyeFunc()
	{
		if ($this->pbkdf2Algorithms()!=false)
			return 'pbkdf2';
		return 'simpKey';
	}
	
	/**
	 *
	 * @param unknown_type $passphrase
	 * @param unknown_type $salt
	 * @param unknown_type $key_length
	 * @param unknown_type $raw_output
	 * @return string
	 */
	function simplioKey($passphrase = '', $salt = '', $key_length = 128, $raw_output = false)
	{
	
	}
	
	/**
	 * 
	 * @return array:
	 */
	function pbkdf2Algorithms()
	{
		if (function_exists("hash_algos"))
			return hash_algos();
		return false;
	}
	
	/**
	 * 
	 * @param unknown_type $passphrase
	 * @param unknown_type $salt
	 * @param unknown_type $algorithm
	 * @param unknown_type $count
	 * @param unknown_type $key_length
	 * @param unknown_type $raw_output
	 * @return string
	 */
	function pbkdf2($passphrase = '', $salt = '', $key_length = 128, $raw_output = false, $algorithm = 'sha512', $count = 20000)
	{
		if(!in_array($algorithm, $this->pbkdf2Algorithms(), true)) {
			exit('pbkdf2: Hash algorithm "'.$algorithm.'" is not in anyway intalled or support on the system!');
		}
		 
		if($count <= 0 || $key_length <= 0) {
			$count = 20000;
			$key_length = 128;
		}
	
		$hash_length = strlen(hash($algorithm, "", true));
		$block_count = ceil($key_length / $hash_length);
	
		$output = "";
		for($i = 1; $i <= $block_count; $i++) {
			$last = $salt . pack("N", $i);
			$last = $xorsum = hash_hmac($algorithm, $last, $passphrase, true);
			for ($j = 1; $j < $count; $j++) {
				$xorsum ^= ($last = hash_hmac($algorithm, $last, $passphrase, true));
			}
			$output .= $xorsum;
		}
	
		if($raw_output) {
			return substr($output, 0, $key_length);
		}
		else {
			return base64_encode(substr($output, 0, $key_length));
		}
	}
}