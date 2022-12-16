#!/bin/bash
####if root password
echo 'Give mysql username'
read username

####if root password
mysqldump  -d -u$username cl_general -p > cl_general_blank.sql 
####if unix plugin , as root 
####mysqldump  -d cl_general > cl_general_blank.sql 

tnames='examination profile report sample_id_strategy dashboard super_profile
	copy_bin_text view_info_data prototype prototype_data host_code lab_reference_value
	dementia equipment equipment_record_type record_tables table_field_specification
	reagent reagent_name unit_name cal_equipment reagent_use menu_new'

#####if root password
mysqldump  -u$username cl_general $tnames -p > "cl_general_data.sql"
#####if unix plugin , as root 
#mysqldump  cl_general $tnames > "cl_general_data.sql"

git add *
git commit -a
git push https://github.com/nishishailesh/cl_general
