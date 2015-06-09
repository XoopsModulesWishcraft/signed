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
 * @subpackage		class
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */


defined('_PATH_ROOT') or die('Restricted access');

/**
 *
 * @author Simon Roberts <simon@labs.coop>
 *
*/
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'signedobject.php';
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'signedprocesses.php';


/**
 *
 * @author Simon Roberts <simon@labs.coop>
 *
 */
class signedPrompts extends signedObject
{

	/**
	 *
	 * @var unknown
	 */
	var $_processes = NULL;
		
	/**
	 *
	 */
	function __construct()
	{
		
		$this->_processes = signedProcesses::getInstance();
	}
	
	/**
	 *
	 */
	function __destruct()
	{
	
	}
	
	/**
	 *
	 * @return Ambigous <NULL, signedProcessess>
	 */
	static function getInstance()
	{
		static $object = NULL;
		if (!is_object($object))
			$object = new signedPrompts();
		$object->intialise();
		return $object;
	}
	
	/**
	 *
	 */
	function doesRequestMakeExpiry($requests)
	{
		$states = $this->_processes->getRequestStatesArray();
		foreach($requests as $type => $causalities) {
			foreach($causalities as $clause => $request) {
				switch ($clause)
				{
					default:
						foreach($request as $field => $state) {
							if ($states[$state]==true)
								return true;
						}
						break;
					case "identification":
					case "identifications":
						foreach($request as $key => $values) {
							foreach($values as $field => $state) {
								if ($states[$state]==true)
									return true;
							}
						}
				}
			}
		}
	}
	

	/**
	 *
	 */
	function getStepsLeftPrompt($prompt = '', $step = '') {
		foreach($_SESSION["signed"]['stepstogo'] as $key => $value)
		if ($value == $step)
			unset($_SESSION["signed"]['stepstogo'][$key]);
		return $_SESSION["signed"]['stepstogo'];
	}
	

	/**
	 *
	 */
	function getRequestStepsInPrompt($prompt = '', $serial = ''){
		return $this->getStepsInPrompt($prompt);
	}
	
	/**
	 *
	 */
	function getStepsInPrompt($prompt = '') {
		switch($_SESSION["signed"]['prompts'][$prompt]['class']) {
			default:
				return $_SESSION["signed"]['steps']['prompt'][$prompt] = array('passthru');
				break;
			case "updating":
			case "introduction":
				return $_SESSION["signed"]['steps']['prompt'][$prompt] = array('primary');
				break;
			case "needed":
				return $_SESSION["signed"]['steps']['prompt'][$prompt] = array('identification-types');
				break;
			case "generic-edit-form":
			case "generic-form":
				return $_SESSION["signed"]['steps']['prompt'][$prompt] = array('verify');
				break;
			case "identification-edit-form":
				if (isset($_SESSION["signed"]['request'][_SIGNATURE_MODE]['identification']))
					return $_SESSION["signed"]['steps']['prompt'][$prompt] = array_keys($_SESSION["signed"]['request'][_SIGNATURE_MODE]['identification']);
				return $_SESSION["signed"]['steps']['prompt'][$prompt] = array();
				break;
			case "identification-form":
				return $_SESSION["signed"]['steps']['prompt'][$prompt] = $_SESSION["signed"]['identifications'];
				break;
			case "update-email":
			case "send-email":
				return $_SESSION["signed"]['steps']['prompt'][$prompt] = array('automatic');
				break;
			case "finished-edit":
			case "finished":
				return $_SESSION["signed"]['steps']['prompt'][$prompt] = array('reset');
				break;
		}
	}
	
	/**
	 *
	 */
	function getNextStepInPrompt($prompt = '', $steps = array()) {
		if (empty($steps))
			$steps = $this->getStepsInPrompt($prompt);
		if (is_array($steps)) {
			$keys = array_keys($steps);
			return $steps[$keys[0]];
		}
		return false;
	}
	
	/**
	 *
	 */
	function goVerifyAndPackagePrompt($prompt = '', $step = '', $mode = '') {
		if (empty($mode))
			$mode = constant('_SIGNATURE_MODE');
		if (!isset($_POST['fields-typal']) && $mode != $_POST['fields-typal'])
			$mode = $_POST['fields-typal'];
		switch($step)
		{
			default:
				if (in_array($step, $_SESSION["signed"]['identifications'])) {
					$package = $this->goVerifyForm('identification', 'identification-form', $step);
					if ($package==false)
						return false;
					$_SESSION["signed"]['package']['identifications'][$step] = $package;
				}
				break;
			case 'primary':
				$_SESSION["signed"]['class'] = $_REQUEST['class'];
				$_SESSION["signed"]['expiry'] = $_REQUEST['expires'];
				break;
			case 'passthru':
				return true;
				break;
			case 'identification-types':
				$_SESSION["signed"]['identifications'] = $_REQUEST['identification'];
				return true;
				break;
			case 'verify':
				$package = $this->goVerifyForm($mode, $_SESSION["signed"]['prompts'][$prompt]['class'], $step);
				if ($package==false)
					return false;
				$_SESSION["signed"]['package'][$mode] = $package;
				break;
			case 'automatic':
				break;
			case 'reset':
				$this->goReset();
				return true;
				break;
		}
		if (isset($GLOBALS['errors'])&&count($GLOBALS['errors'])>0)
			return false;
	
		if (isset($package) && !empty($package)){
			$validations = $this->_arrays->returnKeyed($mode, 'getValidationsArray', 'signedProcesses');
			if (isset($validations['pathways']) && is_array($validations['pathways']) && !empty($validations['pathways'])) {
				foreach($validations['pathways'] as $key => $values) {
					foreach($values['fields'] as $field) {
						if (isset($package[$field]) && !empty($package[$field])) {
							switch ($key) {
								default:
									$_SESSION["signed"]['pathways'][$key][sha1(strtolower($package[$field]))] = $package[$field];
									break;
								case "dates":
									$_SESSION["signed"]['pathways'][$key][sha1(date("Y-m-d", strtotime($package[$field])))] = date("Y-m-d", strtotime($package[$field]));
									break;
							}
		
						}
					}
				}
			}
		}
		return true;
	}
	
	/**
	 *
	 */
	function goReset() {
		session_destroy();
	}
	
	/**
	 *
	 */
	function getFormHandler($form = '') {
		static $handlers = array();
		if (!isset($handlers[$form])) {
			switch($form)
			{
				default:
					include_once _PATH_ROOT . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'form-' . $form . '.php';
					$classname = $GLOBALS['forms'][$form]['class'];
					if (class_exists($classname))
						$handlers[$form] = new $classname();
					else
						die('Class missing: ' . $classname . ' ! for Form: ' . $form);
					break;
				case 'generic-edit-form':
				case 'generic-form':
				case 'identification-edit-form':
				case 'identification-form':
					include_once _PATH_ROOT . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'form-' . $form . '.php';
					$classname = $GLOBALS['forms'][$form]['class'];
					if (class_exists($classname))
						$handlers[$form] = new $classname();
					else
						die('Class missing: ' . $classname . ' ! for Form: ' . $form);
					break;
			}
		}
		return $handlers[$form];
	}
	
	
	/**
	 *
	 */
	function goVerifyForm($mode = '', $form = '', $step = '') {
		$formHandler = $this->getFormHandler($form);
		if (!isset($_POST['fields-typal']) && $mode != $_POST['fields-typal'])
			$mode = $_POST['fields-typal'];
		return $formHandler->verify($mode, $_REQUEST, $step);
	}
	
}
