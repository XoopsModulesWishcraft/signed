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
 * @license			General Software Licence (http://labs.coop/briefs/legal/general-software-license/10,3.html)
 * @license			End User License (http://labs.coop/briefs/legal/end-user-license/11,3.html)
 * @license			Privacy and Mooching Policy (http://labs.coop/briefs/legal/privacy-and-mooching-policy/22,3.html)
 * @license			General Public Licence 3 (http://labs.coop/briefs/legal/general-public-licence/13,3.html)
 * @category		signed
 * @since			2.1.9
 * @version			2.2.0
 * @author			Simon Antony Roberts (Aus Passport: M8747409) <wishcraft@users.sourceforge.net>
 * @author          Simon Antony Roberts (Aus Passport: M8747409) <wishcraft@users.sourceforge.net>
 * @subpackage		class
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			Farming Digital Fingerprint Signatures: https://signed.ringwould.com.au
 * @link			Heavy Hash-info Digital Fingerprint Signature: http://signed.hempembassy.net
 * @link			XOOPS SVN: https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/signed/
 * @see				Release Article: http://cipher.labs.coop/portfolio/signed-identification-validations-and-signer-for-xoops/
 * @filesource
 *
 */

xoops_load('XoopsFormLoader');

include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('Form') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('ThemeForm') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('SimpleForm') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormElement') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormElementTray') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormLabel') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormCheckBox') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormPassword') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormButton') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormButtonTray') . '.php'; // To be cleaned
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormHidden') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormFile') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormRadio') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormRadioYN') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormSelect') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormSelectMatchOption') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormSelectCountry') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormSelectTimeZone') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormSelectEditor') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormSelectEnumerator') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormSelectMonths') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormSelectYears') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormText') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormTextArea') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormTextDateSelect') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormDhtmlTextArea') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormDateTime') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormHiddenToken') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormColorPicker') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormCaptcha') . '.php';
include_once _PATH_ROOT . _DS_ . 'class' . _DS_ . 'signedform' . _DS_ . strtolower('FormEditor') . '.php';

?>