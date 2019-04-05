<?php
	ini_set('default_charset', 'iso-8859-1');
	header('Content-Type: text/plain');
	$ip = $_SERVER['REMOTE_ADDR'];
	if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
		$cmd = isset($_GET['cmd']) ? $_GET['cmd'] : '';
		if ($cmd === 'long') {
			printf('%u', ip2long($ip));
		}
		elseif ($cmd === 'hostname') {
			echo gethostbyaddr($ip);
		}
		else {
			echo $ip;
		}
	}
	else {
		echo $ip;
	}
?>
