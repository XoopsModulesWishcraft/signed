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
 * @subpackage		mailer
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */

defined('_PATH_ROOT') or die('Restricted access');

/**
 * Localize the mail functions
 *
 * The English localization is solely for demonstration
 */
// Do not change the class name
class signedMailerLocal extends signedMailer
{
    /**
     * Constructer
     *
     * @return signedMailerLocal
     */
    function signedMailerLocal()
    {
        $this->signedMailer(constant('_SIGNED_EMAIL'), constant('_SIGNED_TITLE'));
        // It is supposed no need to change the charset
        $this->charSet = strtolower(_CHARSET);
        // You MUST specify the language code value so that the file exists: signed_ROOT_PAT/class/mail/phpmailer/language/lang-["your-language-code"].php
        $this->multimailer->SetLanguage("en");
    }
    
    // Multibyte languages are encouraged to make their proper method for encoding FromName
    function encodeFromName($text)
    {
        // Activate the following line if needed
        // $text = "=?{$this->charSet}?B?".base64_encode($text)."?=";
        return $text;
    }
    
    // Multibyte languages are encouraged to make their proper method for encoding Subject
    function encodeSubject($text)
    {
        // Activate the following line if needed
        // $text = "=?{$this->charSet}?B?".base64_encode($text)."?=";
        return $text;
    }
}