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
header('Content-type: application/json');
define('_SIGNED_EVENT_SYSTEM', 'api');
define('_SIGNED_EVENT_TYPE', 'help');
require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'header.php';
ini_set("zlib.output_compression", 'Off');
ini_set("zlib.output_compression_level", -1);
require dirname(__FILE__) . _DS_ . 'validate.php';
require _PATH_TEMPLATES . _DS_ . 'common' . _DS_ . 'api.php';
require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'footer.php';
?>