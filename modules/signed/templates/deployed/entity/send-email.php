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
 * @license			General Software Licence (http://labs.coop/briefs/legal/general-software-license/10,3.html)
 * @license			End User License (http://labs.coop/briefs/legal/end-user-license/11,3.html)
 * @license			Privacy and Mooching Policy (http://labs.coop/briefs/legal/privacy-and-mooching-policy/22,3.html)
 * @license			General Public Licence 3 (http://labs.coop/briefs/legal/general-public-licence/13,3.html)
 * @category		signed
 * @since			2.1.9
 * @version			2.2.0
 * @author			Simon Antony Roberts (Aus Passport: M8747409) <wishcraft@users.sourceforge.net>
 * @author          Simon Antony Roberts (Aus Passport: M8747409) <wishcraft@users.sourceforge.net>
 * @subpackage		templates
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			Farming Digital Fingerprint Signatures: https://signed.ringwould.com.au
 * @link			Heavy Hash-info Digital Fingerprint Signature: http://signed.hempembassy.net
 * @link			XOOPS SVN: https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/signed/
 * @see				Release Article: http://cipher.labs.coop/portfolio/signed-identification-validations-and-signer-for-xoops/
 * @filesource
 *
 */
?><?php
	$verify = signedArrays::getInstance()->returnKeyed(_SIGNATURE_MODE, 'getValidationsArray');
	signedPackages::getInstance()->sealPackage('entity');
	$code = signedCiphers::getInstance()->getSignatureCode(_SIGNATURE_MODE, $_SESSION["signed"]['package']);
	$certificate = signedCiphers::getInstance()->getSignatureCertificate(_SIGNATURE_MODE, $_SESSION["signed"]['package']);
	signedPackages::getInstance()->saveEnsigmentPackage($_SESSION["signed"]['package']['serial-number'], $code, $certificate, $_SESSION["signed"]['package'], $verify);
	$mode = $_SESSION["signed"]['signature_mode'];
	if (!$GLOBALS['configurations']['htaccess'])
		$GLOBALS['url'] = _URL_ROOT . '/=generator=/?op=finished&serial='.$_SESSION["signed"]['package']['serial-number'];
	else 
		$GLOBALS['url'] = _URL_ROOT . '/=generator=/finished/'.$_SESSION["signed"]['package']['serial-number'].$GLOBALS['configurations']['htaccess_extension'];
	session_destroy();
	session_start();
	$_SESSION["signed"]['signature_mode'] = $mode;
	$_SESSION["signed"]['action'] = 'help-entity-finished';
	$_SESSION["signed"]['stepstogo'] = 'passthru';
	$GLOBALS['pause'] = 9;
?>
<p style="font-size: 2.345em; font-weight:bold; text-align: center; margin-bottom: 19px;"><?php echo _CONTENT_DEPLOYED_ENTITY_EMAIL_P1; ?></p>
<p style="font-size: 1.345em; font-weight:bold; text-align: center;"><?php echo $msg = sprintf(_CONTENT_DEPLOYED_ENTITY_EMAIL_P2, constant("_URL_IMAGES"), $GLOBALS['url']); ?></p>
<?php redirect_header($GLOBALS['url'], $GLOBALS['pause'], $msg); ?>
