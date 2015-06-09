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

include_once (dirname(__FILE__).'/mobile/signedsmsmobile.php');

/**
 * Class for sending mail.
 *
 * Changed to use the facilities of  {@link signedMultiMailer}
 *
 * @package class
 * @subpackage mail
 * @author Kazumi Ono <onokazu@signed.org>
 */
class signedMobile
{
    /**
     * reference to a {@link signedMultiMailer}
     *
     * @var signedMultiMailer
     * @access private
     * @since 21.02.2003 14:14:13
     */
	// From Mobile SMS Object
	var $mobilesms;
	// From Mobile Number
    var $fromNumber;
    // private
    var $toNumbers;
    // Body of SMS
    var $body;
    // error messages
    // private
    var $errors;
    // messages upon success
    // private
    var $success;
    // private
    var $template;
    // private
    var $templatedir;
    // protected
    var $charSet = 'iso-8859-1';
    // protected
    var $encoding = '8bit';
    
    /**
     * Constructor
     *
     * @return signedMailer
     */
    function __construct($fromNumber, $method = 'cardboardfish')
    {
        $this->mobilesms = signedSMSMobile::getInstance($fromNumber, $method);
        $this->reset();
        $this->fromNumber = $fromNumber;
        
    }

    // public
    // reset all properties to default
    function reset()
    {
        $this->mobilesms->toNumbers = $this->toMobiles = array();
        $this->body = "";
        $this->errors = array();
        $this->success = array();
        $this->template = "";
        $this->templatedir = "";
        // Change below to \r\n if you have problem sending mail
        $this->LE = "\n";
    }

    // public
    function setTemplateDir($value)
    {
    	$this->templatedir = $value;
    }

    // public
    function getBodyFromTemplate($template = '', $data = array())
    {
    	$data['SITE_URL'] = _URL_ROOT;
    	$data['SITE_EMAIL'] = _SITE_EMAIL;
    	$data['SITE_NAME'] = _SITE_NAME;
    	$data['SITE_COMPANY'] = _SITE_COMPANY;
    	$data['SITE_FROM_EMAIL'] = _SITE_FROM_EMAIL;
    	$data['SITE_FROM_NAME'] = _SITE_FROM_NAME;
    	 
   		if (file_exists($this->templatedir . _DS_ .  $template . '.txt')) {
   			$source = file_get_contents($this->templatedir . _DS_ . $template . '.txt');
   		} else
   			return false;
    	if (strlen($source)>0 && !empty($data) && is_array($data)) {
    		foreach($data as $key => $value) {
    			$source = str_replace(array("{".strtoupper($key)."}", "{".strtolower($key)."}", "%".strtoupper($key)."%", "%".strtolower($key)."%"), $value, $source);
    		}    		
    	}
    	return $source;
    }
 
    /**
     * Send email
     *
     * Uses the new signedMultiMailer
     *
     * @param string $
     * @param string $
     * @param string $
     * @return boolean FALSE on error.
     */
    
    function sendSMS($to = array(), $body = '')
    {
        if (isset($to) && !is_array($to))
        	$this->mobilesms->AddNumber($to);
        elseif (!empty($to) && is_array($to)) {
        	foreach ($to as $id => $number ) {
        		$this->mobilesms->AddNumber($number);
        	}
        }
        $this->mobilesms->body = $body;
        if (! $this->mobilesms->Send()) {
            $this->errors[] = $this->mobilesms->ErrorInfo;
            return false;
        }
        return true;
    }
    
    // public
    function getErrors($ashtml = true)
    {
        if (! $ashtml) {
            return $this->errors;
        } else {
            if (! empty($this->errors)) {
                $ret = "<h4>" . _ERRORS . "</h4>";
                foreach($this->errors as $error) {
                    $ret .= $error . "<br />";
                }
            } else {
                $ret = "";
            }
            return $ret;
        }
    }
          
}

?>