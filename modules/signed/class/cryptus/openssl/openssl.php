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

class signedCryptusOpensll extends signedCryptusLibraries
{
	
	
	/**
	 *
	 * @var string
	 */
	var $filename = array("library"=>0, "cipher" => 'openssl');
	
	/**
	 *
	 * @var string
	 */
	var $seperator = '-==-';
	
	/**
	 *
	 * @var string
	 */
	var $name = "RSA OpenSSL (PHP)";
	
	/**
	 *
	 * @var string
	 */
	var $phplibry = array("");
	
	/**
	 *
	 * @var string
	 */
	var $phpfuncs = array(	"openssl_get_cipher_methods", "openssl_cipher_iv_length", "openssl_free_key",
							"openssl_open");
	
	
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
			$object = new signedCryptusMysql();
		return $object;
	}
	
	/**
	 * 
	 * @return multitype:string
	 */
	function getAlgorithms()
	{
		return array(dirname(__DIR__)	=>	array(	'openssl' => openssl_get_cipher_methods() ));
	}
	
	/**
	 *
	 * @return multitype:multitype:number string
	 */
	function setFiletype($bitz = 0, $cipher = '',$mode = '')
	{
		if (!empty($bitz) && !empty($cipher))
			foreach($this->getFileExtensions() as $filetype => $values)
				if ($bitz == $values["keyen"] && $cipher == $values["cipher"])
					return $this->filetype = $filetype;
		return $this->filetype;
	}
	
	/**
	 * 
	 * @return multitype:multitype:number string
	 */
	function getFileExtensions($cipher = '',$mode = '')
	{
		
		static $extensions = array();
		if (empty($extensions))
			foreach($this->getAlgorithms() as $folder => $algorithms)
				foreach($algorithms as $id => $cipher)
					if (($bitz == openssl_cipher_iv_length($cipher) * 8) > 0 )
						$extensions[dirname(__DIR__) . '.' . ".$bitz".str_replace(array(" "), "", ucwords(str_replace(array("-", ".", "_"), " ", $cipher)))] = array("keyen"=>$bitz, "cipher" => $cipher, "salt" => SIGNED_BLOWFISH_SALT);
		return $extensions;
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
			return base64_encode(json_encode(array( 'data' => openssl_encrypt($data, $cipher, $key, false, $bitz / 8), 'kieye' =>  json_encode($ekeys), 'pem' => sha1($pem))));
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
		$data = json_encode(base64_encode($data), true);
		if (($bitz = parent::getKeiyeLength($key, array_key($this->getKeyBitz($cipher, $mode))))>0 && !empty($data['data']))
		{
			setFiletype($bitz, $cipher, $mode);
			return openssl_decrypt($data['data'], $cipher, $key, false, $bitz / 8);
		}
		return false;
	}
}

?>