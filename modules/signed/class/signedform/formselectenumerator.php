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
 * @subpackage		forms
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */

defined('_PATH_ROOT') or die('Restricted access');

/**
 * A select field with countries
 */
class signedFormSelectEnumerator extends xoopsFormSelect
{
    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name "name" attribute
     * @param mixed $value Pre-selected value (or array of them).
     *                                    Legal are all 2-letter Enumerator codes (in capitals).
     * @param int $size Number or rows. "1" makes a drop-down-list
     */
    function signedFormSelectEnumerator($caption, $name, $value = null, $enumeration = '', $size = 1)
    {
        $this->xoopsFormSelect($caption, $name, $value, $size);
        $enums = signedProcesses::getInstance()->getEnumeratorsArray();
        $this->addOptionArray($enums[$enumeration]);
    }
}

?>