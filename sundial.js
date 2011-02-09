// how many times per second to run the rotate function below
var syncEvery = 1;

// time zone offset from UTC
var tzOffset = -8;

var d = new Date();
var serverClock = 0;

// milliseconds of wall time to be added for server "date"
// sunrise is at 22800, noon at 6000, sunset at 13200, and midnight at 18000
var tAdjust = (21600-tzOffset*3600)*1000;
	
// rotate the dial and refresh the date/time information
function rotate() {
	// are we ready yet?
	if (serverClock === 0) return;

	// refresh the server "date" and time
	d.setTime(serverClock*3600+tAdjust);
	$('#date').text(d.toDateString());
	$('#time').text(d.toTimeString());

	// rotate the dial
	var deg = (serverClock%24000)*-0.015-30;
	$('#dial').rotate(deg);

	// increment the server clock
	serverClock = serverClock + syncEvery*20;
}

// sync with the actual clock from the server
function sync() {
 	$.getJSON('./getServerTime.php',
		function(data) {
			$('#debug').text("drift: " + (serverClock - data[0]));
			serverClock = data[0];
		});
}

$(document).ready(
	function() {
		sync();
		setInterval(sync, 360000);
		setInterval(rotate, syncEvery*1000);
	});
