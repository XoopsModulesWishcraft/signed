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
 * @subpackage		administration
 * @description		Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 * @link			https://signed.labs.coop Digital Signature Generation & API Services (Psuedo-legal correct binding measure)
 */
		
	/**
	 * signed salty api source's
	 *
	 * @return  array
	 *
	 */
	function signed_getSaltyAPIs()
	{
		$ret = array();
		foreach(explode("\n", file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "salty-api-uri.diz")) as $key =>  $line)
		{
			$parts = explode("||", $line);
			$ret[$parts[0]] = $parts[1];
		}
		return $ret;
	}
	
	$op = (!isset($_REQUEST['op'])?'default':$_REQUEST["op"]);
	$email = (!isset($_REQUEST['email'])?$_SESSION['salty']['email']:$_REQUEST["email"]);
	$name = (!isset($_REQUEST['name'])?$_SESSION['salty']['name']:$_REQUEST["name"]);
	$url = (!isset($_REQUEST['url'])?$_SESSION['salty']['url']:$_REQUEST["url"]);
	$salt = (!isset($_REQUEST['salt'])?'':$_REQUEST["salt"]);
	$pin = (!isset($_REQUEST['pin'])?$_SESSION['salty']['pin']:$_REQUEST["pin"]);
	$api = (!isset($_REQUEST['api'])?'':$_REQUEST["api"]);
	
	if (empty($email))
		$email = $GLOBALS["xoopsConfig"]['admin_email'];
	if (empty($name))
		$name = $GLOBALS["xoopsConfig"]['site_name'];
	
	if (empty($email)||empty($name)||empty($url)||empty($pin)||strlen($pin)<4||!is_numeric($pin))
		$op = 'default';
	require_once 'admin_header.php';
	require_once dirname(__DIR__) . '/class/signedformloader.php';
	require_once dirname(__DIR__) . '/class/signedstorage.php';
	
	if (defined("SIGNED_BLOWFISH_SALT") && constant("SIGNED_BLOWFISH_SALT") != "%%%%%%%%%%%%%%%%%%%%%"){
		redirect_header(XOOPS_URL . '/modules/signed/admin/admin.php', 5, _NOPERM);
		exit(0);
	}
	
	xoops_cp_header();
	
	switch($op)
	{
		default:
		case 'default':
			$_SESSION['salty'] = array();
			$stepform = new signedForm(_SIGNED_AM_FORM_SALTY_ONE_TITLE, 'salpha', $_SERVER["REQUEST_URI"], 'post', true);
			$stepform->addElement(new XoopsFormText(_SIGNED_AM_FORM_EMAIL, 'email', 32, 255, (empty($email)?$GLOBALS['xoopsConfig']['admin_email']:$email)), true);
			$stepform->addElement(new XoopsFormText(_SIGNED_AM_FORM_NAME, 'name', 32, 255, (empty($name)?$GLOBALS['xoopsConfig']['site_name']:$name)), true);
			$stepform->addElement(new XoopsFormText(_SIGNED_AM_FORM_URL, 'url', 32, 255, (empty($url)?constant("XOOPS_URL"):$url)), true);
			$stepform->addElement(new XoopsFormText(_SIGNED_AM_FORM_PIN, 'pin', 12, 12, $pin), true);
			$stepform->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'), true);
			$stepform->addElement(new XoopsFormHidden('op', 'search'));
			$stepform->assign($GLOBALS['xoopsTpl']);
			$GLOBALS['xoopsTpl']->display($GLOBALS['xoops']->path('/modules/signed/templates/admin/signed_salty_details.html'));
			break;
		case 'search':
			$_SESSION['salty']['email'] = $email;
			$_SESSION['salty']['name'] = $name;
			$_SESSION['salty']['url'] = $url;
			$_SESSION['salty']['pin'] = $pin;
			$GLOBALS['xoopsTpl']->display($GLOBALS['xoops']->path('/modules/signed/templates/admin/signed_salty_search.html'));
			include_once dirname(__FILE__) . '/admin_footer.php';
			sleep(mt_rand(3,5));
			$found = false;
			foreach(signed_getSaltyAPIs() as $uri => $name)
			{
				$result = json_decode(signedStorage::getURL("$uri/v2/search.api", 25, 25, array("response"=>"json", "method"=> "email", "query" => $_SESSION['salty']['email'])), true);
				if ($result['code']==200)
				{
					$found = true;
					$_SESSION['salty']['api'][$uri]['email'] = $result['results'];
				}
				sleep(mt_rand(2,3));
				$result = json_decode(signedStorage::getURL("$uri/v2/search.api", 25, 25, array("response"=>"json", "method"=> "uri", "query" => $_SESSION['salty']['uri'])), true);
				if ($result['code']==200)
				{
					$found = true;
					$_SESSION['salty']['api'][$uri]['uri'] = $result['results'];
				}
				sleep(mt_rand(2,3));
			}
			if ($found == false)
			{
				redirect_header(XOOPS_URL . '/modules/signed/admin/salty.php?op=lodge&email='.$email.'&name='.$name.'&pin='.$pin.'&url='.$url.'', 5, _SIGNED_AM_FORM_SALTY_NONEFOUND);
				exit(0);
			}
			redirect_header(XOOPS_URL . '/modules/signed/admin/salty.php?op=recover', 5, _SIGNED_AM_FORM_SALTY_SALTSFOUND);
			exit(0);
			break;
		case "lodge":
			$cryptus_handler = xoops_getmodulehandler('cryptus', 'signed');
			$salt = $cryptus_handler->generateSalts(mt_rand(198, 3096), microtime(true));
			if ($cryptus_handler->writeBlowfishSalts(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'blowfish-salt.php', $salt ))
			{
				$uris = array_keys(signed_getSaltyAPIs());
				shuffle($uris);
				foreach($uris as $id => $uri)
				{
					$result = json_decode(signedStorage::getURL("$uri/v2/lodge.api", 45, 45, array("response"=>"json", "email"=> $email, "name"=> $name ,
							"pin"=> $pin, "uri"=> $url, "salt"=> $salt)), true);
					if ($result['code']==200)
					{
						unset($_SESSION['salty']);
						redirect_header(XOOPS_URL . '/modules/signed/admin/admin.php', 5, _SIGNED_AM_FORM_SALTY_TRANSFIXED);
					}
				}
			}
			redirect_header(XOOPS_URL . '/modules/signed/admin/admin.php', 5, _SIGNED_AM_FORM_SALTY_TRANSFIXED);
			exit(0);
			break;
		case "exhume":
			
			$keys = (isset($_REQUEST['keys'])?$_REQUEST['keys']:array());
			$pins = (isset($_REQUEST['pin'])?$_REQUEST['pin']:array());
			foreach($keys as $idx => $value)
			{
				$uri = $_SESSION['salty']['keystore'][$_REQUEST['api']][$idx]['uri'];
				$_SESSION['salty']['keystore'][$_REQUEST['api']][$idx]['attempts']--;
				$result = json_decode(signedStorage::getURL("$uri/v2/retrieve.api", 125, 125, array("response"=>"json", "email"=> $_SESSION['salty']['keystore'][$_REQUEST['api']][$idx]['salt']['email'], 
															"uri"=> $_SESSION['salty']['keystore'][$_REQUEST['api']][$idx]['salt']['protocol'] . $_SESSION['salty']['keystore'][$_REQUEST['api']][$idx]['salt']['domain'] . $_SESSION['salty']['keystore'][$_REQUEST['api']][$idx]['salt']['path'],
															"pin"=> $pins[$idx])), true);
				if ($result['code']==200)
				{
					$cryptus_handler = xoops_getmodulehandler('cryptus', 'signed');
					if ($cryptus_handler->writeBlowfishSalts(dirname(__DIR__) . 'include' . DIRECTORY_SEPARATOR . 'blowfish-salt.php', $result['salt'] ))
					{
						unset($_SESSION['salty']);
						continue;
					}
				} else {
					if ($_SESSION['salty']['keystore'][$_REQUEST['api']][$idx]['attempts']==0)
					{
						unset($_SESSION['salty']['keystore'][$_REQUEST['api']][$idx]);
						if (count($_SESSION['salty']['keystore'][$_REQUEST['api']])==0)
							unset($_SESSION['salty']['keystore'][$_REQUEST['api']]);
					}
					if (count($_SESSION['salty']['keystore']))
						redirect_header(XOOPS_URL . '/modules/signed/admin/salty.php?op=recover', 5, _SIGNED_AM_FORM_SALTY_RECOVERY_FAILED);
					else
						redirect_header(XOOPS_URL . '/modules/signed/admin/salty.php?op=default', 5, _SIGNED_AM_FORM_SALTY_START_BEGINNING);
					exit(0);
				}
			}
			redirect_header(XOOPS_URL . '/modules/signed/admin/admin.php', 5, _SIGNED_AM_FORM_SALTY_TRANSFIXED);
			break;
		case "recovery":
		case "recover":
			$saltyapi = signed_getSaltyAPIs();
			if (!isset($_SESSION['salty']['keystore']))
			{
				$_SESSION['salty']['keystore'] = array();
				foreach($_SESSION['salty']['api'] as $uri => $methods)
					foreach($methods as $method => $values)
						foreach($values as $key => $salty)
						{
							$_SESSION['salty']['keystore'][$saltyapi[$uri]][$key]['salt'] = $salty;
							$_SESSION['salty']['keystore'][$saltyapi[$uri]][$key]['uri'] = $uri;
							$_SESSION['salty']['keystore'][$saltyapi[$uri]][$key]['attempts'] = 5;
						}
			}
			$GLOBALS['xoopsTpl']->assign('saltys', $_SESSION['salty']['keystore']);
			$GLOBALS['xoopsTpl']->display($GLOBALS['xoops']->path('/modules/signed/templates/admin/signed_salty_recovery.html'));
			break;
	}
			
	include_once dirname(__FILE__) . '/admin_footer.php';

?>