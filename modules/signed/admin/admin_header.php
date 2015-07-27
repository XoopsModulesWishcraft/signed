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
	
	define("_PATH_ROOT", dirname(__DIR__));
	
	require_once '../../../mainfile.php';
	require_once '../../../include/cp_functions.php';
	require_once '../../../include/cp_header.php';
	
	
	global $xoopsModule;	
	$thisModuleDir = $GLOBALS['xoopsModule']->getVar('dirname');

	// Load language files
	xoops_loadLanguage('admin', $thisModuleDir);
	xoops_loadLanguage('modinfo', $thisModuleDir);
	xoops_loadLanguage('main', $thisModuleDir);
	
	xoops_load('pagenav');
	
	$pathIcon16 = '../'.$xoopsModule->getInfo('icons16');
	$pathIcon32 = '../'.$xoopsModule->getInfo('icons32');
	$pathModuleAdmin = $xoopsModule->getInfo('dirmoduleadmin');
	
	include_once $GLOBALS['xoops']->path($pathModuleAdmin.'/moduleadmin.php');
	
	if ($xoopsUser) {
	    $moduleperm_handler =& xoops_gethandler('groupperm');
	    if (!$moduleperm_handler->checkRight('module_admin', $xoopsModule->getVar('mid'), $xoopsUser->getGroups())) {
	        redirect_header(XOOPS_URL, 1, _NOPERM);
	        exit();
	    }
	} else {
	    redirect_header(XOOPS_URL . "/user.php", 1, _NOPERM);
	    exit();
	}
	
	if (!isset($xoopsTpl) || !is_object($xoopsTpl)) {
	  include_once(XOOPS_ROOT_PATH."/class/template.php");
	  $xoopsTpl = new XoopsTpl();
	}
	
	if (!isset($GLOBALS['xoopsTpl']) || !is_object($GLOBALS['xoopsTpl'])) {
	    include_once XOOPS_ROOT_PATH . '/class/template.php';
	    $GLOBALS['xoopsTpl'] = new XoopsTpl();
	}
?>