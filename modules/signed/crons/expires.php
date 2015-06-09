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
 * @subpackage		module
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */

/**
 * CronJob/Scheduled Task is Run Once A Day!
 */
define('_SIGNED_CRON_EXECUTING', microtime(true));
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'common.php';

$GLOBALS['io'] = signedStorage::getInstance(_SIGNED_RESOURCES_STORAGE);

if (is_dir($dir = _PATH_CALENDAR_EXPIRES . _DS_ . date('Y') . _DS_ . date('m'))) {
	foreach(signedLists::getFileListAsArray($dir) as $file) {
		$expires = $GLOBALS['io']->load($dir, str_replace($GLOBALS['io']->_extensions, "", $file));
		if (isset($expires['expires'])) {
				
			// Expire Temporarily
			$verification = $GLOBALS['io']->load(_PATH_REPO_VALIDATION, $expires['expires']['serial-number']);
			$verification['verification']['expired'] == true;
			$GLOBALS['io']->save($verification, _PATH_REPO_VALIDATION, $expires['expires']['serial-number']);			
			signed_lodgeCallbackSessions($expires['expires']['serial-number'], 'expired');

			$resource  = $GLOBALS['io']->load(_PATH_REPO_SIGNATURES, $expires['expires']['serial-number']);
			$identifications = returnKey($resource['resources']['signature']['signature']['type'], 'signed_getIdentificationsArray');
			
			$mailer = signed_getMailer();
			$mailer->setTemplateDir(_PATH_ROOT . _DS_ . 'language' . _DS_ . _SIGNED_CONFIG_LANGUAGE  . _DS_ . 'mail_template');
			
			switch($resource['resources']['signature']['signature']['type']) {
				case 'personal':
					$to 	= 	array(	'name'	=>	$resource['resources']['signature']['personal']['name'],
					'email'	=>	$resource['resources']['signature']['personal']['email']);
					break;
				case 'entity':
					$to 	= 	array(	0 =>	array(	'name'	=>	$resource['resources']['signature']['personal']['name'],
					'email'	=>	$resource['resources']['signature']['personal']['email']),
					1 =>	array(	'name'	=>	$resource['resources']['signature']['personal']['name'],
					'email'	=>	$resource['resources']['signature']['entity']['entity-email']));
					break;
			}
			
			$data['IDENTIFICATION_TYPE'] = $identifications[$expires['expires']['key']];
			$data['IDENTIFICATION_NUMBER'] = $resource['resources']['identifications'][$expires['expires']['key']]['serial-number'];
			$data['IDENTIFICATION_EXPIRE_MONTH'] = $resource['resources']['identifications'][$expires['expires']['key']]['expiry-month'];
			$data['IDENTIFICATION_EXPIRE_YEAR'] = $resource['resources']['identifications'][$expires['expires']['key']]['expiry-year'];
			$data['UPDATE_URL'] = signed_shortenURL(_URL_ROOT . '/=updator=/?op=identification&serial='.$expires['serial-number'].'&key='.$expires['expires']['key'].'&signature_mode='.$resource['resources']['signature']['signature']['type']);
			$data['SERIAL_NUMBER'] = $expires['expires']['serial-number'];
			$data['PERSON_FOR'] = $resource['resources']['signature']['signature']['signer']['name'];
			$data['PERSON_BY'] = $resource['resources']['signature']['signature']['signee']['name'];
			
			$body = $mailer->getBodyFromTemplate('expired-identification', $data, true);
			
			if ($mailer->sendMail($to, array(), array(), 'Expired Identification on Digital Signature for '.$resource['resources']['signature']['signature']['signer']['name'], $body['body'], array(), array(), $body['isHTML'])) {						
				unlink($dir . _DS_ . $file);
			}
		}
	}	
}
?>