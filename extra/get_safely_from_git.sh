#!/bin/sh

##################
#Script to overwright local copy with git
#Change variables as per your choice
#it copy main server files to a dated-folder
#then bring git files to a folder
#then copy git files to server folder

#Settings
#a backup folder
backup_path=/root/proj.home/cl_general/from_local
#real folder
server_path=/usr/share/smp/cl_general
#git folder , use <git init> once
git_path=/root/proj.home/cl_general/from_git
#Settings complete

echo 'Step:1 press any key to take backup from main folder'
read x
cp $server_path "$backup_path.`date`" -Rvf

echo 'Step:2 press a key to take new from git'
read x
cd $git_path
git pull https://github.com/nishishailesh/cl_general

echo 'Step:3 press a key to copy git to main folder(in doubt press ctrl+c'
read x
cp $git_path/* $server_path -Rvf
