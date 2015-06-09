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
		
	include_once dirname(__FILE__) . '/../../../include/cp_header.php';
	include '../../../class/xoopsformloader.php';
	include_once dirname(__FILE__) . '/admin_header.php';
	xoops_cp_header();
	
	$aboutAdmin = new ModuleAdmin();
	
	echo $aboutAdmin->addNavigation('about.php');
	echo $aboutAdmin->renderabout('-------------', false);
	
	include_once dirname(__FILE__) . '/admin_footer.php';
?>