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

defined('_PATH_ROOT') or die('Restricted access');


/**
 * Localized fonts 
 */
$GLOBALS['formtextdhtml_fonts'] = array(
    'Arial' , 
    'Courier' , 
    'Georgia' , 
    'Helvetica' , 
    'Impact' , 
    'Verdana' , 
    'Haettenschweiler');
/**
 * Localized font sizes: 'font size value' => 'font size name'
 */
$GLOBALS['formtextdhtml_sizes'] = array(
    'xx-small' => 'xx-Small' , 
    'x-small' => 'x-Small' , 
    'small' => 'Small' , 
    'medium' => 'Medium' , 
    'large' => 'Large' , 
    'x-large' => 'x-Large' , 
    'xx-large' => 'xx-Large');
define('_SIGNED_FORM_ALT_URL','URL');
define('_SIGNED_FORM_ALT_EMAIL','Email');
define('_SIGNED_FORM_ALT_IMG','Images');
define('_SIGNED_FORM_ALT_IMAGE','Inside images');
define('_SIGNED_FORM_ALT_SMILEY','Smiley');
define('_SIGNED_FORM_ALT_CODE','Source code');
define('_SIGNED_FORM_ALT_QUOTE','Quote');
define('_SIGNED_FORM_ALT_BOLD','Bold');
define('_SIGNED_FORM_ALT_ITALIC','Italic');
define('_SIGNED_FORM_ALT_UNDERLINE','Underline');
define('_SIGNED_FORM_ALT_LINETHROUGH','Linethrough');
define('_SIGNED_FORM_ALT_ENTERHEIGHT','Height:');
define('_SIGNED_FORM_ALT_ENTERWIDTH','Width:');
define('_SIGNED_FORM_ALT_LEFT','Left');
define('_SIGNED_FORM_ALT_RIGHT','Right');
define('_SIGNED_FORM_ALT_CENTER','Center');
define('_SIGNED_FORM_ALTFLASH','Flash');
define('_SIGNED_FORM_ALTMMS','MMS');
define('_SIGNED_FORM_ALTRTSP','Real Player');
define('_SIGNED_FORM_ALTIFRAME','IFRAME');
define('_SIGNED_FORM_ALTWIKI','WIKI link');
define('_SIGNED_FORM_ENTERIFRAMEURL','IFRAME URL:');
define('_SIGNED_FORM_ENTERMMSURL','RMMS URL:');
define('_SIGNED_FORM_ENTERWMPURL','WMP URL:');
define('_SIGNED_FORM_ENTERFLASHURL','FLASH URL:');
define('_SIGNED_FORM_ENTERYOUTUBEURL','Youtube URL:');
define('_SIGNED_FORM_ENTERRTSPURL','RTSP URL:');
define('_SIGNED_FORM_ENTERWIKITERM','The word to be linked to Wiki:');
define('_SIGNED_FORM_ALTMP3','MP3');
define('_SIGNED_FORM_ENTERMP3URL','MP3 URL');
define('_SIGNED_FORM_ALT_CHECKLENGTH','Check text length');
define('_SIGNED_FORM_ALT_LENGTH','Current content length: %s');
define('_SIGNED_FORM_ALT_LENGTH_MAX','Maximum length: ');
define('_SIGNED_FORM_PREVIEW_CONTENT','Click the <strong>' . _PREVIEW . '</strong> to see the content in action.');

define('_SIGNED_FORM_ALTYOUTUBE','Youtube');