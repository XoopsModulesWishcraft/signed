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

function xoops_module_update_signed(&$module, $oldversion = null)
{
	
	if ($oldversion<200)
		$GLOBALS['xoopsDB']->queryF("CREATE TABLE `" . $GLOBALS['xoopsDB']->prefix('signed_keiyes') . "` (
									  `keiyeid`      mediumint(16) unsigned  NOT NULL auto_increment,
									  `typal`   	enum('serial', 'xml', 'json', 'raw') NOT NULL default 'raw',
									  `path`      	varchar(200)            NOT NULL default '',
									  `filename`   	varchar(200)            NOT NULL default '',
									  `seal-md5`    varchar(32)             NOT NULL default '',
									  `open-md5`    varchar(32)             NOT NULL default '',
									  `algorithm`   varchar(48)             NOT NULL default '',
									  `cipher`     	varchar(48)             NOT NULL default '',
									  `key`     	tinytext,
									  `last-algorithm`   varchar(48)             NOT NULL default '',
									  `last-cipher`     	varchar(48)             NOT NULL default '',
									  `last-key`     	tinytext,
									  `bytes`   	int(24) unsigned     	NOT NULL default '0',
									  `created`   	int(13) unsigned     	NOT NULL default '0',
									  `accessed`   	int(13) unsigned     	NOT NULL default '0',
									  PRIMARY KEY  (`keiyeid`),
									  KEY `indexer` (`path`(14), `filename`(14), `seal-md5`(12))
									) ENGINE=INNODB;");

	return true;
}