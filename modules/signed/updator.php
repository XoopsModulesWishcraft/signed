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
	define('_SIGNED_EVENT_SYSTEM', 'updator');
	require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'header.php';
	if (!isset($_SESSION["signed"]['op']))
		$_SESSION["signed"]['op'] = isset($_GET['op'])?$_GET['op']:'identification';
	if (!isset($_SESSION["signed"]['serial']))
		$_SESSION["signed"]['serial'] = isset($_GET['serial'])?$_GET['serial']:md5(NULL);
	if (!isset($_SESSION["signed"]['key']))
		$_SESSION["signed"]['key'] = isset($_GET['key'])?$_GET['key']:md5(NULL);
	define('_SIGNED_EVENT_TYPE', $_SESSION["signed"]['op']);
	require _PATH_TEMPLATES . _DS_ . 'common' . _DS_ . 'update-'.$_SESSION["signed"]['op'].'.php';
	require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'footer.php';
?>