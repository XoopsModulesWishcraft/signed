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
?><?php $GLOBALS['pagetitle'] = _CONTENT_FIELDS_PERSONAL_FORM_PT; ?>
<?php
	$formHandler = signedPrompts::getInstance()->getFormHandler($form = str_replace('.php', '', basename(__FILE__)));
?>
<p style="font-size: 1.35em;"><?php echo _CONTENT_FIELDS_PERSONAL_FORM_P1; ?></p>
<h1><?php echo _CONTENT_FIELDS_PERSONAL_FORM_H1A; ?></h1>
<p style="font-size: 1.15em;">
	<center>
	<?php 
		echo $formHandler->getForm('personal', $form, 'personal-'.$form, _FORM_PERSONAL_TITLE, _URL_ROOT . '/=request=/'. (!$_SESSION["signed"]['configurations']['htaccess']?'':'index' . $_SESSION["signed"]['configurations']['htaccess_extension']), _FORM_PERSONAL_SUMMARY);
	?>
	</center>
</p>