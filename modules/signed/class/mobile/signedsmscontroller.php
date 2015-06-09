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


class signedSMSController
{
	// Plugins Dir
	var $PluginDir = 'plugin/';
	
	// From number
	var $fromNumber = '';
	
	// Mobiles to Send SMS too
	var $toNumbers = array();
	
	// Body of SMS
	var $body = '';
	
	/**
	 * 
	 * @param string $fromNumber
	 */
	function __construct($fromNumber = '')
	{
		$this->fromNumber = $fromNumber;		
	}
	
	/**
	 * 
	 * @param unknown $number
	 */
	public function AddNumber($number)
	{
		if (!in_array($number, $this->toNumbers)) {
			$this->toNumbers[$number] = $number;
		}	
	}
	
	/**
	 * 
	 * @return multitype:
	 */
	public function getToNumbers() {
		return $this->toNumbers;
	}

	/**
	 * 
	 * @return string
	 */
	public function getFromNumber() {
		return $this->fromNumber;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getBody() {
		return $this->body;
	}
}