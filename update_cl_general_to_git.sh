#!/bin/bash
#only blank
echo 'Give mysql password'
read password

mysqldump  -d -uroot cl_general -p$password > cl_general_blank.sql 

for tname in examination profile report sample_id_strategy
do
	mysqldump  -uroot cl_general $tname -p$password > "cl_general_$tname.sql"
done

git add *
git commit -a
git push https://github.com/nishishailesh/cl_general master

