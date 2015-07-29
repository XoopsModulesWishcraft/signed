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
 * @subpackage		module
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */

	require_once(dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'mainfile.php');
	
	//Signee Details
	define('_SIGNED_TITLE', $_SESSION["signed"]['configurations']['title']);
	define('_SIGNED_EMAIL', $_SESSION["signed"]['configurations']['email']);
	
	// SSL Enforcement Constant
	define('_SIGNED_USE_SSL', $_SESSION["signed"]['configurations']['use_ssl']);

	// Verification Settings
	define('_SIGNED_VERIFY_EMAIL', $_SESSION["signed"]['configurations']['verify_email']);
	define('_SIGNED_VERIFY_MOBILE', $_SESSION["signed"]['configurations']['verify_mobile']);

	// Settings for EMAIL
	define('_SIGNED_EMAIL_FROMADDR', $_SESSION["signed"]['configurations']['email_fromaddr']);
	define('_SIGNED_EMAIL_FROMNAME', $_SESSION["signed"]['configurations']['email_fromname']);
	define('_SIGNED_EMAIL_PRIORITY', $_SESSION["signed"]['configurations']['email_priority']); //= low, normal, high
	define('_SIGNED_EMAIL_METHOD', $_SESSION["signed"]['configurations']['email_method']); //= mail, smtp,  sendmail
	define('_SIGNED_EMAIL_SMTP_HOSTNAME', $_SESSION["signed"]['configurations']['email_smtp_host']); //= SMTP Server for smtp method
	define('_SIGNED_EMAIL_SMTP_USERNAME', $_SESSION["signed"]['configurations']['email_smtp_user']); //= SMTP Username for smtp method
	define('_SIGNED_EMAIL_SMTP_PASSWORD', $_SESSION["signed"]['configurations']['email_smtp_pass']); //= SMTP Password for smtp method
	define('_SIGNED_EMAIL_SENDMAIL', $_SESSION["signed"]['configurations']['email_sendmail']); //= Sendmail path
	define('_SIGNED_EMAIL_QUEUED', $_SESSION["signed"]['configurations']['email_queued']);
	
	// Settings for SMS
	define('_SIGNED_SMS_METHOD', $_SESSION["signed"]['configurations']['sms_method']);
	define('_SIGNED_SMS_FROMNUMBER', $_SESSION["signed"]['configurations']['sms_fromnumber']);
	
	// Settings for SMS (Create at cardboardfish.com)
	define('_SIGNED_CARDBOARDFISH_API_URL', $_SESSION["signed"]['configurations']['cardboardfish_uri']);
	define('_SIGNED_CARDBOARDFISH_API_USERNAME', $_SESSION["signed"]['configurations']['cardboardfish_user']);
	define('_SIGNED_CARDBOARDFISH_API_PASSWORD', $_SESSION["signed"]['configurations']['cardboardfish_pass']);	

?>
