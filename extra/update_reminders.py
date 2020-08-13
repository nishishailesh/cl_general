#!/usr/bin/python3
import crontab
import MySQLdb
import logging
import datetime
import sys

sys.path.append('/var/gmcs_config')
import astm_var

###Settings###

database='cl_general'

##############
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


def update_reminders():
  #print(sys.argv[1])
  m=my_sql()
  link=m.get_link('127.0.0.1',astm_var.my_user,astm_var.my_pass,database)
  current_time=datetime.datetime.now()
  prepared_sql='insert into reminders \
  					(reminder,datetime,completed) values \
  					(%s , %s, %s)';
  data_tpl=(sys.argv[1],current_time,0)
  #print(prepared_sql)
  #print(data_tpl)
  cur=m.run_query(link,prepared_sql,data_tpl)

if __name__=='__main__':
  logging.basicConfig(filename='/var/log/reminders.log',level=logging.DEBUG)
  update_reminders()
