#!/usr/bin/python3

import sys, io
import logging
import time
import zlib
import base64
import struct
import decimal
import base64 

#apt search python3-matplotlib
#apt install python3-matplotlib
import matplotlib.pyplot as plt 
import numpy as np 
import pandas as pd

import datetime

from astm_bidirectional_common import my_sql , file_mgmt, print_to_log

#to ensure that password is not in main sources
#prototype file is as follows

'''
example /var/gmcs_config/astm_var.py
#!/usr/bin/python3.7
my_user='uuu'
my_pass='ppp'
'''

'''
if anything is redirected, last newline is added.
To prevent it, use following
I needed this while outputting relevant data to a file via stdout redirection
echo -n `./astm_file2mysql_general.py` > x
'''

sys.path.append('/var/gmcs_config')
import astm_var
#print(dir(astm_var))
n_size=500


#Globals for configuration################
#used by parent class astm_file (so be careful, they are must)

log=1
my_host='127.0.0.1'
my_user=astm_var.my_user
my_pass=astm_var.my_pass
my_db='cl_general'

log_filename='/var/log/mylog/all_ma.log'
#logging.basicConfig(filename=log_filename,level=logging.DEBUG)
logging.basicConfig(filename=log_filename,level=logging.INFO)

if log==0:
  logging.disable(logging.CRITICAL)


def decode_base64_and_inflate( b64string ):
    decoded_data = base64.b64decode( b64string )
    return zlib.decompress( decoded_data , -15)

#not used in this project
def deflate_and_base64_encode( string_val ):
    zlibbed_str = zlib.compress( string_val )
    compressed_string = zlibbed_str[2:-4]
    return base64.b64encode( compressed_string )


def mk_histogram_from_tuple(xy,heading,x_axis,y_axis):
  r=pd.DataFrame(xy[1])
  m=r.rolling(20).mean()
  md=r.rolling(20).median()
  #ewma=r.ew
  
  rr=r.rename(columns={0:"result"})
  mm=m.rename(columns={0:"avg(20)"})
  mdd=md.rename(columns={0:"median(20)"})
  
  
  #final=rr.join(mm)
  #finall=final.join(mdd)
  
  finall=mm.join(mdd)
  finall.plot()
  
  f = io.BytesIO()
  plt.savefig(f, format='png')
  f.seek(0)
  data=f.read()
  f.close()
  plt.close()	#otherwise graphs will be overwritten, in next loop
  return data

def get_results(ms,examination_id):
  prepared_sql='select sample_id,result from result where examination_id=%s and result>0 order by sample_id desc limit %s'
  data_tpl=(examination_id,n_size)
  cur=ms.run_query_with_log(prepared_sql,data_tpl)
  r_tuple=()
  s_tuple=()
  if(cur!=None):
    r=ms.get_single_row(cur)
    highest_sid=r[0]
    logging.info("higest sample id:{}".format(highest_sid))
    
    while(r!=None):
      r_tuple=r_tuple+(float(r[1]),)
      s_tuple=s_tuple+(r[0]-highest_sid,)
      r=ms.get_single_row(cur)

  return s_tuple,r_tuple

ms=my_sql()
ms.get_link(astm_var.my_host,astm_var.my_user,astm_var.my_pass,astm_var.my_db)

examination_id=5031
x,y=get_results(ms,examination_id)
heading='try'
x_axis=sys.argv[1]
y_axis=sys.argv[2]
#logging.info("{},{}".format(x,y))

data=mk_histogram_from_tuple((x,y),heading,x_axis,y_axis)

encoded=base64.b64encode(bytes(data))

output=b''
output=output+b"<h4>Examination ID: "+bytes(   str(examination_id).encode('UTF-8')  )+b"</h4>"
output=output+b"<img width=1200 src='data:image/png;base64,"+ encoded +b"'/>"

sys.stdout.buffer.write(output)
