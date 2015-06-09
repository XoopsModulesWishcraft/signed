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
if ($_SESSION["signed"]['configurations']['htaccess'] && strpos($_SERVER["REQUEST_URI"], 'modules/'))
{
	header('Location: ' . _URL_ROOT . '/index' . $_SESSION["signed"]['configurations']['htaccess_extension']);
	exit(0);
}
signedCanvas::getInstance()->addScript('', "$(function(){
// bind change event to select
  $('#languages').bind('change', function () {
      var url = $(this).val(); // get selected value
      if (url) { // require a URL
          window.location = url; // redirect
      }
      return false;
   });
});", 'languages');
?><p style="font-size: 1.65em;"><?php echo _CONTENT_COMMON_START_P1; ?></p>
<center>
<?php if (count(signedProcesses::getInstance()->getLanguages())>1) { ?>
<font style="font-size: 1.45em;"><?php echo _CONTENT_COMMON_START_P2; ?><select name="languages" id="languages"><?php foreach(signed_getLanguages() as $key => $language) { ?><option value="<?php echo _URL_ROOT. '/?language=' .$key; ?>"<?php if (constant("_SIGNED_CONFIG_LANGUAGE") == $key) {?> selected="selected"<?php }?>><?php echo $language['title']; ?></option><?php } ?></select></font><br/><br/>
<?php
}
 foreach(signedProcesses::getInstance()->getSignatures() as $modes => $values) {
	foreach($values as $mode => $name) { 
?>	<div style="height: 28px; width: 100%">&nbsp;</div> 
	<form name="<?php echo $mode; ?>" method="post" action="<?php echo _URL_ROOT; ?>/=generator=/<?php if ($_SESSION["signed"]['configurations']['htaccess']) { echo 'index' . $_SESSION["signed"]['configurations']['htaccess_extension']; } ?>">
		<input type="hidden" name="signature_mode" value="<?php echo $mode; ?>" />
		<input type="submit" name="submit" value="<?php echo sprintf(_CONTENT_COMMON_START_IP1, trim($name)); ?>" style="font-size: 1.4321em; font-weight: bold" class="button" id="button">
	</form>
	
<?php } 
}?>
</center>