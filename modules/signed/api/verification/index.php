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
 * @subpackage		api
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */

	// Enables API Runtime Constant
	define('_SIGNED_API_FUNCTION', basename(dirname(__FILE__)));
	define('_SIGNED_EVENT_SYSTEM', 'api');
	define('_SIGNED_EVENT_TYPE', basename(dirname(__FILE__)));
	require_once dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'common.php';
	require dirname(dirname(__FILE__)) . _DS_ . 'validate.php';

	// Checks if API Function is Enabled
	if (!in_array(basename(dirname(__FILE__)), $GLOBALS['api']->callKeys())) {
		header("Location: " . _URL_ROOT);
		exit(0);
	}
	
	foreach($_REQUEST as $field => $value) {
		if (!empty($value)||strlen(trim($value))!=0)
			$data[$field] = $value;
	}
	
	if (signed_verifyAPIFields(basename(dirname(__FILE__)), $data)==true) {
		$servicekey = signed_extractServiceKey($data['code'], $data['certificate'], $data['verification-key']);
		if (getHostCode()==$servicekey) {
			if ($signature = signed_getSignature($data['serial-number'], $data['code'], $data['certificate'], $data['any-name'], $data['any-email'], $data['any-date'], true)) {
				$GLOBALS['io'] = signedStorage::getInstance(_SIGNED_RESOURCES_STORAGE);
				if (!$verification = $GLOBALS['io']->load(_PATH_REPO_VALIDATION, $signature['serial-number'])) {
					if (function_exists('http_response_code'))
						http_response_code(400);
					echo $GLOBALS['api']->format(array('success'=> false, 'error'=> 'The corresponding field(s):  '.implode(', ', array('serial-number', 'code', 'certificate')) . ' ~ did not correspond with the same signature or was wrong!', 'error-code' => '104'));
					exit(0);
				}		
				
				if (function_exists('http_response_code'))
					http_response_code(200);
				echo $GLOBALS['api']->format(array('success'=> true, 'verification' => $verification['verification'], 'when' => time()));
				@$GLOBALS['logger']->logPolling('default', basename(dirname(__FILE__)), array('server' => $_SERVER, 'request' => $_REQUEST));
				exit(0);
				
			} else {
				if (function_exists('http_response_code'))
					http_response_code(400);
				echo $GLOBALS['api']->format(array('success'=> false, 'error'=> 'The corresponding field(s):  '.implode(', ', array('serial-number', 'code', 'certificate')) . ' ~ did not correspond with the same signature or was wrong!', 'error-code' => '104'));
				exit(0);
			}
		} else {
			foreach(signed_getSites() as $key => $srv) {
				if ($srv['code'] == $servicekey) {
					$service = $srv;
					continue;
				}
			}
				
			if (isset($service)) {
				if (!$ch = curl_init($url = $service['protocol'] . '://' . $service['api-uri'] . '/' . basename(dirname(__FILE__)) . '/')) {
					trigger_error('Could not intialise CURL file: '.$url);
					return false;
				}
				$cookies = _PATH_CACHE.'/api-'.md5($url).'.cookie';
			
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 190);
				curl_setopt($ch, CURLOPT_TIMEOUT, 190);
				curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
				$data = curl_exec($ch);
				$info = curl_getinfo($ch);
				curl_close($ch);
				if (function_exists('http_response_code'))
					http_response_code($info['http_code']);
				echo $data;
				exit(0);
			} else {
				if (function_exists('http_response_code'))
					http_response_code(400);
				echo $GLOBALS['api']->format(array('success'=> false, 'error'=> 'Service Key:~  '.$servicekey.' is unknown and not a trusted ensignator!', 'error-code' => '115'));
				exit(0);
			}
		}
	}
?>