// JavaScript Document
var ColorArray = {RED: '#ed1c24', ORANGE: '#ff7f27', YELLOW: '#fff200', GREEN: '#22b14c', BLUE: '#00a2e8', VIOLET: '#a349a4', PINK: '#ffaec9', BLACK: '#dddddd'};

function updateTilts(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var result = this.responseText.trim();
			var RotDur = 1000;
			document.getElementById('TiltData').value = result;
			if (result !== 'NONE') {
				var DataArray = result.split('::');
				RotDur = 10000 / (DataArray.length - 1); //Set the tilt rotation delay
				for (var i = 0; i < (DataArray.length - 1); i++) {
					var SubData = DataArray[i].split(',');
					//setTimeout(function(){displayTiltData(SubData[0], SubData[3]);}, (i * RotDur));
					if (i == 0) {
						displayTiltData(SubData[0], SubData[3]);
					} else {
						var Delay = i * RotDur;
						setTimeout(function(){displayTiltData(SubData[0], SubData[3]);}, Delay);
					}
					
				}
			}
			
				
		}
	};
	xhttp.open("GET", 'getgrav.php', true);
	xhttp.send();
}

function displayTiltData(Color, Value) {
	var fValue = parseFloat(Value).toFixed(3);
	document.getElementById('Gravity').innerHTML = fValue;
	document.getElementById('Gravity').style.color = ColorArray[Color];
}

function updateValues() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var currentdata = this.responseText.trim().split(',');
			var InV, MainA, HotA, ColdA;
			//0            1        2       3        4    5        6         7        8       9     10
			//InputVoltage,MainAmps,HotAmps,ColdAmps,Temp,HotState,ColdState,TempUnit,SetTemp,Delta,MinCycle
			InV = parseFloat(currentdata[0]).toFixed(2);
			MainA = parseFloat(currentdata[1]).toFixed(2);
			HotA = parseFloat(currentdata[2]).toFixed(2);
			ColdA = parseFloat(currentdata[3]).toFixed(2);
			document.getElementById('SetTemp').innerHTML = parseFloat(currentdata[8]).toFixed(1) + "&#176;";
			document.getElementById('CurrentTemp').innerHTML = parseFloat(currentdata[4]).toFixed(1) + "&#176;";
			document.getElementById('SetDelta').innerHTML = "&#916;" + parseFloat(currentdata[9]).toFixed(1) + "&#176;";
			
			document.getElementById('InputVoltage').innerHTML = InV;
			if ((InV < 114) || (InV > 126)) {
				document.getElementById('InputVoltage').style.color = '#ffff00';
			} else if ((InV < 108) || (InV > 132)) {
				document.getElementById('InputVoltage').style.color = '#ff0000';
			} else {
				document.getElementById('InputVoltage').style.color = '#dddddd';
			}
			document.getElementById('MainAmps').innerHTML = MainA;
			if (MainA > 12) {
				document.getElementById('MainAmps').style.color = '#ffff00';
			} else if (MainA > 13.5) {
				document.getElementById('MainAmps').style.color = '#ff0000';
			} else {
				document.getElementById('MainAmps').style.color = '#dddddd';
			}
			document.getElementById('HotAmps').innerHTML = HotA;
			if (HotA > 12) {
				document.getElementById('HotAmps').style.color = '#ffff00';
			} else if (HotA > 13.5) {
				document.getElementById('HotAmps').style.color = '#ff0000';
			} else {
				document.getElementById('HotAmps').style.color = '#dddddd';
			}
			document.getElementById('ColdAmps').innerHTML = ColdA;
			if (ColdA > 12) {
				document.getElementById('ColdAmps').style.color = '#ffff00';
			} else if (ColdA > 13.5) {
				document.getElementById('ColdAmps').style.color = '#ff0000';
			} else {
				document.getElementById('ColdAmps').style.color = '#dddddd';
			}
			
			var StartTimestamp = Number(document.getElementById('StartTime').value) * 1000;
			var CurrentTime = new Date();
			var Elapsed = CurrentTime.getTime() - StartTimestamp;
			var DaysElapsed = Math.floor(Elapsed / 86400000);
			var TimeLeft = Elapsed - (DaysElapsed * 86400000);
			var HoursElapsed = Math.floor(TimeLeft / 3600000);
			TimeLeft = TimeLeft - (HoursElapsed * 3600000);
			var MinsElapsed = Math.floor(TimeLeft / 60000);
			TimeLeft = TimeLeft - (MinsElapsed * 60000);
			var SecsElapsed = Math.floor(TimeLeft / 1000);
			document.getElementById('ElapsedTime').innerHTML = DaysElapsed + "d " + HoursElapsed + "h " + MinsElapsed + "m " + SecsElapsed + "s";
			var cd = CurrentTime.getDate() + '/' + (CurrentTime.getMonth() + 1) + '/' + CurrentTime.getFullYear() + ' ' + CurrentTime.getHours() + ':' + CurrentTime.getMinutes() + ':' + CurrentTime.getSeconds();
			document.getElementById('LastUpdated').innerHTML = cd;
			
		}
	};
	xhttp.open("GET", '/updatevalues.php', true);
	xhttp.send();
}

function loaded() {
	pageTimer();
	setInterval(pageTimer, 1000);
	setInterval(rotateTilts, 5000);
}

function pageTimer() {
	updateValues();
	updateTilts();
}
