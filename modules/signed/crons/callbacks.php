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
 * @subpackage		module
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */

/**
 * CronJob/Scheduled Task is Run Once to Every Ten/Twenty Minutes!
 */
define('_SIGNED_CRON_EXECUTING', microtime(true));
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'common.php';

if (!$callbacks = signedCache::read('callback-calls'))
	$callbacks = array();
if (!empty($callbacks)) {
	$keys = array_keys($callbacks);
	$callback = $callbacks[$keys[count($keys)-1]];
	unset($callbacks[$keys[count($keys)-1]]);
	signedCache::write('callback-calls', $callbacks, 3600*24*7*4*24);
	
	if (isset($callback['destination']['fields']['signature-package']) && isset($callbacks['package']))
		$data[$callback['destination']['fields']['signature-package']] = $callbacks['package'];
	if (isset($callback['destination']['fields']['doc-identity']) && isset($callbacks['docid']))
		$data[$callback['destination']['fields']['doc-identity']] = $callbacks['docid'];
	if (isset($callback['destination']['fields']['signature-expiry']) && isset($callbacks['expired']))
		$data[$callback['destination']['fields']['signature-expiry']] = $callbacks['expired'];
	if (isset($callback['destination']['fields']['signature-updated']) && isset($callbacks['updated']))
		$data[$callback['destination']['fields']['signature-updated']] = $callbacks['updated'];
	if (isset($callback['destination']['fields']['request-rejected']) && isset($callbacks['rejected']))
		$data[$callback['destination']['fields']['request-rejected']] = $callbacks['rejected'];
	
	if (!$ch = curl_init($url = $callback['destination']['url'])) {
		trigger_error('Could not intialise CURL file: '.$url);
		return false;
	}
	
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 190);
	curl_setopt($ch, CURLOPT_TIMEOUT, 190);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$data = curl_exec($ch);
	curl_close($ch);
}	
?>