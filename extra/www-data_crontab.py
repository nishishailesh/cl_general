#!/usr/bin/python3
import crontab
import MySQLdb
import logging
import datetime
import sys

sys.path.append('/var/gmcs_config')
import astm_var

####Settings for update_reminders.py script
update_reminders_path="/usr/share/nchs/cl_general/extra/update_reminders.py "

'''
following is example line in /etc/crontab
Donot add it in root crontab, because it will be overwritten by this script

*  *    * * *   root    /usr/share/smp/cl_general/extra/www-data_crontab.py 1 >>/var/log/www-data_crontab.log 2>>/var/log/www-data_crontab.log

service cron restart
'''
#####

class my_sql(object):
  def get_link(self,my_host,my_user,my_pass,my_db):
    con=MySQLdb.connect(my_host,my_user,my_pass,my_db)
    logging.debug(con)
    if(con==None):
      if(debug==1): logging.debug("Can't connect to database")
    else:
      logging.debug('connected')
    return con

  def run_query(self,con,prepared_sql,data_tpl):
    cur=con.cursor(MySQLdb.cursors.DictCursor)
    cur.execute(prepared_sql,data_tpl)
    con.commit()
    msg="rows affected: {}".format(cur.rowcount)
    logging.debug(msg)
    return cur

  def get_single_row(self,cur):
    return cur.fetchone()

  def close_cursor(self,cur):
    cur.close()

  def close_link(self,con):
    con.close()


def refresh_crontab():
  m=my_sql()
  link=m.get_link('127.0.0.1',astm_var.my_user,astm_var.my_pass,'cl_general')
  prepared_sql='select * from dementia'
  data_tpl=tuple()
  cur=m.run_query(link,prepared_sql,data_tpl)
  cron_text=''
  one_c=m.get_single_row(cur)
  while(one_c!=None):
    #print(one_c)
    dt=datetime.datetime.now()
    cron_text=cron_text + \
                  one_c['Minutes'] + ' '+ \
                  one_c['Hours'] + ' ' +\
                  one_c['DayM'] +' ' + \
                  one_c['Month'] + ' ' +\
                  one_c['DayW'] + ' ' +  \
                  update_reminders_path + " '" + one_c['Text'] + "'\n"
                  
    one_c=m.get_single_row(cur)
    #print("cron_text=", cron_text)
  my_cron=crontab.CronTab(tab=cron_text)
  my_cron.write_to_user('root')

if __name__=='__main__':
  logging.basicConfig(filename='/var/log/cl_general_cron.log',level=logging.DEBUG)
  refresh_crontab()
