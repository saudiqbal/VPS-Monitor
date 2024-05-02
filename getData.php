<?php
	$tmp = null;
	$dt = shell_exec('df -k | awk \'$1=="/dev/sda1"{print $2}\'') * 1000;
	$df = shell_exec('df -k | awk \'$1=="/dev/sda1"{print $4}\'') * 1000;

	$data = array(
		"memory" => array_map(
			function($value) {
				return (int)$value * 1000;
			},
			explode(" ", exec("free | grep 'Mem:' | awk {'print $2\" \"$3\" \"$4\" \"$6'}"))
		),
		"CPUDetail" => trim(exec("sed -n 's/^cpu\s//p' /proc/stat")),
		"CPU" => array(),
		"storage" => array(
			"total" => $dt,
			"free" => $df,
			"used" => $dt - $df
		),
		"network" => array_map('intval', explode(" ",exec("cat /proc/net/dev | grep 'eth0:' | awk {'print $2\" \"$3\" \"$10\" \"$11'}"))),
		"uptime" => (int)exec("cut -d. -f1 /proc/uptime"),
		"OS" => exec("cat /etc/*-release | grep 'PRETTY_NAME' | cut -d \\\" -f2")
	);

	exec("cat /proc/cpuinfo | grep -i 'model name\|cpu cores\|cpu mhz'", $tmp);

	foreach($tmp as $line)
	{
		list($key, $value) = explode(":", $line);
		$data["CPU"][] = array(trim($key), trim($value));
	}

	echo json_encode($data);
?>
