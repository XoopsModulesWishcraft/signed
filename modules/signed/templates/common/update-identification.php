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
	
	if (!defined('_SIGNATURE_MODE'))
		die('_ERROR_NO_SIGNATURE_MODE_DEFINED');
	
	$GLOBALS['io'] = signedStorage::getInstance(_SIGNED_RESOURCES_STORAGE);
	$verification = $GLOBALS['io']->load(_PATH_REPO_VALIDATION, $_SESSION["signed"]['serial']);
	if ($verification['verification']['expired'] == true) {
		
		/**
		 * Prompting Sessioning
		 */
		if (!isset($_SESSION["signed"]['prompts'])) {
			foreach(returnKeyed(_SIGNATURE_MODE, 'signed_getPromptsArray') as $key => $prompt) {
				if ($key == 'fields-identification-identification-form') {
					$prompt['type'] = 'update';
					$_SESSION["signed"]['prompts']['update-identification-identification-form'] = $prompt;
				} elseif ($prompt['class']=='finished') {
					$prompt['class']=='finished-update';
					$prompt['for'] = 'identification';
					$_SESSION["signed"]['prompts']['help-'.$prompt['for'].'-'.$prompt['class']] = $prompt;
				}
			}
		}
		$promptskeys = array_keys($_SESSION["signed"]['prompts']);
		if (!isset($_SESSION["signed"]['prompt']))
			$_SESSION["signed"]['prompt'] = 'update-identification-identification-form';
		if (!isset($_SESSION["signed"]['stepstogo']))
			$_SESSION["signed"]['stepstogo'] = array($_SESSION["signed"]['key']);
	
		/**
		 * Inbound Data
		 */
		if (strtoupper($_SERVER["REQUEST_METHOD"])=="POST") {
			if (signed_goVerifyAndPackagePrompt($_SESSION["signed"]['prompt'], $_REQUEST['step'])) {
				if (count(signed_getStepsLeftPrompt($_SESSION["signed"]['prompt'], $_REQUEST['step']))==0) {
					if ($GLOBALS['io'] = signedStorage::getInstance(_SIGNED_RESOURCES_STORAGE)) { 
						$array = $GLOBALS['io']->load(_PATH_REPO_SIGNATURES, $_SESSION["signed"]['serial']);
						$resources['resources']['signature']['identifications'][$_REQUEST['step']] = $_SESSION["signed"]['package']['identifications'][$_REQUEST['step']];
						$GLOBALS['io']->save($resources, _PATH_REPO_SIGNATURES, $_SESSION["signed"]['serial']);
						
						$GLOBALS['io'] = signedStorage::getInstance(_SIGNED_RESOURCES_STORAGE);
						$verification = $GLOBALS['io']->load(_PATH_REPO_VALIDATION, $_SESSION["signed"]['serial']);
						
						$verification = XML2Array::createArray(file_get_contents(_PATH_REPO_VALIDATION . _DS_ . $_SESSION["signed"]['serial'] . '.xml'));
						$verification['verification']['expired'] == false;
						$GLOBALS['io']->save($verification, _PATH_REPO_VALIDATION, $_SESSION["signed"]['serial']);
						
						signed_lodgeCallbackSessions($_SESSION["signed"]['serial'], 'update');
						
						$_SESSION["signed"]['prompt'] = 'help-identification-finished-update';
						$GLOBALS['url'] = _URL_ROOT . '/=updator=/?op=finished&serial='.$_SESSION["signed"]['serial'];
						?>
<p style="font-size: 2.345em; font-weight:bold; text-align: center; margin-bottom: 19px;"><?php echo _CONTENT_COMMON_UPDATE_P1; ?></p>
<p style="font-size: 1.345em; font-weight:bold; text-align: center;"><?php sprintf(_CONTENT_COMMON_UPDATE_P2, _URL_IMAGES, $GLOBALS['url']); ?>"></p>
						<?php 
						$nobuffer = true;
					}
				}
			}
		}
		
		/**
		 * Buffer Templates to output buffer
		 */
		if (!isset($nobuffer))
			signed_goBufferPrompt($_SESSION["signed"]['prompt'], signed_getNextStepInPrompt($_SESSION["signed"]['prompt'], $_SESSION["signed"]['stepstogo']));
	} else {
		$GLOBALS['errors']['not-expired'] = "The Identification you are trying to edit has not or is not on an expired digital signature!";
	}	
?>