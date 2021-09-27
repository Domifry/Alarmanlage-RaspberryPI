#!/usr/bin/env python3
from urllib.parse import urlencode
from urllib.request import Request, urlopen
import mysql.connector
import mysql
url = None
connection = mysql.connector.connect(host="DATEBANK", user="USER", passwd="PASSWORT", db="DATENBANK")
cursor = connection.cursor()
statement = "SELECT * FROM  `Status` WHERE  `ID` =2"
cursor.execute(statement)
result = cursor.fetchall()
for r in result:
  modus = r[1]
cursor.close()
connection.commit()
connection.close()
if str(modus) == "1":
  url = 'https://www.pushsafer.com/api'  
  post_fields = {                      
    "t": "Alarm",
    "m": "Das Script hat sich neu gestartet!",
    "s": 5,
    "v": 3,
    "i": 37,
    "k": "DEINCODE"
  }
  request = Request(url, urlencode(post_fields).encode())
  json = urlopen(request).read().decode()
