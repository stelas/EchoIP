<?php
	function unmask_ipv4($addr) {
		$prefix = '00000000000000000000ffff';
		$prefix_bin = hex2bin($prefix);
		if (($addr_bin = inet_pton($addr)) === FALSE)
			return false;
		if (substr($addr_bin, 0, strlen($prefix_bin)) == $prefix_bin)
			$addr_bin = substr($addr_bin, strlen($prefix_bin));
		return inet_ntop($addr_bin);
	}

	ini_set('default_charset', 'iso-8859-1');
	header('Content-Type: text/plain');
	if ($ip = unmask_ipv4($_SERVER['REMOTE_ADDR'])) {
		$cmd = isset($_GET['cmd']) ? $_GET['cmd'] : '';
		switch ($cmd) {
			case 'long':
				if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
					printf('%u', ip2long($ip));
				else
					echo $ip;
				break;
			case 'host':
			case 'hostname':
				echo gethostbyaddr($ip);
				break;
			default:
				echo $ip;
		}
	}
	else {
		echo 'Invalid IP address';
	}
?>
