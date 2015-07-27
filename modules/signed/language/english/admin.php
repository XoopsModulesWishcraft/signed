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

	// Table headers
	define('_SIGNED_AM_STATE', 'State');
	define('_SIGNED_AM_TYPE', 'Type');
	define('_SIGNED_AM_SERIAL', 'Serial number');
	define('_SIGNED_AM_WHOM', 'Owner');
	define('_SIGNED_AM_KILOBYTES', 'Size (kbs)');
	define('_SIGNED_AM_SAVED', 'When saved');
	define('_SIGNED_AM_ISSUED', 'When issued');
	define('_SIGNED_AM_EXPIRES', 'When expires');
	define('_SIGNED_AM_EXPIRING', 'When expired');
	define('_SIGNED_AM_EXPIRED_ZERO', 'Still hasn\'t');
	define('_SIGNED_AM_EXPIRES_ZERO', 'Never expires');
	define('_SIGNED_AM_USED_ZERO', 'No signing yet!');
	define('_SIGNED_AM_ISSUED_ZERO', 'Tasks remaining!');
	define('_SIGNED_AM_IDENTITY', 'Event ID');
	define('_SIGNED_AM_EVENT_TYPE', 'Event Type');
	define('_SIGNED_AM_BEGAN', 'Event began');
	define('_SIGNED_AM_RANFORMS', 'Event ran (ms)');
	define('_SIGNED_AM_USER', 'Event User');
	define('_SIGNED_AM_USER_NONE', 'Anonymous');
	define('_SIGNED_AM_SIBBLINGS', 'Events in Group');
	define('_SIGNED_AM_COMMENT', 'Event comment');
	define('_SIGNED_AM_SYSTEM', 'System Type');
	define('_SIGNED_AM_USED', 'Used Signing');
	
	// Dashboard
	define('_SIGNED_AM_DASHBOARD', 'Signature(s) Binding Totals');
	define('_SIGNED_AM_PROGRESS', 'Signatures to go active: %s');
	define('_SIGNED_AM_ACTIVE', 'Signatures are active: %s');
	define('_SIGNED_AM_INACTIVE', 'Expired Signatures: %s');
	define('_SIGNED_AM_EXPIRE_NEXT_WEEK', 'Expiring next week: %s');
	define('_SIGNED_AM_EXPIRE_NEXT_FORTNIGHT', 'Expiring next 14 days: %s');
	define('_SIGNED_AM_EXPIRED', 'Expired in total: %s');
	define('_SIGNED_AM_ISSUED_LAST_WEEK', 'Issued last (7 days): %s');
	define('_SIGNED_AM_ISSUED_LAST_FORTNIGHT', 'Issued last (14 days): %s');
	define('_SIGNED_AM_CREATED_LAST_WEEK', 'Created last (7 days): %s');
	define('_SIGNED_AM_CREATED_LAST_FORTNIGHT', 'Created last (14 days): %s');
	define('_SIGNED_AM_ACCESSED_LAST_WEEK', 'Used last (7 days): %s');
	define('_SIGNED_AM_ACCESSED_LAST_FORTNIGHT', 'Used last (14 days): %s');
	define('_SIGNED_AM_TOTAL', 'Total Signatures: %s');
	
	//Footer
	define("_SIGNED_AM_ADMIN_FOOTER", '<div style="text-align: center; font-size: 145%; margin-top: 9px; padding-top: 13px; text-shadow: 2px 1px 1px rgb(193, 104, 233); border-top: 3px dashed #000;">This module is maintained by the <a target="_blank" class="tooltip" rel="external" href="http://chrono.labs.coop/" title="Visit Chronolabs Landing Page">Chronolabs Cooperative</a> inclusive with the <a target="_blank" class="tooltip" rel="external" href="http://xoops.org/" title="Visit XOOPS Community">XOOPS Community</a><br/><a href="http://www.xoops.org" rel="external"><img style="margin-top: 23px;"src="http://xoops.org/images/logo.png" alt="XOOPS" title="XOOPS"></a><br/><a href="http://labs.coop" rel="external"><img style="margin-top: 19px;"src="http://web.labs.coop/image/logo.png" alt="Chronolabs" title="Chronolabs cooperative"></a></div>');
	
	// Salty Generator 2.1.8
	define('_SIGNED_AM_FORM_SALTY_ONE_TITLE', 'Populate your Blowfish Salt Information<br/>\n(careful of same pin if exhumation of previous salt!)');
	define('_SIGNED_AM_FORM_EMAIL', 'Blowfish Salt Email Address');
	define('_SIGNED_AM_FORM_NAME', 'Blowfish Salt Naming');
	define('_SIGNED_AM_FORM_URL', 'Blowfish Salt Site Root URI');
	define('_SIGNED_AM_FORM_PIN', 'Your Blowfish Seal Pin Number');
	define('_SIGNED_AM_FORM_SALT', 'Your Blowfish Salt');
	define('_SIGNED_AM_FORM_SALPHA_H1', 'Blowfish Encryption Salter Wizard');
	define('_SIGNED_AM_FORM_SALPHA_H2', 'Recovery of a Blowfish Salt with this Wizard');
	define('_SIGNED_AM_FORM_SALPHA_P1', 'This is the <strong>Blowfish Encryption Salter Wizard</strong>; which allows you to search for existing salt\'s if you are recovering a system or allows you to assigned and save a new system salt for <em>Signed 2</em>!');
	define('_SIGNED_AM_FORM_SALPHA_P2', 'This wizard will allow you to recovery of a Blowfish Salt as long as you remember your pin, without your pin which we do not store only use as an encryption key; there is no way without an accurate pin to recover an existing salt! * CAUTION!!');
	define('_SIGNED_AM_FORM_SSEARCH_H1', 'Searching for Existing Salts!');
	define('_SIGNED_AM_FORM_SSEARCH_P1', 'This will search for a moment then go too the required next steps!');
	define('_SIGNED_AM_FORM_SALTY_NONEFOUND', 'No recovery salts found; moving you to submission and lodgement of a salt to complete wizard!');
	define('_SIGNED_AM_FORM_SALTY_SALTSFOUND', 'There is potentially a blowfish salt to be recovered that has been found; moving you to salt recovery wizard!');
	define('_SIGNED_AM_FORM_SALTY_TRANSFIXED', 'Blowfish Encryption Salt Transfixed on API Recovery Sites and written into code libraries!');
	define('_SIGNED_AM_FORM_SRECOVERY_H1', 'Recover your existing Blowfish Encryption Salt!');
	define('_SIGNED_AM_FORM_SRECOVERY_P1', 'If you have existing signatures on your books or website; then you will have to most likely if your using any systems of the cryptologist libraries included with signed; you will have to recover your existing <strong>Blowfish Encryption Salt!</strong><br/>If you do not then you can simple click on this link: <a href="'. XOOPS_URL . '/modules/signed/admin/salty.php?op=lodge">Lodge a new Encryption Salt</a> and you will start from fresh with the cryptographic engines!');
	define('_SIGNED_AM_FORM_SRECOVERY_P2', 'Below are the salt keys you have a choice from; we do not memories the pin but use it as a cryptographic algorithm; you will have upto five attempts per key to recover one of them; put a pin in select the radio option then press submit to attempt to decipher they blowfish encryption salts from the APIs!');
	define('_SIGNED_AM_FORM_SALTY_RECOVERY_FAILED', 'Recovery Attempt for that Salt Key Failed!');
	define('_SIGNED_AM_FORM_SALTY_START_BEGINNING', 'Recovery Attempt all finished there are no more Salt Key; need too start from the beginning!');
?>