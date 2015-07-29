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

class signedCryptusRsaOpensll extends signedCryptusLibraries
{
	
	
	/**
	 *
	 * @var string
	 */
	var $filename = array("library"=>0, "cipher" => 'rsa-ssl');
	
	/**
	 *
	 * @var string
	 */
	var $seperator = '-==-';
	
	/**
	 *
	 * @var string
	 */
	var $name = "RSA OpenSSL";
	
	/**
	 *
	 * @var string
	 */
	var $phplibry = array("");
	
	/**
	 *
	 * @var string
	 */
	var $phpfuncs = array(	"openssl_pkey_get_public", "openssl_seal", "openssl_free_key",
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
		return array(dirname(__DIR__)	=>	array(	'rsa-ssl' => array() ));
	}
	
	/**
	 * 
	 * @return multitype:multitype:number string
	 */
	function getFileExtensions()
	{
		$modulehandler = xoops_gethandler('module');
		$confighandler = xoops_gethandler('config');
		$signed = $modulehandler->getByDirname('signed');
		$configs = $confighandler->getConfigLists($signed->getVar('mid'));
		return array(	dirname(__DIR__) . '.rsa-ssl' => array("keyen"=>"cert", "cert" => $configs['pem-key']));
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
		$sealed = $ekeys = "";
		$pubKey = array();
		if (file_exists($key)) {
			$pubKey[] = openssl_pkey_get_public( $pem = file_get_contents( $key ) );
      		$result = openssl_seal($data, $sealed, $ekeys, $pubKey);
      		openssl_free_key($pubKey);
      		$storage = signedStorage::getInstance('json');
      		$storage->save(array('pem'=>explode("\n",$pem)), $filename = _PATH_REPO_CERTIFICATES . DIRECTORY_SEPARATOR .sha1($pem) . '.' . 'json');
      		setFiletype($bitz, $cipher, $mode);
      		return base64_encode(json_encode(array( 'data' => $sealed, 'kieye' =>  json_encode($ekeys), 'pem' => sha1($pem))));
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
		$open = "";
		$pubKey = array();
		$data = json_decode(base64_decode($data), true);
		if (file_exists($key) && !empty($data['data']) && !empty($data['kieye']) && !empty($data['pem']))
			$storage = signedStorage::getInstance('json');
			$values = $storage->load( _PATH_REPO_CERTIFICATES , $data['pem'], 'pem');
			$pem = implode("\n", $values['pem']);
			if (sha1($pem) == $data['pem'])
			{
				$pubKey[] =   openssl_pkey_get_public( $pem );
	      		$result = openssl_open( $data['data'], $open, $data['kieye'], $pubKey);
	      		openssl_free_key($pubKey);
	      		setFiletype($bitz, $cipher, $mode);
	      		return $open;
			}
		return false;
	}
}

?>