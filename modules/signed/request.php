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
	define('_SIGNED_EVENT_SYSTEM', 'request');
	require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'header.php';

	if (!defined('_SIGNATURE_MODE')) {
		header('Location: '. _URL_ROOT);
		exit(0);
	}
	
	if (!isset($_SESSION["signed"]['serial']) && isset($_GET['serial'])) {
		$_SESSION["signed"]['serial'] = $_GET['serial'];
		$_SESSION["signed"]['start'] = microtime();
	}
	
	$GLOBALS['io'] = signedStorage::getInstance(_SIGNED_RESOURCES_STORAGE);
	
	if (!$GLOBALS['io']->file_exists(_PATH_PATHWAYS_REQUEST, $_SESSION["signed"]['serial'])) {
		signed_goReset();
		header('Location: ' . _URL_ROOT);
		exit(0);
	}
	
	if (!isset($_SESSION["signed"]['request']) || empty($_SESSION["signed"]['request']) && isset($_SESSION["signed"]['serial'])) {
		$_SESSION["signed"]['request'] = $GLOBALS['io']->load(_PATH_PATHWAYS_REQUEST, $_SESSION["signed"]['serial']);
		$resource  = $GLOBALS['io']->load(_PATH_REPO_SIGNATURES, $_SESSION["signed"]['serial']);
		$_SESSION["signed"]['package'] = $resource['resources']['signature'];
	}
	/**
	 * Prompting Sessioning
	 */
	if (!isset($_SESSION["signed"]['prompts'])) {
		$prompts = signed_getRequestPromptsArray($_SESSION["signed"]['serial']);
		$_SESSION["signed"]['prompts'] = $prompts[constant('_SIGNATURE_MODE')];
	}
	$promptskeys = array_keys($_SESSION["signed"]['prompts']);

	if (!isset($_SESSION["signed"]['action'])) {
		$_SESSION["signed"]['action'] = $promptskeys[0]; 
		$_SESSION["signed"]['stepstogo'] = signed_getRequestStepsInPrompt($_SESSION["signed"]['action'], $_SESSION["signed"]['serial']);
		$_SESSION["signed"]['finished'] = false;
		$_SESSION["signed"]['package'] = array();
		$_SESSION["signed"]['workbook'] = array();
	}

	/**
	 * Inbound Data
	 */
	if (strtoupper($_SERVER["REQUEST_METHOD"])=="POST" && isset($_REQUEST['step'])) {
		if (signed_goVerifyAndPackagePrompt($_SESSION["signed"]['action'], $_REQUEST['step'])) {
			if (count(signed_getStepsLeftPrompt($_SESSION["signed"]['action'], $_REQUEST['step']))==0) {
				$next = '';
				$found = false;
				foreach($promptskeys as $prompt) {
					if ($found==true) {
						$_SESSION["signed"]['action'] = $prompt;
						$_SESSION["signed"]['stepstogo'] = signed_getRequestStepsInPrompt($_SESSION["signed"]['action'], $_SESSION["signed"]['serial']);
						$found= false;
						continue;
						continue;
					}
					if ($prompt == $_SESSION["signed"]['action']) {
						unset($_SESSION["signed"]['stepstogo'][$_REQUEST['step']]);
						if (count($_SESSION["signed"]['stepstogo'])==0) {
							$_SESSION["signed"]['action'] = '';
							$found = true;
						} else {
							continue;
						}
					}
				}
				if ($found == true && empty($_SESSION["signed"]['action'])) {
					$_SESSION["signed"]['finished'] = true;
					$_SESSION["signed"]['stepstogo'] = array();
					$_SESSION["signed"]['action'] = $promptskeys[count($promptskeys)-1];
				}		
			}
		}
	}
	define('_SIGNED_EVENT_TYPE', $_SESSION["signed"]['action']);
	
	/**
	 * Buffer Templates to output buffer
	 */
	signed_goBufferPrompt($_SESSION["signed"]['action'], signed_getNextStepInPrompt($_SESSION["signed"]['action'], $_SESSION["signed"]['stepstogo']));
	
	require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'footer.php';
?>