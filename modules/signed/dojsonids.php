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
 * @subpackage		module
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'common.php';
$GLOBALS['xoopsLogger']->activated = false;
ini_set('display_errors', true'); ini_set('log_errors', true); ini_set('error_log', XOOPS_ROOT_PATH . DIRETORY_SEPARATOR . 'php-errors.txt'); error_reporting(E_ALL);
ob_end_flush();
header('Content-type: application/json');
set_time_limit(120);
if (signedCiphers::getInstance()->getHash(_URL_ROOT.date('Ymdh').session_id())==$_REQUEST['passkey']) {
	$ids = signedArrays::getInstance()->returnKeyed($_REQUEST['signature_mode'], 'getIdentificationsArray');
	$verify = signedArrays::getInstance()->returnKeyed($_REQUEST['signature_mode'], 'getValidationsArray');
	$points = 0;
	foreach($_REQUEST['identification'] as $key => $id) {
		if ($key = $id) {
			$points = $points + $ids[$key]['points'];
		}		
	}	
	if ($points>=$verify['required']['id-score']['fields'][0]){
		$values['innerhtml']['total-points'] = $points . '&nbsp;~&nbsp;<em>Required: '.$verify['required']['id-score']['fields'][0].'</em>';
		$values['disable']['submit-next'] = 'false';	
	} else {	
		$values['innerhtml']['total-points'] = $points . '&nbsp;~&nbsp;<em>Required: '.$verify['required']['id-score']['fields'][0].'</em>';
		$values['disable']['submit-next'] = 'true';	
	}
} else {
	$values['innerhtml']['total-points'] = "<font style='color: rgb(255,0,0);'>Pass Key has Timed-out please refresh the page!</font>";
	$values['disable']['submit-next'] = 'true';
}
print json_encode($values);
?>
