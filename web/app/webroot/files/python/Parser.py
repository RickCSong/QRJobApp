#!/usr/bin/env python

from UserList import UserList
from sets import Set
from datetime import datetime, timedelta
import re
import math

class Preprocessor:
    def __init__(self):
        self.remove = '\.|,|;|:|\?'

    def preprocess(self, string):
        string = string.lower()
        string = re.sub(self.remove, '', string)
        string = re.sub('zero', '0', string)
        string = re.sub('one', '1', string)
        string = re.sub('two', '2', string)
        string = re.sub('three', '3', string)
        string = re.sub('four', '4', string)
        string = re.sub('five', '5', string)
        string = re.sub('six', '6', string)
        string = re.sub('seven', '7', string)
        string = re.sub('eight', '8', string)
        string = re.sub('nine', '9', string)
        return string

# parses a regexp and replaces it with @name
# stores a list of items that have been parsed
class Parser(UserList):
    def __init__(self, name, regexp):
        UserList.__init__(self)
        self.name = name
        self.regexp = '(' + regexp + ')'

    def parse(self, string):
        x = re.search(self.regexp, string)
        while not x is None:
            string = string[:x.start()] + '@'+self.name+self.addAmp(repr(len(self))) + string[x.end():]
            UserList.append(self, x)
            x = re.search(self.regexp, string)
        return string
    
    def addAmp(self, string):
        for i in range(len(string)):
            string = string[0:2*i] + '@' + string[2*i:]
        return string        

    def removeAmp(self, string):
        return re.sub('@', '', string)

class NumberParser(Parser):
    def __init__(self):
        Parser.__init__(self, 'number', '((?P<number>(?<!@)[0-9]+)( and (a )?(?P<fraction0>half|fourth|quarter))?)|((a )?(?P<fraction1>half|fourth|quarter))')

    def get(self, i):
        if i<0 or i>=len(self):
            return 0.0
        num = 0
        if not self[i].group('number') is None:
            num = float(self[i].group('number')) # the number
        frac = self[i].group('fraction0') # the fractional part (half, fourth, quarter)
        if frac == None:
            frac = self[i].group('fraction1')
        if frac == 'half':
            num = num + 0.5
        elif frac == 'quarter' or frac == 'fourth':
            num = num + 0.25
        return num
        
class DeviceParser(Parser):
    def __init__(self):
        Parser.__init__(self, 'device', '(?P<device>thermostat|air condition(ing|er)|a c|heater|heat|alarm clock|alarm|clock)')

    def get(self, i):
        thermostatSet = ['thermostat', 'air conditioning', 'air conditioner', 'a c', 'heater', 'heat']
        if self[i].group('device') in thermostatSet:
            return 'thermostat'
        alarmClockSet = ['alarm', 'clock', 'alarm clock']
        if self[i].group('device') in alarmClockSet:
            return 'clock'
        return 'none'

# run this last
# TODO: don't have to run this last!
class DeviceStateParser(Parser):
    def __init__(self):
        Parser.__init__(self, 'state', '(?P<state>on|off)')

    def get(self, i):
        return self[i].group('state')

# QueryObjectParser: current temperature, current target, current schedules, etc.
class ThermostatQueryObjectParser(Parser):
    def __init__(self):
        Parser.__init__(self, 'queryobject', '(current )?(?P<object>target temperature|target|temperature|schedules?)')

    def get(self, i):
        targetSet = ['target temperature', 'target']
        if self[i].group('object') in targetSet:
            return 'target'

        currentSet = ['temperature']
        if self[i].group('object') in currentSet:
            return 'current'

        scheduleSet = ['schedule', 'schedules']
        if self[i].group('object') in scheduleSet:
            return 'schedule'

class DegreeParser(Parser):
    def __init__(self, numParser):
        Parser.__init__(self, 'degree', '((?P<modifier0>by|to) )?@number(?P<number>(@[0-9])*) degrees( (?P<units>fahrenheit|celcius))?')
        self.numParser = numParser

    def get(self, i):
        if i<0 or i>=len(self):
            return 0.0
        return self.numParser.get(int(Parser.removeAmp(self, self[i].group('number')))) # the number

class ThermostatCommandParser(Parser):

    def __init__(self, degreeParser):
        Parser.__init__(self, 'command', '(?P<command>turn|higher|raise|increase|lower|decrease|set|get|what is|what are|give me|tell me|show me|is the)')
        self.degreeParser = degreeParser

    def get(self, i):
        if i<0 or i>=len(self):
            return 'null'

        stateSet = ['turn']
        if self[i].group('command') in stateSet:
            return 'setState'
        
        getTempSet = ['get', 'what is', 'what are', 'give me', 'tell me', 'query' 'show me', 'is the']
        if self[i].group('command') in getTempSet:
            return 'getTemp'

        setTempSet = ['set']
        if (self.degreeParser.get(0) >= 40) or (self[i].group('command') in setTempSet):
            return 'setTemp'

        raiseTempSet = ['raise', 'increase', 'higher']
        if self[i].group('command') in raiseTempSet:
            return 'raiseTemp'

        lowerTempSet = ['lower', 'decrease']
        if self[i].group('command') in lowerTempSet:
            return 'lowerTemp'
        return 'none'

class TimedeltaParser(Parser):
    def __init__(self, numParser):
        Parser.__init__(self, 'timedelta', '((@number(?P<number0>(@[0-9])*) )?(?P<units0>(minute|hour|second)s? )?(?P<modifiers>before|until|til|till|past|after|from))|(in |after )?((@number(?P<number1>(@[0-9]))* )?(?P<units1>minute|hour|second)s?)')
        self.numParser = numParser

    def get(self, i):
        if i<0 or i>=len(self):
            return 0.0
        num = 0
        if self[i].group('number0') != None: # the number
            num = self.numParser.get(int(Parser.removeAmp(self, self[i].group('number0'))))
        elif self[i].group('number1') != None: # the number
            num = self.numParser.get(int(Parser.removeAmp(self[i].group('number1'))))
        if self[i].group('units0') == 'second' or self[i].group('units1') == 'second': # the units
            num = num/3600.0
        elif self[i].group('units0') == 'minute' or self[i].group('units1') == 'minute':
            num = num/60.0
        elif self[i].group('units0') == 'hour' or self[i].group('units1') == 'hour': # the units
            pass
        else:
            if num-math.trunc(num) == 0.0:
                num = num/60.0

                
        negativeMods = ['before', 'until', 'til', 'till']
        if self[i].group('modifiers') in negativeMods: # +/- modifiers
            num = -num
        return num # number of hours to add

class TimeParser(Parser):
    def __init__(self, numParser, timedeltaParser):
        Parser.__init__(self, 'time', '((?P<modifier0>morning|afternoon|evening|night) )?(at )?(@timedelta(?P<timedelta0>(@[0-9])*) )?(?P<time>midnight|noon|now|@number(?P<number>(@[0-9])*) ?(oclock ?)?(?P<modifier1>am|pm|morning|afternoon|evening|night)?)|@timedelta(?P<timedelta1>(@[0-9])*)')
        self.numParser = numParser
        self.timedeltaParser = timedeltaParser

    def getNow(self):
        now = datetime.now().time()
        return now.hour/1.0 + now.minute/60.0 + now.second/3600.0

    def get(self, i):
        if i<0 or i>= len(self):
            return self.getNow()
        time = 0.0
        if not self[i].group('number') is None: # the time
            time = math.trunc(self.numParser.get(int(Parser.removeAmp(self, self[i].group('number')))))
            if time >= 100:
                time = time/100 + (time%100)/60.0
            if not self[i].group('timedelta0') is None: # the timedelta
                time += self.timedeltaParser.get(int(Parser.removeAmp(self, self[i].group('timedelta0'))))
            if not self[i].group('timedelta1') is None: # the timedelta
                time += self.timedeltaParser.get(int(Parser.removeAmp(self, self[i].group('timedelta1'))))
            addModifier = ['pm', 'afternoon', 'evening', 'night']
            if self[i].group('modifier0') in addModifier or self[i].group('modifier1') in addModifier:
                time += 12.0
        elif self[i].group('time') == 'noon':
            time = 12.0
        elif self[i].group('time') == 'midnight':
            time = 0.0
        else:
            time = self.getNow()

        return time

# TODO: mondays through fridays vs. monday through friday
class DayParser(Parser):
    def __init__(self):
        Parser.__init__(self, 'day', '(?P<day>monday|tuesday|wednesday|thursday|friday|saturday|sunday)s?')

    def getToday(self):
        return datetime.now().date().weekday()

    def get(self, i):
        if i<0 or i>= len(self):
            return self.getToday()
        if self[i].group('day') == 'monday':
            return 0
        if self[i].group('day') == 'tuesday':
            return 1
        if self[i].group('day') == 'wednesday':
            return 2
        if self[i].group('day') == 'thursday':
            return 3
        if self[i].group('day') == 'friday':
            return 4
        if self[i].group('day') == 'saturday':
            return 5
        if self[i].group('day') == 'sunday':
            return 6

# TODO: handle on/at sunday (once) vs. every sunday, on/at sundays, this sunday, mondays through fridays, weekdays, every weekday
# TODO: just every -> everyday
class DaylistParser(Parser):
    def __init__(self, dayParser):
        Parser.__init__(self, 'dlist', '(?P<everyday>(each|every) ?(day|@time|morning|afternoon|evening|night))|(?P<weekday>week ?days?)|(?P<weekend>week ?ends?)|(?P<dayrange>@day(?P<number0>(@[0-9])*) (to|through) @day(?P<number1>(@[0-9])*))|(?P<day>@day(?P<number2>@[0-9])*)')
        self.dayParser = dayParser
    
    def get(self, i):
        if i<0 or i>= len(self):
            return Set()
        if not self[i].group('everyday') is None:
            return Set(range(0,7))
        if not self[i].group('weekday') is None:
            return Set(range(0,5))
        if not self[i].group('weekend') is None:
            return Set(range(5,7))
        if not self[i].group('dayrange') is None:
            result = Set()
            day0 = self.dayParser.get(int(Parser.removeAmp(self, self[i].group('number0'))))
            day1 = self.dayParser.get(int(Parser.removeAmp(self, self[i].group('number1'))))
            if day0 <= day1:
                for i in range(day0, day1+1):
                    result.add(i)
                return result
            else:
                for i in range(day0, day1+8):
                    result.add(i%7)
                return result
        if not self[i].group('day') is None:
            return Set([self.dayParser.get(int(Parser.removeAmp(self, self[i].group('number2'))))])
