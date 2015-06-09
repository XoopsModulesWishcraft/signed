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
 * @subpackage		class
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */


if (!defined('_LISTS_INCLUDED')) {
    define('_LISTS_INCLUDED', 1);

    xoops_load('XoopsLists');
    
    /**
     * signedLists
     *
     * @author Simon Roberts <cipher@labs.coop>
     * @copyright copyright (c) labs.coop
     * @package module
     * @subpackage form
     * @access public
     */
    class signedLists extends XoopsLists
    {

	static function getMonthsList() {
		signed_loadLanguage('months');
		return array(
				'0' => '',
				'1' => _MONTH_ONE ,
				'2' => _MONTH_TWO ,
				'3' => _MONTH_THREE ,
				'4' => _MONTH_FOUR ,
				'5' => _MONTH_FIVE ,
				'6' => _MONTH_SIX ,
				'7' => _MONTH_SEVEN ,
				'8' => _MONTH_EIGHT ,
				'9' => _MONTH_NINE ,
				'10' => _MONTH_TEN ,
				'11' => _MONTH_ELEVEN ,
				'12' => _MONTH_TWELVE);
	}
		
        static function getYearsList()
        {
        	signed_loadLanguage('global');
        
        	$years_list = array(0 => '');
        	for($i=date('Y');$i<=date('Y') + constant('_YEARS_NUMBEROF'); $i++)
        		$years_list[$i] = $i;
        
        	return $years_list;
        }
    }
}

?>
