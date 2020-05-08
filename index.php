<?php
	$tmp = explode(' ', file_get_contents('/proc/uptime'));
	$BootTime = intval(time()) - intval($tmp[0]);
?>
<!doctype html>
<html>
<head>
	<script type="text/javascript" language="javascript" src="js/main.js"></script>
<meta charset="utf-8">
<title>Chronobrew FermMonitor</title>
	<link rel="stylesheet" type="text/css" href="css/ferm.css" />
</head>

<body bgcolor="#333333" onLoad="loaded();">
	<div id="mBack">
		<div id="mPID">
			<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="mainTextL">S:</td><td class="mainTextR"><a href="settemp.php" id="SetTemp">99.9&#176;</a></td>
				</tr>
				<tr>
					<td class="mainTextL">V:</td><td class="mainTextR"><label id="CurrentTemp">99.9&#176;</label></td>
				</tr>
				<tr>
					<td class="mainTextL">G:</td><td class="mainTextR" id="Gravity">1.060</td>
				</tr>
			</table>
		</div>
		<div id="mDelta"><a href="setdelta.php" id="SetDelta">&#916;1.0&#176;</a>
		</div>
		<div id="mPower">
			<table cellpadding="0" cellspacing="0" width="557" border="0">
				<tr>
					<td width="140">In Voltage: </td><td id="InputVoltage"></td>
					<td width="140">Main Amps: </td><td id="MainAmps"></td>
				</tr>
				<tr>
					<td>Hot Amps: </td><td id="HotAmps"></td>
					<td>Cold Amps: </td><td id="ColdAmps"></td>
				</tr>
			</table>
		</div>
		<div id="mTimers">
			<table cellpadding="0" cellspacing="0" width="557" border="0">
				<tr>
					<td>Elapsed:</td>
					<td id="ElapsedTime">0d 0h 0m 0s</td>
					<td>Updated:</td>
					<td id="LastUpdated">00/00/00 00:00</td>
				</tr>
			</table>
		</div>
	</div>
	<div id="mButtons">
		<a href="config.php"><img src="img/gear.png" alt="Settings"/></a>
	</div>
	<input type="hidden" id="ControlTemp" value=""/>
	<input type="hidden" id="StartTime" value="<?php echo $BootTime; ?>" />
	<input type="hidden" id="TiltData" value=""/>
</body>
</html>
