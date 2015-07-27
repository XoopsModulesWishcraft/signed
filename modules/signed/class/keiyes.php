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


class SignedKeiyes extends XoopsObject
{
    /**
     *
     */
    function __construct()
    {
        $this->initVar('keiyeid', XOBJ_DTYPE_INT, null, true);
        $this->initVar('typal', XOBJ_DTYPE_ENUM, 'raw', false, false, false, array('serial', 'xml', 'json', 'raw'));
        $this->initVar('path', XOBJ_DTYPE_TXTBOX);
        $this->initVar('filename', XOBJ_DTYPE_TXTBOX);
        $this->initVar('seal-md5', XOBJ_DTYPE_TXTBOX);
        $this->initVar('open-md5', XOBJ_DTYPE_TXTBOX);
        $this->initVar('algorithm', XOBJ_DTYPE_TXTBOX);
        $this->initVar('cipher', XOBJ_DTYPE_TXTBOX);
        $this->initVar('key', XOBJ_DTYPE_OTHER);
        $this->initVar('last-algorithm', XOBJ_DTYPE_TXTBOX);
        $this->initVar('last-cipher', XOBJ_DTYPE_TXTBOX);
        $this->initVar('last-key', XOBJ_DTYPE_OTHER);
        $this->initVar('bytes', XOBJ_DTYPE_INT);
        $this->initVar('created', XOBJ_DTYPE_INT);
        $this->initVar('accessed', XOBJ_DTYPE_INT);
    }

}

/**
 * 
 * @author sire
 *
 */
class SignedKeiyesHandler extends XoopsPersistableObjectHandler
{
    /**
     * @param null|object $db
     */
    function __construct(&$db)
    {
        parent::__construct($db, "signed_keiyes", "SignedKeiyes", "keiyeid", 'filename');
    }
    
    function retieveKeiye($file, $path)
    {
    	$criteria = new CriteriaCompo(new Criteria('filename', $file, 'LIKE'));
    	$criteria->add(new Criteria('path', $path, 'LIKE'));
    	$objects = $this->getObjects($criteria, false);
    	if (isset($objects[0]))
    	{
    		return $objects[0]->getValues();
    	}
    	return array();
    }
    
    function lodgeKey($file, $path, $algoritm, $cipher, $key, $sealmd5, $openmd5, $bytes)
    {
    	$criteria = new CriteriaCompo(new Criteria('filename', $file, 'LIKE'));
    	$criteria->add(new Criteria('path', $path, 'LIKE'));
    	$objects = $this->getObjects($criteria, false);
    	if (isset($objects[0]))
    	{
    		$objects[0]->setVar('last-algorithm', $objects[0]->getVar('algorithm'));
    		$objects[0]->setVar('last-cipher', $objects[0]->getVar('cipher'));
    		$objects[0]->setVar('last-key', $objects[0]->getVar('key'));
    		$objects[0]->setVar('algorithm', $algorithm);
    		$objects[0]->setVar('cipher', $cipher);
    		$objects[0]->setVar('key', $key);
    		$objects[0]->setVar('seal-md5', $sealmd5);
    		$objects[0]->setVar('open-md5', $openmd5);
    		$objects[0]->setVar('bytes', $bytes);
    		return $this->insert($objects[0], true);
    	} else {
    		$object = $this->create(true);
    		$object->setVar('filename', $file);
    		$object->setVar('path', $path);
    		$object->setVar('algorithm', $algorithm);
    		$object->setVar('cipher', $cipher);
    		$object->setVar('key', $key);
    		$object->setVar('seal-md5', $sealmd5);
    		$object->setVar('open-md5', $openmd5);
    		$object->setVar('bytes', $bytes);
    		return $this->insert($object, true);
    	}
    }
}
