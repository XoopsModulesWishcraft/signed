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