#!/usr/bin/env python3
#https://github.com/Domifry/
import mysql.connector
import mysql
import argparse
import signal
import sys
import time
import logging
from urllib.parse import urlencode
from urllib.request import Request, urlopen

from rpi_rf import RFDevice

rfdevice = None


def exithandler(signal, frame):
    rfdevice.cleanup()
    sys.exit(0)


parser = argparse.ArgumentParser(
    description='Receives a decimal code via a 433/315MHz GPIO device')
parser.add_argument('-g', dest='gpio', type=int, default=17,
                    help="GPIO pin (Default: 17)")
args = parser.parse_args()

signal.signal(signal.SIGINT, exithandler)
rfdevice = RFDevice(args.gpio)
rfdevice.enable_rx()
timestamp = None
code = "123"
alarm = False
sensor = None
x = 1
while True:
    code2 = str(rfdevice.rx_code)
    if str(code) != str(code2):
        if str(code2) == "DEINCODE":
            sensor = "CODENAME z.B. Haustuer offen"
            alarm = True
        if str(code2) == "DEINCODE":
            sensor = "CODENAME z.B. Haustuer zu"
            alarm = True
        if alarm == True:
            code = code2
            alarm = False
            #TODO: DEINE DATEN
            connection = mysql.connector.connect(
                host="DEINEIP", user="USER", passwd="PASSWORT", db="DATENBANK")
            cursor = connection.cursor()
            statement = "INSERT INTO `DATENBANK`.`Alarme` (`Sensor`, `Zeit`) VALUES ('" + \
                sensor + "', CURRENT_TIMESTAMP)"
            cursor.execute(statement)
            cursor.close()
            # stiller alarm check
            cursor = connection.cursor()
            statement = "SELECT * FROM  `Status` WHERE  `ID` =1"
            cursor.execute(statement)
            result = cursor.fetchall()
            for r in result:
                 modus = r[1]
            cursor.close()
            connection.commit()
            connection.close()
            if str(modus) == "1":
                #TODO DEIN CODE
                url = 'https://www.pushsafer.com/api' 
                post_fields = {                       
                    "t": "Alarm",
                    "m": sensor,
                    "s": 5,
                    "v": 3,
                    "i": 1,
                    "k": "DEINCODE"
                }
                request = Request(url, urlencode(post_fields).encode())
                json = urlopen(request).read().decode()
    time.sleep(0.01)
rfdevice.cleanup()
