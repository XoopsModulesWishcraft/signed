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
	
	echo $indexAdmin->addNavigation('admin.php');
	$signaturesHandler = xoops_getmodulehandler('signatures', 'signed');
	
	$indexAdmin->addInfoBox(_SIGNED_AM_DASHBOARD);
	$indexAdmin->addInfoBoxLine(_SIGNED_AM_DASHBOARD, "<infolabel>" ._SIGNED_AM_TOTAL. "</infolabel>", $signaturesHandler->getCount(new Criteria('1', '1')), 'Green');
	$indexAdmin->addInfoBoxLine(_SIGNED_AM_DASHBOARD,  "<infolabel>" ._SIGNED_AM_PROGRESS. "</infolabel>", $signaturesHandler->getCount(new Criteria('state', 'progress')), 'Purple');
	$indexAdmin->addInfoBoxLine(_SIGNED_AM_DASHBOARD,  "<infolabel>" ._SIGNED_AM_ACTIVE. "</infolabel>", $signaturesHandler->getCount(new Criteria('state', 'active')), 'Blue');
	$indexAdmin->addInfoBoxLine(_SIGNED_AM_DASHBOARD,  "<infolabel>" ._SIGNED_AM_INACTIVE. "</infolabel>", $signaturesHandler->getCount(new Criteria('state', 'inactive'))."</infotext>", 'Orange');
	$criteria = new CriteriaCompo(new Criteria('state', 'active'));
	$criteria->add(new Criteria('expires', time(), '>='));
	$criteria->add(new Criteria('expires', time() + (3600 * 24 * 7), '<='));
	$indexAdmin->addInfoBoxLine(_SIGNED_AM_DASHBOARD,  "<infolabel>" ._SIGNED_AM_EXPIRE_NEXT_WEEK. "</infolabel>", $signaturesHandler->getCount($criteria), 'Red');
	$criteria = new CriteriaCompo(new Criteria('state', 'active'));
	$criteria->add(new Criteria('expires', time(), '>='));
	$criteria->add(new Criteria('expires', time() + (3600 * 24 * 14), '<='));
	$indexAdmin->addInfoBoxLine(_SIGNED_AM_DASHBOARD,  "<infolabel>" ._SIGNED_AM_EXPIRE_NEXT_FORTNIGHT. "</infolabel>", $signaturesHandler->getCount($criteria), 'Red');
	$criteria = new CriteriaCompo(new Criteria('1', '1'));
	$criteria->add(new Criteria('expires', 0, '>'));
	$criteria->add(new Criteria('expires', time(), '<='));
	$indexAdmin->addInfoBoxLine(_SIGNED_AM_DASHBOARD,  "<infolabel>" ._SIGNED_AM_EXPIRED. "</infolabel>", $signaturesHandler->getCount($criteria), 'Red');
	$criteria = new CriteriaCompo(new Criteria('1', '1'));
	$criteria->add(new Criteria('issued', time(), '<='));
	$criteria->add(new Criteria('issued', time() - (3600 * 24 * 7), '>='));
	$indexAdmin->addInfoBoxLine(_SIGNED_AM_DASHBOARD,  "<infolabel>" ._SIGNED_AM_ISSUED_LAST_WEEK. "</infolabel>", $signaturesHandler->getCount($criteria), 'Green');
	$criteria = new CriteriaCompo(new Criteria('1', '1'));
	$criteria->add(new Criteria('saved', time(), '<='));
	$criteria->add(new Criteria('saved', time() - (3600 * 24 * 7), '>='));
	$indexAdmin->addInfoBoxLine(_SIGNED_AM_DASHBOARD,  "<infolabel>" ._SIGNED_AM_CREATED_LAST_WEEK. "</infolabel>", $signaturesHandler->getCount($criteria), 'Cyan');
	$criteria = new CriteriaCompo(new Criteria('1', '1'));
	$criteria->add(new Criteria('used', time(), '<='));
	$criteria->add(new Criteria('used', time() - (3600 * 24 * 7), '>='));
	$indexAdmin->addInfoBoxLine(_SIGNED_AM_DASHBOARD,  "<infolabel>" ._SIGNED_AM_ACCESSED_LAST_WEEK. "</infolabel>", $signaturesHandler->getCount($criteria), 'Black');
	$criteria = new CriteriaCompo(new Criteria('1', '1'));
	$criteria->add(new Criteria('issued', time(), '<='));
	$criteria->add(new Criteria('issued', time() - (3600 * 24 * 14), '>='));	
	$indexAdmin->addInfoBoxLine(_SIGNED_AM_DASHBOARD,  "<infolabel>" ._SIGNED_AM_ISSUED_LAST_FORTNIGHT. "</infolabel>", $signaturesHandler->getCount($criteria), 'Green');
	$criteria = new CriteriaCompo(new Criteria('1', '1'));
	$criteria->add(new Criteria('saved', time(), '<='));
	$criteria->add(new Criteria('saved', time() - (3600 * 24 * 14), '>='));
	$indexAdmin->addInfoBoxLine(_SIGNED_AM_DASHBOARD,  "<infolabel>" ._SIGNED_AM_CREATED_LAST_FORTNIGHT. "</infolabel>", $signaturesHandler->getCount($criteria), 'Cyan');
	$criteria = new CriteriaCompo(new Criteria('1', '1'));
	$criteria->add(new Criteria('used', time(), '<='));
	$criteria->add(new Criteria('used', time() - (3600 * 24 * 14), '>='));
	$indexAdmin->addInfoBoxLine(_SIGNED_AM_DASHBOARD,  "<infolabel>" ._SIGNED_AM_ACCESSED_LAST_FORTNIGHT. "</infolabel>", $signaturesHandler->getCount($criteria), 'Black');
	
	echo $indexAdmin->renderIndex();
	
	include_once dirname(__FILE__) . '/admin_footer.php';

?>