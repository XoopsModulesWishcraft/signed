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
header('Content-type: application/json');
set_time_limit(120);
$passed = true;
if (isset($_REQUEST['fields-typal'])) {
	foreach($_REQUEST['fields-required'] as $key => $field) {
		if (is_array($_REQUEST[$_REQUEST['fields-typal']][$field])) {
			foreach($_REQUEST[$_REQUEST['fields-typal']][$field] as $keyb => $value)
				if (empty($value)||strlen(trim($value))==0)
					$passed = false;
		} else {
			if (empty($_REQUEST[$_REQUEST['fields-typal']][$field])||strlen(trim($_REQUEST[$_REQUEST['fields-typal']][$field]))==0)
				$passed = false;
		}
	}
} else {
	foreach($_REQUEST['fields-required'] as $key => $field) {
		if (is_array($_REQUEST[$field])) {
			foreach($_REQUEST[$field] as $keyb => $value)
			if (empty($value)||strlen(trim($value))==0)
				$passed = false;
		} else {
			if (empty($_REQUEST[$field])||strlen(trim($_REQUEST[$field]))==0)
				$passed = false;
		}
	}
}
if ($passed==true){
	$values['disable']['submit-next'] = 'false';	
} else {	
	$values['disable']['submit-next'] = 'true';	
}
print json_encode($values);
?>