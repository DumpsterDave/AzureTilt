function update(btn) {
	var Temp = document.getElementById('NewTemp').innerHTML.replace(/\./g, '');
	Temp = parseInt(Temp).toString();
	switch (btn) {
		case 'd':
			if (Temp.length == 2) {
				Temp = Temp.substring(0, 1);
			} else {
				Temp = '';
			}
			break;
		case 'o':
			var NewTemp;
			NewTemp = (parseFloat(Temp) / 10).toFixed(1);
			window.location = 'setdelta.php?set=' + NewTemp;
			break;
		case '1':
			if (Temp.length < 2) {
				Temp = Temp + "1";
			}
			break;
		case '2':
			if (Temp.length < 2) {
				Temp = Temp + "2";
			}
			break;
		case '3':
			if (Temp.length < 2) {
				Temp = Temp + "3";
			}
			break;
		case '4':
			if (Temp.length < 2) {
				Temp = Temp + "4";
			}
			break;
		case '5':
			if (Temp.length < 2) {
				Temp = Temp + "5";
			}
			break;
		case '6':
			if (Temp.length < 2) {
				Temp = Temp + "6";
			}
			break;
		case '7':
			if (Temp.length < 2) {
				Temp = Temp + "7";
			}
			break;
		case '8':
			if (Temp.length < 2) {
				Temp = Temp + "8";
			}
			break;
		case '9':
			if (Temp.length < 2) {
				Temp = Temp + "9";
			}
			break;
		case '0':
			if (Temp.length < 2) {
				Temp = Temp + "0";
			}
			break;
	}
	var fTemp;
	if (Temp.length !== 0) {
		fTemp = (parseFloat(Temp) / 10).toFixed(1);
	} else {
		fTemp = 0;
	}
	document.getElementById('NewTemp').innerHTML = parseFloat(fTemp).toFixed(1);
}