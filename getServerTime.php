<?php
/*

This software is copyright by sunkid <sunkid@iminurnetz.com> and is distributed under a dual license:

 Non-Commercial Use:
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 
 Commercial Use:
    Please contact sunkid@iminurnetz.com

*/

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
