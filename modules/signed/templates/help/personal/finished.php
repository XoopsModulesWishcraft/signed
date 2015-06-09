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
xoops_loadLanguage('content');
$GLOBALS['pagetitle'] = _CONTENT_HELP_ENTITY_FINISH_PT; ?>
<p style="font-size: 1.35em;"><?php echo _CONTENT_HELP_ENTITY_FINISH_P1; ?></p>
<?php 
	$serialnum = (isset($_GET['serial'])?$_GET['serial']:md5(NULL));
	if (signedStorage::getInstance()->file_exists(_PATH_REPO_VALIDATION, $serialnum)) {
		$verifier = signedStorage::getInstance()->load(_PATH_REPO_VALIDATION, $serialnum);
if (isset($verifier['verification']['emails']) && !empty($verifier['verification']['emails']) && constant("_SIGNED_VERIFY_EMAIL") == true) {
		if (count($verifier['verification']['emails'])> 0 ) {
?><h1><?php echo _CONTENT_HELP_ENTITY_FINISH_H1A; ?></h1>
<ol>
<?php 
			foreach($verifier['verification']['emails'] as $key => $email) {
if (!empty($email['to'])) { ?>	<li><?php echo sprintf(_CONTENT_HELP_ENTITY_FINISH_LIA, $email['to'], ($email['verified']==false?_CONTENT_HELP_ENTITY_STATE_1B:_CONTENT_HELP_ENTITY_STATE_1A)); ?></li>
<?php } } ?>
</ol>
<?php 
}
if (isset($verifier['verification']['mobiles']) && !empty($verifier['verification']['mobiles']) && constant("_SIGNED_VERIFY_MOBILE") == true) {
		if (count($verifier['verification']['mobiles'])> 0 ) {
?><h1><?php echo _CONTENT_HELP_ENTITY_FINISH_H1B; ?></h1>
<ol>
<?php 
			foreach($verifier['verification']['mobiles'] as $key => $mobile) {
if (!empty($mobile['number'])) {?>	<li><?php echo sprintf(_CONTENT_HELP_ENTITY_FINISH_LIB, $mobile['number']); ?></li>
<?php } } ?>
</ol>
<?php } }
	} } ?>
<?php signedPrompts::getInstance()->goReset(); ?>
