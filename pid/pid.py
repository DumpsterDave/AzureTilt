# -*- coding: utf-8 -*-
import piplates.DAQCplate as daqc
import math
import os
import time

V_OFFSET = 0.044
V_RATIO = 35.4
PID_PATH = "/var/www/html/pid"

HotState = 0
ColdState = 0
TempUnits = 'f'
MinCycle = 300.0
SetTemp = 50.0
SetDelta = 1.0


def Vrms(plate, addr):
   Vmax = 0
   Vmin = 1000

   for x in range(0,200):
      Vin = (daqc.getADC(plate ,addr) - V_OFFSET)
      if Vin > Vmax:
         Vmax = Vin
      if Vin < Vmin:
         Vmin = Vin

   Veff = Vmax * V_RATIO
   return Veff

def Curr(addr, bit):
  Vmax = 0.0

  for x in range (0,128):
    Vin = daqc.getADC(addr, bit)
    Vin = (Vin - V_OFFSET)
    if Vin > Vmax:
      Vmax = Vin

  return (Vmax * 30)

while 1:
	#Read from Set files in case they've been updated
	a = open("{0}/set.tempUnit".format(PID_PATH), 'r')
	TempUnits = a.read()
	a.close()
	b = open("{0}/set.minCycle".format(PID_PATH), 'r')
	MinCycle = float(b.read())
	b.close()
	c = open("{0}/set.temp".format(PID_PATH), 'r')
	SetTemp = float(c.read())
	c.close()
	d = open("{0}/set.delta".format(PID_PATH), 'r')
	SetDelta = float(d.read())
	d.close()
	
	MinTemp = SetTemp - SetDelta
	MaxTemp = SetTemp + SetDelta
	
	#Get Sensor Data
	InputVoltage = Vrms(0,3)
	MainAmps = Curr(0,0)
	HotAmps = Curr(0,1)
	ColdAmps = Curr(0,2)
	Temp = daqc.getTEMP(0, 0, TempUnits[0])

	#Check our last run time, if > minCycle, see if we need to toggle SSRs
	lrf = open("{0}/last.run".format(PID_PATH), 'r')
	lastRun = float(lrf.read())
	lrf.close()
	now = time.time()
	if now > (lastRun + MinCycle):
		Toggled = 0
		if Temp > MaxTemp:
			if ColdState == 0:
				daqc.clrDOUTbit(0,0) #Hot Off
				daqc.setDOUTbit(0,1) #Cold On
				HotState = 0
				ColdState = 1
				Toggled = 1
		elif Temp < MinTemp:
			if HotState == 0:
				daqc.setDOUTbit(0,0) #Hot On
				daqc.clrDOUTbit(0,1) #Cold Off
				HotState = 1
				ColdState = 0
				Toggled = 1
		else:
			if (ColdState == 1) or (HotState == 1):
				daqc.setDOUTall(0,0) #all Off
				HotState = 0
				ColdState = 0
				Toggled = 1
		
		#update Last Run
		if Toggled == 1:
			lrf = open("{0}/last.run".format(PID_PATH), 'w')
			lrf.write("{0}".format(now))
			lrf.close()

	#Update curr.data, then sleep for 1 seconds
	out = open("{0}/curr.data".format(PID_PATH), 'w')
	out.write("{0},{1},{2},{3},{4},{5},{6}".format(InputVoltage, MainAmps, HotAmps, ColdAmps, Temp, HotState, ColdState))
	out.close()
	time.sleep(1)


