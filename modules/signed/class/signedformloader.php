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

include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('Form') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('ThemeForm') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('SimpleForm') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormElement') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormElementTray') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormLabel') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormCheckBox') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormPassword') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormButton') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormButtonTray') . '.php'; // To be cleaned
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormHidden') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormFile') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormRadio') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormRadioYN') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormSelect') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormSelectMatchOption') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormSelectCountry') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormSelectTimeZone') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormSelectEditor') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormSelectEnumerator') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormSelectMonths') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormSelectYears') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormText') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormTextArea') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormTextDateSelect') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormDhtmlTextArea') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormDateTime') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormHiddenToken') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormColorPicker') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormCaptcha') . '.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'signedform' . DIRECTORY_SEPARATOR . strtolower('FormEditor') . '.php';

?>