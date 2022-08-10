#!/bin/bash

tnames='examination profile report sample_id_strategy dashboard super_profile
        copy_bin_text view_info_data prototype prototype_data host_code lab_reference_value
        dementia equipment equipment_record_type record_tables table_field_specification
        reagent reagent_name unit_name cal_equipment reagent_use menu_new'

echo 'Give mysql username (just press enter if unix plugin to be used)'
read username
if [ -z "$username" ]
then
	mysqldump  -d cl_general         > cl_general_blank.sql
	mysqldump     cl_general $tnames > cl_general_data.sql
else
	mysqldump  -d -u$username cl_general         -p > cl_general_blank.sql 
	mysqldump     -u$username cl_general $tnames -p > cl_general_data.sql
fi

git add *
git commit -a
git push https://github.com/nishishailesh/cl_general
