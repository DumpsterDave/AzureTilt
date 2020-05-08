<?php
	$PID_PATH = '/var/www/html/pid';
	$cdatafile = fopen($PID_PATH . '/curr.data', 'r');
	$Data = fgets($cdatafile);
	fclose($cdatafile);

	$f = fopen($PID_PATH . '/set.tempUnit', 'r');
	$Data .= (',' . fgets($f));
	fclose($f);

	$f = fopen($PID_PATH . '/set.temp', 'r');
	$Data .= (',' . fgets($f));
	fclose($f);

	$f = fopen($PID_PATH . '/set.delta', 'r');
	$Data .= (',' . fgets($f));
	fclose($f);

	$f = fopen($PID_PATH . '/set.minCycle', 'r');
	$Data .= (',' . fgets($f));
	fclose($f);

	print($Data);
?>