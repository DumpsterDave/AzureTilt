<?php
	ini_set('display_errors', '1');

	$PID_PATH = '/var/www/html/pid';
	$f = fopen($PID_PATH . '/set.tempUnit', 'r');
	$TempUnit = strtoupper(trim(fgets($f)));
	fclose($f);

	$f = fopen($PID_PATH . '/set.gravUnit', 'r');
	$GravUnit = strtoupper(trim(fgets($f)));
	fclose($f);

	if (isset($_GET['restart'])) {
		$out = shell_exec('sudo shutdown -r now');
	}
	if (isset($_GET['shutdown'])) {
		$out = shell_exec('sudo shutdown -h now');
	}
	
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Configuration</title>
	<link rel="stylesheet" type="text/css" href="css/settemp.css" />
	<script type="text/javascript" language="javascript" src="js/config.js"></script>
</head>
<body onLoad="loadPage();">
	<div id="mBack">
		<table width="600" align="center" border="0" cellpadding="0" cellspacing="5">
			<tr>
				<td colspan="6" style="font-size: 40px; color: #666666;">Temperature Scale</td>
			</tr>
			<tr>
				<td colspan="3"><a href="#" id="tempC">&#176;C</a></td>
				<td colspan="3"><a href="#" id="tempF">&#176;F</a></td>
			</tr>
			<tr>
				<td colspan="6" style="font-size: 40px; color: #666666;">Gravity Scale</td>
			</tr>
			<tr>
				<td colspan="2"><a href="#" id="gravB">Brix</a></td>
				<td colspan="2"><a href="#" id="gravP">Plato</a></td>
				<td colspan="2"><a href="#" id="gravS">SG</a></td>
			</tr>
			<tr>
				<td colspan="6" style="font-size: 40px; color: #666666;">System</td>
			</tr>
			<tr>
				<td colspan="2"><a href="#" onClick="document.getElementById('config').submit();" id="back"><img src="img/back.png" alt="Back"/></a></td>
				<td colspan="2"><a href="config.php?restart"><img src="img/restart.png" alt="Restart" /></a></td>
				<td colspan="2"><a href="config.php?shutdown"><img src="img/shutdown.png" alt="Shutdown"/></a></td>
			</tr>
		</table>
		
	</div>
	<form name="config" id="config" action="index.php" method="post">
		<input type="hidden" id="TempUnit" name="TempUnit" value="<?php echo $TempUnit; ?>"/>
		<input type="hidden" id="GravUnit" name="GravUnit" value="<?php echo $GravUnit; ?>"/>
		<input type="hidden" id="cmdResult" value="<?php echo $out; ?>"/>
	</form>
</body>
</html>