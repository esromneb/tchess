<?php
	// tchess.com/admin/netstat.php
	// 1.0.0

	// returns number of connections for $ip
	// if $ip is REMOTE_ADDR, returns >= 1
	function currConnections($ip) {
		$ip || $ip = $_SERVER['REMOTE_ADDR'];
		$server = $_SERVER['SERVER_ADDR'] . ":" . $_SERVER['SERVER_PORT'];
		return `netstat -nA inet | grep -c "$server.*$ip.*ESTABLISHED"` . "</pre>";
	}

	$ip = $_SERVER['REMOTE_ADDR'];
	print "$ip -> " . currConnections($ip);
?>

