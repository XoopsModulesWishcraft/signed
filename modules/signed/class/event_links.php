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


class SignedEvent_links extends XoopsObject
{
    /**
     *
     */
    function __construct()
    {
        $this->initVar('linkid', XOBJ_DTYPE_INT, null, true);
        $this->initVar('group', XOBJ_DTYPE_TXTBOX);
        $this->initVar('when', XOBJ_DTYPE_INT);
        $this->initVar('signid', XOBJ_DTYPE_INT);
        $this->initVar('eventid', XOBJ_DTYPE_INT);

    }

}

/**
 * 
 * @author sire
 *
 */
class SignedEvent_linksHandler extends XoopsPersistableObjectHandler
{
    /**
     * @param null|object $db
     */
    function __construct(&$db)
    {
    	if (!isset($GLOBALS['signedBoot']))
    		$GLOBALS['signedBoot'] = microtime(true);
        parent::__construct($db, "signed_event_links", "SignedEvent_links", "linkid", 'when');
    }

}
