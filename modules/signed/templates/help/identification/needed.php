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

?><?php $GLOBALS['pagetitle'] = _CONTENT_HELP_IDENTIFICATION_NEEDED_PT; ?>
<?php 
	signedCanvas::getInstance()->addScript(_URL_JS . '/json.validation.js', array( 'type' => 'text/javascript' ), '', 'json.validation.js');
	signedCanvas::getInstance()->addScript( '', array( 'type' => 'text/javascript' ), $srtjs = 'function ValidateIdentificationForm(idsform) {
	var params = new Array();
	$.getJSON("'.XOOPS_URL.'/modules/signed/dojsonids.php?" + $(\'#\'+idsform).serialize(), params, refreshform);
}', 'ValidateIdentificationForm' , sha1($srtjs));
?>
<p style="font-size: 1.35em;"><?php echo _CONTENT_HELP_IDENTIFICATION_NEEDED_P1; ?></p>
<p style="font-size: 1.59999em;">
	<center>
		<?php echo _CONTENT_HELP_PERSONAL_INTRO_P5; ?>
		<br/>
		<img src="<?php echo _URL_IMAGES; ?>/watermark.gif"/>
	</center>
</p>
<p style="font-size: 1.15em;"><?php echo _CONTENT_HELP_IDENTIFICATION_NEEDED_P2;  
	$scapes=array();
	foreach(signedArrays::getInstance()->returnKeyed('upload', 'getDimensionsArray') as $scape => $values) { 
		$scapekeys = array_keys($values); 
		foreach($values as $key => $value) {
			$scapes[] = ucwords($scape) .':&nbsp;' . $value['display']; 
		} 
	} echo implode(',&nbsp;', $scapes); ?></strong></p>
<h1><?php echo _CONTENT_HELP_IDENTIFICATION_NEEDED_H1A; ?></h1>
<form name="identification-ready" id="identification-ready" method="POST">
<?php foreach(signedArrays::getInstance()->returnKeyed(_SIGNATURE_MODE, 'getIdentificationsArray') as $key => $values) { ?>
	<div>
		<input type='checkbox' name='identification[<?php echo $values['fieldname'];?>]' <?php if (isset($_REQUEST['identification'][$values['fieldname']])) { echo 'selected="selected" '; } ?>id='identification-<?php echo $values['fieldname'];?>' title='<?php echo $values['title'];?>' value='<?php echo $values['fieldname'];?>' onclick="javascript:ValidateIdentificationForm('identification-ready')" />&nbsp;
	<?php echo sprintf(_CONTENT_HELP_IDENTIFICATION_NEEDED_DIV1, $values['title'], ucwords($values['points'])); ?>
	</div>
<?php 
}?>
<div style="font-size:1.723em; font-weight:600; margin-top: 19px; margin-bottom: 13px;"><?php echo _CONTENT_HELP_IDENTIFICATION_NEEDED_DIV2; ?></div>	
<div style="height: 45px;">
	<div>
		<div style="float: left; width: 25%; clear: none;">
			<input type="hidden" name="signature_mode" value="<?php echo _SIGNATURE_MODE; ?>">
			<input type="hidden" name="passkey" value="<?php echo signedCiphers::getInstance()->getHash(_URL_ROOT.date('Ymdh').session_id()); ?>">
			<input type="hidden" name="prompt" value="<?php echo $_SESSION["signed"]['action']; ?>">
			<input type="hidden" name="step" value="<?php echo $_SESSION["signed"]['step']; ?>">
			<input type="submit" name="submit-next" id="submit-next" value="<?php echo _CONTENT_BUTTON_NEXT; ?>" disabled="disabled">
			
		</div>
		</form>
	</div>
</div>
