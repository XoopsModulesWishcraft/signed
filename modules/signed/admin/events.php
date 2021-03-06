<?php
/**
 * Private message
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         pm
 * @since           2.3.0
 * @author          Jan Pedersen
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @version         $Id: prune.php 12593 2014-06-14 16:04:02Z beckmi $
 */
	
	include_once dirname(__FILE__) . '/admin_header.php';
	xoops_cp_header();
	
	$indexAdmin = new ModuleAdmin();
	echo $indexAdmin->addNavigation('events.php');

	$start = intval(isset($_REQUEST['start']) ? $_REQUEST['start'] : "0");
	$limit = intval(isset($_REQUEST['limit']) ? $_REQUEST['limit'] : "42");
	
	$eventsHandler = xoops_getmodulehandler('events', 'signed');
	$pageNav = new XoopsPageNav($eventsHandler->getCount(new Criteria("1","1")), $limit, $start, 'start', 'limit='.$limit);
	
	$GLOBALS['xoopsTpl']->assign('pagenav', $pageNav->renderNav(5));
	$GLOBALS['xoopsTpl']->append('signatures', $eventsHandler->getAdminTabled($start, $limit));
	$GLOBALS['xoopsTpl']->display($GLOBALS['xoops']->path('/modules/signed/templates/admin/signed_events.html'));
	
	include_once dirname(__FILE__) . '/admin_footer.php';
	
?>