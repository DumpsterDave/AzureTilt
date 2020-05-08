function loadPage() {
	var t = document.getElementById('TempUnit').value;
	var g = document.getElementById('GravUnit').value;
	
	switch(t) {
		case 'C':
			document.getElementById('tempC').style.color = '#22b14c';
			document.getElementById('tempF').style.color = '#dddddd';
			break;
		case 'F':
			document.getElementById('tempC').style.color = '#dddddd';
			document.getElementById('tempF').style.color = '#22b14c';
			break;
		default:
			document.getElementById('tempC').style.color = '#dddddd';
			document.getElementById('tempF').style.color = '#dddddd';
			break;
	}
	
	switch(g) {
		case 'B':
			document.getElementById('gravB').style.color = '#22b14c';
			document.getElementById('gravP').style.color = '#dddddd';
			document.getElementById('gravS').style.color = '#dddddd';
			break;
		case 'P':
			document.getElementById('gravB').style.color = '#dddddd';
			document.getElementById('gravP').style.color = '#22b14c';
			document.getElementById('gravS').style.color = '#dddddd';
			break;
		case 'S':
			document.getElementById('gravB').style.color = '#dddddd';
			document.getElementById('gravP').style.color = '#dddddd';
			document.getElementById('gravS').style.color = '#22b14c';
			break;
		default:
			document.getElementById('gravB').style.color = '#dddddd';
			document.getElementById('gravP').style.color = '#dddddd';
			document.getElementById('gravS').style.color = '#dddddd';
			break;
	}
}