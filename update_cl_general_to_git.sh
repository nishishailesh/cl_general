#!/bin/bash
#only blank
#mysqldump  -d -uroot cl_general -p > cl_general_blank.sql 
#full
mysqldump  -uroot cl_general -p > cl_general.sql 
git add *
git commit
git push https://github.com/nishishailesh/cl_general master
