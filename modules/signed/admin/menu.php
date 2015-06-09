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
 * @subpackage		administration
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */
	
	$path = dirname(dirname(dirname(dirname(__FILE__))));
	include_once $path . '/mainfile.php';
	
	$dirname         = basename(dirname(dirname(__FILE__)));
	$module_handler  = xoops_gethandler('module');
	$module          = $module_handler->getByDirname($dirname);
	$pathIcon32      = $module->getInfo('icons32');
	$pathModuleAdmin = $module->getInfo('dirmoduleadmin');
	$pathLanguage    = $path . $pathModuleAdmin;
	
	if (!file_exists($fileinc = $pathLanguage . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/' . 'main.php')) {
	    $fileinc = $pathLanguage . '/language/english/main.php';
	}
	
	include_once $fileinc;
	
	$adminmenu = array();
	
	$i = 1;
	$adminmenu[$i]['title'] = _SIGNED_MI_INDEX;
	$adminmenu[$i]['link'] = "admin/admin.php";
	$adminmenu[$i]['icon']  = $pathIcon32.'/security.png' ;
	++$i;
	$adminmenu[$i]['title'] = _SIGNED_MI_SIGNATURES;
	$adminmenu[$i]['link'] = "admin/signatures.php";
	$adminmenu[$i]['icon']  = $pathIcon32.'/identity.png' ;
	++$i;
	$adminmenu[$i]['title'] = _SIGNED_MI_EVENTS;
	$adminmenu[$i]['link'] = "admin/events.php";
	$adminmenu[$i]['icon']  = $pathIcon32.'/event.png' ;
	++$i;
	$adminmenu[$i]['title'] = _SIGNED_MI_ABOUT;
	$adminmenu[$i]['link']  = 'admin/about.php';
	$adminmenu[$i]['icon']  = $pathIcon32.'/about.png';

?>