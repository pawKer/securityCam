#!/usr/bin/env python
# -*- coding: utf-8 -*-
import os
import time
import commands
import subprocess
while(1):
 # print "Running..."
  target = open("cam/temp.html", 'w')

  out =  subprocess.check_output(["/opt/vc/bin/vcgencmd"," measure_temp"])

  temperature = ""
  curr = 0
  for i in str(out):
   if curr > 4 and curr < 9:
     temperature += i
   curr += 1
  target.write("""
  <html>
  <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> 
 </head>
  <body>
<div class="row2">
<div class="col-md-12">
<br>
<br>
<br>
<br>
<br>
</div>
</div>
<div class="row2">
<div class="col-md-4 col-md-offset-4">
  <div class="well" style="box-shadow: 2px 0px 20px #666565;">
    <hr style="border-width: 1px 0; border-color: grey">
    <center>
    <h1 style="color:red;align:center">Temperature is %s °C</h1>
   <form method="get" action="http://192.168.0.45/cam/"> <button type="submit" class="btn btn-success">Back</button></form>
    <hr style="border-width: 1px 0; border-color: grey">
  </div>
</div>
</div>
</div>
</div>  
</body>
  </html>
  """ % temperature)
  target.write("\n")
  target.close()
  time.sleep(1)

 
