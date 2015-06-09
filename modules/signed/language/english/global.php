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
 * @subpackage		language
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */

if (!defined('_SITE_GLOBALS')) {
		
	define('_SITE_GLOBALS', true);
	
	define('_SITE_EMAIL', 'wishcraft@users.sourceforge.net');
	define('_SITE_NAME', 'Digital Signatures');
	define('_SITE_COMPANY', 'Chronolabs Cooperative');
	define('_SITE_FROM_EMAIL', 'noreply@labs.coop');
	define('_SITE_FROM_NAME', _SITE_NAME . ' ('._SITE_COMPANY.')');
	
	define("_SIGNED_NOT_DISCOVERABLE", "None Discoverable API");
	define("_SIGNED_IS_DISCOVERABLE", "Discoverable API");
	
	xoops_loadLanguage('global', 'global');

}
?>