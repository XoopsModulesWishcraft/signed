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
		
	include_once dirname(__FILE__) . '/admin_header.php';
	xoops_cp_header();
	
	$indexAdmin = new ModuleAdmin();
	echo $indexAdmin->addNavigation('signatures.php');
	
	$start = intval(isset($_REQUEST['start']) ? $_REQUEST['start'] : "0");
	$limit = intval(isset($_REQUEST['limit']) ? $_REQUEST['limit'] : "42");
	
	$signatureHandler = xoops_getmodulehandler('signatures', 'signed');
	$pageNav = new XoopsPageNav($signatureHandler->getCount(new Criteria("1","1")), $limit, $start, 'start', 'limit='.$limit);
	
	$GLOBALS['xoopsTpl']->assign('pagenav', $pageNav->renderNav(5));
	$GLOBALS['xoopsTpl']->append('signatures', $signatureHandler->getAdminTabled($start, $limit));
	$GLOBALS['xoopsTpl']->display($GLOBALS['xoops']->path('/modules/signed/templates/admin/signed_signatures.html'));
	
	include_once dirname(__FILE__) . '/admin_footer.php';

?>