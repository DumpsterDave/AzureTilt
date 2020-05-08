<?php
	$PID_PATH = '/var/www/html/pid';
	$TILT_COLORS = 8;

	$f = fopen($PID_PATH . '/curr.grav', 'r');
	$Lines = array();
	for ($i = 0; $i < $TILT_COLORS; $i++) {
		$Lines[] = fgets($f);
	}
	fclose($f);

	$ActiveTilts = "";
	for($i = 0; $i < $TILT_COLORS; $i++) {
		$Line = $Lines[$i];
		$Parts = explode(',', $Line);
		if((time() - intval($Parts[1])) < 600) {
			$Trimmed = trim($Line);
			$ActiveTilts .= "{$Trimmed}::";
		}
	}
	if (strlen($ActiveTilts) == 0) {
		echo "NONE";
	} else {
		echo $ActiveTilts;
	}
?>