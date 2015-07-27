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

if (!class_exists("signedCryptusLibraries"))
	die('Signed Cryptus Library handler need to be loaded first - Restricted Access!');

require_once __DIR__ . DIRECTORY_SEPARATOR . 'aes.class.php';     // AES PHP implementation
require_once __DIR__ . DIRECTORY_SEPARATOR . 'aesctr.class.php';  // AES Counter Mode implementation

class signedCryptusAesctr extends signedCryptusLibraries
{
	
	
	/**
	 *
	 * @var string
	 */
	var $filename = array("library"=>0, "bit" => 2);
	
	/**
	 *
	 * @var string
	 */
	var $seperator = '-==-';
	
	/**
	 * 
	 * @var unknown_type
	 */
	var $timer = 0;
	
	/**
	 *
	 * @var string
	 */
	var $name = "AES Counter (PHP)";
	
	/**
	 *
	 * @var string
	 */
	var $phplibry = array("");
	
	/**
	 *
	 * @var string
	 */
	var $phpfuncs = array("");
	
	/**
	 *
	 * @var string
	 */
	var $filetype = '';
	
	/**
	 *
	 */
	function __construct()
	{
		$this->timer = microtime(true);
	}
	
	/**
	 *
	 */
	function __destruct()
	{
	
	}
	
	/**
	 *
	 * @return Ambigous <NULL, signedCryptusAesctr>
	 */
	static function getInstance()
	{
		ini_set('display_errors', true);
		error_reporting(E_ERROR);
	
		static $object = NULL;
		if (!is_object($object))
			$object = new signedCryptusAesctr();
		return $object;
	}
	
	
	/**
	 *
	 * @return multitype:multitype:number string
	 */
	function setFiletype($bitz = 0, $cipher = '',$mode = '')
	{
		if (!empty($bitz) && !empty($cipher))
			foreach($this->getFileExtensions() as $filetype => $values)
				if ($bitz == $values["keyen"])
					return $this->filetype = $filetype;
		return $this->filetype;
	}
	
	/**
	 * 
	 * @return multitype:string
	 */
	function getAlgorithms()
	{
		return array(basename(__DIR__));
	}
	
	/**
	 * 
	 * @return multitype:multitype:number string
	 */
	function getFileExtensions()
	{
		return array(		basename(__DIR__) . '.128' => array("keyen"=>128, "salt" => SIGNED_BLOWFISH_SALT), 
							basename(__DIR__) . '.192' => array("keyen"=>192, "salt" => SIGNED_BLOWFISH_SALT), 
							basename(__DIR__) . '.256' => array("keyen"=>256, "salt" => SIGNED_BLOWFISH_SALT));
	}
	
	/**
	 *
	 * @return multitype:multitype:number string
	 */
	private function getKeyBitz($cipher = '',$mode = '')
	{
		return parent::getKeyBitz($this->getFileExtensions());
	}	
	
	/**
	 * 
	 * @param unknown_type $data
	 * @param unknown_type $key
	 * @param unknown_type $bitz
	 * @return boolean
	 */
	function crypt($data = '', $key = '', $cipher = '',$mode = '')
	{
		if (($bitz = parent::getKeiyeLength($key, array_key($this->getKeyBitz($cipher, $mode))))>0)
		{
			setFiletype($bitz, $cipher, $mode);
			return AesCtr::encrypt($data, $key, $bitz);
		}
		return false;
	}
	
	/**
	 * 
	 * @param unknown_type $data
	 * @param unknown_type $key
	 * @param unknown_type $bitz
	 * @return boolean
	 */
	function decrypt($data = '', $key = '', $cipher = '',$mode = '')
	{
		if (($bitz = parent::getKeiyeLength($key, array_key($this->getKeyBitz($cipher, $mode))))>0)
		{
			setFiletype($bitz, $cipher, $mode);
			return AesCtr::decrypt($data, $key, $bitz);
		}
		return false;
	}
}

?>