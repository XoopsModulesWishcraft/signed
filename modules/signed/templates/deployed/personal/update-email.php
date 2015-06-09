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
 * @subpackage		templates
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */
?><?php
	$verify = returnKeyed(_SIGNATURE_MODE, 'getValidationsArray');
	signed_sealEditedPackage('personal');
	
	signed_saveEditedPackageXML($_SESSION["signed"]['package']['serial-number'], $_SESSION["signed"]['package']);
	signed_lodgeCallbackSessions($_SESSION["signed"]['package']['serial-number'], 'request');
		
	$mode = $_SESSION["signed"]['signature_mode'];
	if (!$GLOBALS['configurations']['htaccess'])
		$GLOBALS['url'] = _URL_ROOT . '/=generator=/?op=finished&serial='.$_SESSION["signed"]['package']['serial-number'];
	else 
		$GLOBALS['url'] = _URL_ROOT . '/=generator=/finished/'.$_SESSION["signed"]['package']['serial-number'].$GLOBALS['configurations']['htaccess_extension'];
	
	session_destroy();
	session_start();
	$_SESSION["signed"]['signature_mode'] = $mode;
	$_SESSION["signed"]['action'] = 'help-personal-finished';
	$_SESSION["signed"]['stepstogo'] = 'passthru';
	$GLOBALS['pause'] = 9;
?>
<p style="font-size: 2.345em; font-weight:bold; text-align: center; margin-bottom: 19px;"><?php echo _CONTENT_DEPLOYED_PERSONAL_EMAIL_P1; ?></p>
<p style="font-size: 1.345em; font-weight:bold; text-align: center;"><?php echo $msg = sprintf(_CONTENT_DEPLOYED_PERSONAL_EMAIL_P2, constant("_URL_IMAGES"), $GLOBALS['url']); ?></p>
<?php redirect_header($GLOBALS['url'], $GLOBALS['pause'], $msg); ?>
