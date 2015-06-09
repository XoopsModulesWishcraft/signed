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


/**
 * load the base class
 */
if (!file_exists($file = dirname(__FILE__) . '/signedsmscontroller.php')) {
    trigger_error('Required File  ' . $file . ' was not found in file ' . __FILE__ . ' at line ' . __LINE__, E_USER_WARNING);
    return false;
}
include_once $file;

/**
 * Mailer Class.
 *
 * At the moment, this does nothing but send email through PHP "mail()" function,
 * but it has the ability to do much more.
 *
 * If you have problems sending mail with "mail()", you can edit the member variables
 * to suit your setting. Later this will be possible through the admin panel.
 *
 * @todo Make a page in the admin panel for setting mailer preferences.
 * @package class
 * @subpackage mail
 * @author Jochen Buennagel <job@buennagel.com>
 */
class signedSMSMobile extends signedSMSController
{
    /**
     * 'from' name
     *
     * @var string
     * @access private
     */
    var $FromNumber = '';

    // can be 'smtp', 'sendmail', or 'mail'
    /**
     * Method to be used when sending the mail.
     *
     * This can be:
     * <li>mail (standard PHP function 'mail()') (default)
     * <li>smtp    (send through any SMTP server, SMTPAuth is supported.
     * You must set {@link $Host}, for SMTPAuth also {@link $SMTPAuth},
     * {@link $Username}, and {@link $Password}.)
     * <li>sendmail (manually set the path to your sendmail program
     * to something different than 'mail()' uses in {@link $Sendmail})
     *
     * @var string
     * @access private
     */
    var $Messenger = 'cardboardfish';

    /**
     * Constructor
     *
     * @access public
     * @return void
     */
    function __construct($fromNumber, $method = 'cardboardfish')
    {
        $this->FromNumber = $fromNumber;
        $this->Messenger = $method;
        $this->PluginDir = dirname(__FILE__) . '/plugin/';
    }

    static function getInstance($fromNumber='', $method = '')
    {
    	if (!file_exists($file = dirname(__FILE__) . '/handlers/sms.'.strtolower($method).'.php')) {
    		trigger_error('Required File  ' . $file . ' was not found in file ' . __FILE__ . ' at line ' . __LINE__, E_USER_WARNING);
    		return false;
    	}
    	include_once $file;
    	
    	$classname = 'signedSMSHandler'.ucfirst(strtolower($method));
    	if (class_exists($classname)) {
    		return new $classname($fromNumber);
    	}
    	return false;
    }
}

?>