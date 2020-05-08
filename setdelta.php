<?php
	$PID_PATH = '/var/www/html/pid';
	if ($_GET['set']) {
		$f = fopen($PID_PATH . '/set.delta', 'w');
		fputs($f, $_GET['set']);
		fclose($f);
		header('Location: index.php');
	}
	$NewTemp = 50.0;
	if (file_exists($PID_PATH . '/set.delta')) {
		$f = fopen($PID_PATH . '/set.delta', 'r');
		$NewTemp = number_format(floatval(fgets($f)), 1, '.', '');
		fclose($f);
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Set Delta</title>
	<link rel="stylesheet" type="text/css" href="css/settemp.css" />
	<script type="text/javascript" language="javascript" src="js/setdelta.js"></script>
</head>
<body>
	<div id="mBack">
		<div id="numPanel">
			<table width="400" cellpadding="0" cellspacing="5" id="numPanelTable">
				<tr height="110">
					<td class="numButton"><a href="#" onClick="update('7');">7</a></td>
					<td class="numButton"><a href="#" onClick="update('8');">8</a></td>
					<td class="numButton"><a href="#" onClick="update('9');">9</a></td>
				</tr>
				<tr height="110">
					<td class="numButton"><a href="#" onClick="update('4');">4</a></td>
					<td class="numButton"><a href="#" onClick="update('5');">5</a></td>
					<td class="numButton"><a href="#" onClick="update('6');">6</a></td>
				</tr>
				<tr height="110">
					<td class="numButton"><a href="#" onClick="update('1');">1</a></td>
					<td class="numButton"><a href="#" onClick="update('2');">2</a></td>
					<td class="numButton"><a href="#" onClick="update('3');">3</a></td>
				</tr>
				<tr height="110">
					<td class="numButton"><a href="#" onClick="update('0');">0</a></td>
					<td class="numButton"><a href="#" onClick="update('d');"><img src="img/delete.png" /></a></td>
					<td class="numButton"><a href="#" onClick="update('o');"><img src="img/ok.png" /></a></td>
				</tr>
			</table>
		</div>
		<div id="numDisplay">
			<table width="400" cellpadding="0" cellspacing="0" border="0">
				<tr height="480">
					<td id="NewTemp" valign="middle"><?php echo $NewTemp; ?></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>
