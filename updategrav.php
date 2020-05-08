<?php
	ini_set('display_errors', 1);

	require_once('./tiltoms.php');
	require_once('./const.php');

	$Tilt = new TiltOMS();
	$Azure = new AzureConfig();

	$PID_PATH = '/var/www/html/pid';
	$TILT_COLORS = 8;
	$Tilt->Set_Primary_Key($Azure->LA_WORKSPACE_KEY);
   	$Tilt->Set_Workspace_Id($Azure->LA_WORKSPACE_ID);
	$Tilt->Set_Log_Type($Azure->LA_LOG_TYPE);

	if (!isset($_POST['Color'])) {
        $_POST['Timepoint'] = 1000;
		$_POST['Temp'] = 68.0;
		$_POST['SG'] = 1.025;
		$_POST['Color'] = 'BLACK';
		$_POST['Comment'] = 'Test Data';
		$_POST['Beer'] = 'Water';
    }

	$f = fopen($PID_PATH . '/curr.grav', 'r');
	$AllGravities = array();
	for ($i = 0; $i < $TILT_COLORS; $i++) {
		$AllGravities[] = fgets($f);
	}
	fclose($f);
	
	switch($_POST['Color']) {
		case 'RED':
			$Color = 0;
			break;
		case 'ORANGE':
			$Color = 1;
			break;
		case 'YELLOW':
			$Color = 2;
			break;
		case 'GREEN':
			$Color = 3;
			break;
		case 'BLUE':
			$Color = 4;
			break;
		case 'VIOLET':
			$Color = 5;
			break;
		case 'PINK':
			$Color = 6;
			break;
		default:
			$Color = 7;
			break;
	}

	$TimeStamp = time();
	$AllGravities[$Color] = "{$_POST['Color']},{$TimeStamp},{$_POST['Temp']},{$_POST['SG']},'{$_POST['Beer']}','{$_POST['Comment']}'\n";

	$f = fopen($PID_PATH . '/curr.grav', 'w');
	for ($i = 0; $i < $TILT_COLORS; $i++) {
		fputs($f, $AllGravities[$i]);
	}
	fclose($f);

	$f = fopen($PID_PATH . '/curr.data', 'r');
	$CurrentData = fgets($f);
	fclose($f);

	$DataPoints = explode(',', $CurrentData);
	if (count($DataPoints) == 7) {
		$_POST['Voltage'] = $DataPoints[0];
		$_POST['MainAmps'] = $DataPoints[1];
		$_POST['HotAmps'] = $DataPoints[2];
		$_POST['ColdAmps'] = $DataPoints[3];
		$_POST['Temp'] = $DataPoints[4];
		$_POST['HotState'] = $DataPoints[5];
		$_POST['ColdState'] = $DataPoints[6];
	}
	
	$f = fopen($PID_PATH . '/set.temp', 'r');
	$SetTemp = fgets($f);
	fclose($f);
	$_POST['SetTemp'] = $SetTemp;

	$f = fopen($PID_PATH . '/set.delta', 'r');
	$SetDelta = fgets($f);
	fclose($f);
	$_POST['SetDelta'] = $SetDelta;

	$Entry = $Tilt->Generate_Entry_With_Hardware($_POST['Temp'], $_POST['SG'], $_POST['Beer'], $_POST['Color'], $_POST['Comment']);
	echo $Tilt->Send_Log_Analytics_Data($Entry);
?>
