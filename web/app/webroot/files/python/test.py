#!/usr/bin/env python

import subprocess

subprocess.call(["./ParseInput.py", "turn the temperature up to 20 degrees celcius on saturday at noon"])
subprocess.call(["./ParseInput.py", "every wednesday and thursday at half past noon, set the temperature to 75 degrees"])
subprocess.call(["./ParseInput.py", "turn off the thermostat"])
subprocess.call(["./ParseInput.py", "what is the current temperature"])

