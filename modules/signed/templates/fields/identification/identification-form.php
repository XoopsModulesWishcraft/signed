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
	$formHandler = signedPrompts::getInstance()->getFormHandler($form = str_replace('.php', '', basename(__FILE__)));
	$identifications = signedArrays::getInstance()->returnKeyed(_SIGNATURE_MODE, 'getIdentificationsArray');
?>
<p style="font-size: 1.35em;"><?php echo sprintf(_CONTENT_FIELDS_IDENTIFICATION_FORM_P1, $identifications[$_SESSION["signed"]['step']]['title']); ?></p>
<h1><?php echo sprintf(_CONTENT_FIELDS_IDENTIFICATION_FORM_H1A, $identifications[$_SESSION["signed"]['step']]['title']); ?></h1>
<p style="font-size: 1.15em;">
	<center>
	<?php 
		echo $formHandler->getForm('identification', $form, $_SESSION["signed"]['step'].'-'.$form, sprintf(_FORM_IDENTIFICATION_TITLE, $identifications[$_SESSION["signed"]['step']]['title']), _URL_ROOT . '/=generator=/'. (!$_SESSION["signed"]['configurations']['htaccess']?'':'index' . $_SESSION["signed"]['configurations']['htaccess_extension']), _FORM_IDENTIFICATION_SUMMARY);
		$GLOBALS['pagetitle'] = sprintf(_CONTENT_FIELDS_IDENTIFICATION_FORM_PT, $identifications[$_SESSION["signed"]['step']]['title']);
	?>
	</center>
</p>