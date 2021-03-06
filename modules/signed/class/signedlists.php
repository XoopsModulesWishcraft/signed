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
 * @license			General Software Licence (http://labs.coop/briefs/legal/general-software-license/10,3.html)
 * @license			End User License (http://labs.coop/briefs/legal/end-user-license/11,3.html)
 * @license			Privacy and Mooching Policy (http://labs.coop/briefs/legal/privacy-and-mooching-policy/22,3.html)
 * @license			General Public Licence 3 (http://labs.coop/briefs/legal/general-public-licence/13,3.html)
 * @category		signed
 * @since			2.1.9
 * @version			2.2.0
 * @author			Simon Antony Roberts (Aus Passport: M8747409) <wishcraft@users.sourceforge.net>
 * @author          Simon Antony Roberts (Aus Passport: M8747409) <wishcraft@users.sourceforge.net>
 * @subpackage		class
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			Farming Digital Fingerprint Signatures: https://signed.ringwould.com.au
 * @link			Heavy Hash-info Digital Fingerprint Signature: http://signed.hempembassy.net
 * @link			XOOPS SVN: https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/signed/
 * @see				Release Article: http://cipher.labs.coop/portfolio/signed-identification-validations-and-signer-for-xoops/
 * @filesource
 *
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
				'0' => '--------',
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
        
        	$years_list = array(0 => '----');
        	for($i=date('Y');$i<=date('Y') + constant('_YEARS_NUMBEROF'); $i++)
        		$years_list[$i] = $i;
        
        	return $years_list;
        }
    }
}

?>
