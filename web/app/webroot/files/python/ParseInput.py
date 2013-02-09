#!/usr/bin/env python

from Parser import Preprocessor
from Parser import NumberParser
from Parser import DeviceParser
from Parser import DeviceStateParser
from Parser import ThermostatQueryObjectParser
from Parser import DegreeParser
from Parser import ThermostatCommandParser
from Parser import TimedeltaParser
from Parser import TimeParser
from Parser import DayParser
from Parser import DaylistParser
from sets import Set
import sys

pre = Preprocessor()
num = NumberParser()
dev = DeviceParser()
sta = DeviceStateParser()
obj = ThermostatQueryObjectParser()
deg = DegreeParser(num)
cmd = ThermostatCommandParser(deg)
tdp = TimedeltaParser(num)
tmp = TimeParser(num, tdp)
day = DayParser()
dlp = DaylistParser(day)

# Check the number of arguments passed.
if (len(sys.argv) < 1):
	print "Error"

parseInput = sys.argv[1]
parseResponse = {}
attr = {}

parseInput = pre.preprocess(parseInput)

parseInput = num.parse(parseInput)
for i in range(len(num)):
	pass #print 'number = ' + repr(num.get(i))

# parse the device
parseInput = dev.parse(parseInput)
# for i in range(len(cmd)):
# 	parseResponse["device"] = repr(dev.get(i)) 
## Doesn't seem to work

parseResponse["device"] = "thermostat"


# parse the object
parseInput = obj.parse(parseInput)
for i in range(len(obj)):
	attr["query"] = obj.get(i)

# parse the command
print parseInput
parseInput = cmd.parse(parseInput)
for i in range(len(cmd)):
	parseResponse["command"] = cmd.get(i)

# parse the attributes

# parse the degrees
parseInput = deg.parse(parseInput)
for i in range(len(deg)):
		attr["temperature"] = deg.get(i)

# parse the time
parseInput = tdp.parse(parseInput)
for i in range(len(tdp)):
	pass #print 'timedelta = ' + repr(tdp.get(i))

parseInput = tmp.parse(parseInput)
for i in range(len(tmp)):
	attr["time"] = tmp.get(i)

# parse the schedule
parseInput = day.parse(parseInput)
for i in range(len(day)):
	pass #print 'day = ' + repr(day.get(i))

# initialize the days
days = {}
for j in range(7):
	days[repr(j)] = repr(False)

# initialize repetition
repeat = False

# set this to true if any of the days is >= 7
# i.e. if we are suppose to repeat the command
# TODO: repeat some days but not others (?)
parseInput = dlp.parse(parseInput)
for i in range(len(dlp)):
	for j in dlp.get(i):
		# repeat if any day is >= 7
		if j >= 7:
			repeat = True
		# the day itself is %7
		days[repr(j%7)] = repr(True)

# parse the device state command
parseInput = sta.parse(parseInput)
for i in range(len(sta)):
	attr["state"] = sta.get(i)

# add stuff to attr
attr["days"] = days
if repeat:
	attr["repeat"] = "weekly"
else:
	attr["repeat"] = "never"

# add attr to parseResponse
parseResponse["attr"] = attr

print str(parseResponse)
