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
 * @subpackage		sms
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */

require_once('sip.class.php');

class signedSMSHandlerSip extends SignedSMSController
{

	function __construct($fromNumber = '')
	{
		parent::__construct($fromNumber);
	}
	
	function Send()
	{
		foreach(parent::getToNumbers() as $key=> $number) {
			try
			{
				$api = new signedSIP($_SERVER["SERVER_ADDR"]); // IP we will bind to
				$api->setUsername($_SESSION["signed"]['sip_user']); // authentication username
				$api->setPassword($_SESSION["signed"]['sip_pass']); // authentication password
				$api->setMethod('MESSAGE');
				$api->setTo('sip:+'.$number);
				$api->setBody(parent::getBody());
				$api->setFrom('sip:'.$_SESSION["signed"]['sip_user'].'@'.$_SESSION["signed"]['sip_server']);
				$api->setUri('sip:'.$_SESSION["signed"]['sip_user'].'@'.$_SESSION["signed"]['sip_server']);
				$res = $api->send();			
			} catch (Exception $e) {
			}
		}
		return $result;
	}
}
