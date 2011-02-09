<?php
require("nbt.class.php");
$nbt = new nbt();

// change to point to your world's level.dat file
$nbt->loadFile("/minecraft/world/level.dat");

foreach($nbt->root[0]['value'][0]['value'] as $dat) {
	$t = $dat['value'];
	if ($dat['name'] === 'Time') {
		$time = $t;
	}

	if ($dat['name'] === 'LastPlayed') {
		$last = $t;
		$now = microtime(true);
	}
}
$time = $time + ($now*1000 - $last)/50;
printf ("[%d]\n", $time);
?>
