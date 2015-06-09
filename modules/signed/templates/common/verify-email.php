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
 * @subpackage		templates
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */
?><?php 
	
	$serial = isset($_GET['serial'])?$_GET['serial']:md5(NULL);
	$key = isset($_GET['key'])?$_GET['key']:md5(NULL);
	$hash = isset($_GET['hash'])?$_GET['hash']:'';
	
	if ($GLOBALS['io'] = signedStorage::getInstance(_SIGNED_RESOURCES_STORAGE)) {
		$array = $GLOBALS['io']->load(_PATH_REPO_VALIDATION, $serial);
		if ($array['verification']['verified'] == false) {
			if ($array['verification']['emails'][$key]['verified'] == false) {
				if ($array['verification']['emails'][$key]['key'] == $hash) {
					$array['verification']['emails'][$key]['verified'] = true;
					$array['verification']['emails'][$key]['verified-when'] = microtime(true);
					$array['verification']['emails'][$key]['verified-ip'] = json_decode(file_get_contents("http://lookups.labs.coop/v1/country/".signedSecurity::getInstance()->getIP(true)."/json.api"), true);
					?><h1>Email Verified</h1><p style="font-size:1.376em;">The Email address: <strong><?php echo $array['verification']['emails'][$key]['to']?></strong> has been verified!</p><?php
					redirect_header(XOOPS_URL . '/modules/signed/', 10, 'The Email address: <strong>'. $array['verification']['emails'][$key]['to'] .'</strong> has been verified!');
				}	
			} else {
				$GLOBALS['errors']['email-done'] = "The email number of '".$array['verification']['emails'][$key]['number']."' in this Signature corresponding to the serial number:~ " . $serial . ' - has already been verified!';
				redirect_header(XOOPS_URL . '/modules/signed/', 10, $GLOBALS['errors']['email-done']);
			}
			$verified = true;
			if (is_array($array['verification']['emails']) && isset($array['verification']['emails']))
				foreach($array['verification']['emails'] as $email) {
					if ($email['verified']==false)
						$verified = false;
				}
			if (is_array($array['verification']['emails']) && isset($array['verification']['emails']))
				foreach($array['verification']['emails'] as $Email) {
					if ($Email['verified']==false)
						$verified = false;
				}
			$array['verification']['verified'] = $verified;
			
			$GLOBALS['io']->save($array, _PATH_REPO_VALIDATION, $serial);
			
			if ($verified==true) {
				echo "<div style=\"font-size: 1.89711em; text-align: center; margin 15px; color: rgb(90,210,197);\">Sending Signature via Email!</div>";
				signedPackages::getInstance()->sendSignatureEmail($serial);
				redirect_header(XOOPS_URL . '/modules/signed/', 10, 'Sending Signature via Email!');
			}
		} else {
			redirect_header(XOOPS_URL . '/modules/signed/', 10, "This Signature corresponding to the serial number:~ " . $serial . ' - has been completely verified!');
		}
	} else {
		$GLOBALS['errors']['no-serial'] = "There is no Signature corresponding to the serial number:~ " . $serial;
		redirect_header(XOOPS_URL . '/modules/signed/', 10, $GLOBALS['errors']['no-serial']);
	}
?>
