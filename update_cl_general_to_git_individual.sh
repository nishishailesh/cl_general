#!/bin/bash
#only blank
echo 'Give mysql password'
read password

mysqldump  -d -uroot cl_general -p$password > cl_general_blank.sql 

for tname in examination profile report sample_id_strategy dashboard super_profile \
	copy_bin_text view_info_data prototype prototype_data host_code lab_reference_value \
	dementia equipment equipment_record_type record_tables table_field_specification\
	record_tables,reagent,reagent_name,unit
do
	mysqldump  -uroot cl_general $tname -p$password > "cl_general_$tname.sql"
done

git add *
git commit -a
git push https://github.com/nishishailesh/cl_general master

