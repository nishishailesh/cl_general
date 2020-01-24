#!/usr/bin/python3.7
import gi
from gi.repository import Gtk
import subprocess
from gi.repository import GLib
#print(dir(Gtk.Button))

proc=None

def me_clicked(myself):
  global proc
  print('clicked' + myself.get_label())
  #proc = subprocess.Popen("/root/micros-connect/stxetxcut_tty.py", shell = True, stdout = subprocess.PIPE)
  proc = subprocess.Popen("/root/micros-connect/stxetxcut_tty.py", shell = False, stdout = subprocess.PIPE)
  print ("Process ID" , proc.pid)


def mp(self):
  print(self)
  
def get_micros_1_buffer(myself):
  print ("Process ID" , proc.pid)
  print ("Process Buffer" , proc.stdout,flush=True)

  
win = Gtk.Window()
bbox=Gtk.HButtonBox()

button1 = Gtk.Button.new_with_label("Start Micros-60 (1)")
button2 = Gtk.Button.new_with_label("Start Micros-60 (2)")
button3 = Gtk.Button.new_with_label("Start Micros-60 (3)")
button4 = Gtk.Button.new_with_label("Get Micros-60 (1) buffer")

#button1.connect("clicked", start_one())

bbox.add(button1)
bbox.add(button2)
bbox.add(button3)
bbox.add(button4)
win.add(bbox)

button1.connect("clicked", me_clicked)
button2.connect("clicked", me_clicked)
button3.connect("clicked", me_clicked)
button4.connect("clicked", get_micros_1_buffer)

win.show_all()
Gtk.main()
