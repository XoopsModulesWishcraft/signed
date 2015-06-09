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
 * CronJob/Scheduled Task is Run Many Times A Day!
 */
define('_SIGNED_CRON_EXECUTING', microtime(true));
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'common.php';

if (is_dir(_PATH_PATHWAYS_REQUEST)) {
	foreach(signedLists::getFileListAsArray(_PATH_PATHWAYS_REQUEST) as $file) {
		$serial = str_replace($GLOBALS['io']->_extensions, "", $file);
		$request = $GLOBALS['io']->load($dir, str_replace($GLOBALS['io']->_extensions, "", $file));;
		if ($request['reminder']<time()) {

			$verification = XML2Array::createArray(file_get_contents(_PATH_REPO_VALIDATION . _DS_ . $serial . '.xml'));
			$verification = $GLOBALS['io']->load(_PATH_REPO_VALIDATION, $serial);
			if (signed_doesRequestMakeExpiry($request['request'])==true) {
				// Expire Permantly
				if ($verification['verification']['expired'] == false) {
					$verification = $GLOBALS['io']->load(_PATH_REPO_VALIDATION, $serial);
					$verification['verification']['expired'] == true;
					$GLOBALS['io']->save($verification, _PATH_REPO_VALIDATION, $serial);			
					signed_lodgeCallbackSessions($serial, 'expired');
				}
			}
											
			$resource  = $GLOBALS['io']->load(_PATH_REPO_SIGNATURES, $serial);
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

			$data['SERIAL_NUMBER'] = $serial;
			$data['PERSON_FOR'] = $resource['resources']['signature']['signature']['signer']['name'];
			$data['PERSON_BY'] = $resource['resources']['signature']['signature']['signee']['name'];
			
			if ($verification['verification']['expired']==true) {
				$data['EXPIRY_STATE'] = 'has been temporarily expired until the update is done';
			} else {
				$data['EXPIRY_STATE'] = 'has not been temporarily expired as the changes are only minor';
			}
			
			$data['EDIT_URL'] = signed_shortenURL(_URL_ROOT . '/=request=/?serial='.$serial.'&signature_mode='.$resource['resources']['signature']['signature']['type']);
			$data['REJECT_URL'] = signed_shortenURL(_URL_ROOT . '/=reject=/?serial='.$serial);
			
			$data['REQUEST_HTML'] = signed_getRequestText($request['request'], 'html');
			$data['REQUEST_TEXT'] = signed_getRequestText($request['request'], 'text');
			
			$body = $mailer->getBodyFromTemplate('update-request', $data, true);
			
			if ($mailer->sendMail($to, array(), array(), 'Data update to require for a signature for '.$resource['resources']['signature']['signature']['signer']['name'], $body['body'], array(), array(), $body['isHTML'])) {						
				$request['reminder'] = time() + _SIGNED_EMAIL_QUEUED;
				$request['sent'] = time();			
				$GLOBALS['io']->save($request, _PATH_PATHWAYS_REQUEST, $serial);
			}
		}
	}	
}
?>