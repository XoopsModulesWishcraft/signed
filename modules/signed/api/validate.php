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
 * @subpackage		api
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */

	if (defined("_SIGNED_API_ENABLED")) {
		if (constant("_SIGNED_API_ENABLED")==false) 
		{
			header("Location: " . _URL_ROOT);
			exit(0);
		}
	}

	require_once _PATH_ROOT . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'signedapi.php';
	$GLOBALS['api'] = signedAPI::getInstance(isset($_REQUEST['format']) && in_array($_REQUEST['format'], array('xml', 'json', 'serial'))?$_REQUEST['format']:_SIGNED_API_FORMAT);

?>