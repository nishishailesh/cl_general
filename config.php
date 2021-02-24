<?php
$GLOBALS['main_user_location']='/var/gmcs_config/staff.conf';
$GLOBALS['user_database']='cl_general';
$GLOBALS['user_table']='user';
$GLOBALS['user_id']='user';
$GLOBALS['user_pass']='password';
$GLOBALS['expiry_period']='+ 6 months';
$GLOBALS['expirydate_field']='expirydate';
$GLOBALS['application_name']='New Civil Hospital Surat Laboratory Services';

$GLOBALS['database']='cl_general';
$GLOBALS['mrd']=1001;
$GLOBALS['sample_requirement']=1000;

$GLOBALS['patient_name']=1002;
$GLOBALS['released_by']=1014;
$GLOBALS['OPD/Ward']=1006;
$GLOBALS['interim_released_by']=1019;

$GLOBALS['email']=1024;
// in /var/gmcs_config/staff.conf $GLOBALS['email_db_server']='11.207.1.1';

$GLOBALS['pid_profile']=1;

$GLOBALS['print_side_or_below']=100;
$GLOBALS['max_non_ex_profile']=20;


//$GLOBALS['ser']='BIOCHEMISTRY'; in /var/gmcs_config

$GLOBALS['HI']=array('name'=>'New Civil Hospital Surat Laboratory Services',
						'section'=>'Hematology and Immunology Section',
						'address'=>'OPD-10, NCHS, Surat',
						'phone'=>'0261 2244456 Ext. 424,425,426'
						);

$GLOBALS['CP']=array('name'=>'New Civil Hospital Surat Laboratory Services',
						'section'=>'Clinical Pathology Section',
						'address'=>'OPD-10, NCHS, Surat',
						'phone'=>'0261 2244456 Ext. 424,425,426'
						);
						
$GLOBALS['BI']=array('name'=>'New Civil Hospital Surat Laboratory Services',
						'section'=>'Biochemistry Section',
						'address'=>'Beside Blood Bank, 2nd Floor, NCHS, Surat',
						'phone'=>'0261 2244456 Ext. 317,366'
						);

$GLOBALS['HP']=array('name'=>'New Civil Hospital Surat Laboratory Services',
						'section'=>'Histopathology Section',
						'address'=>'3nd Floor, GMC, Surat',
						'phone'=>'0261 2244456 Ext. 317,366'
						);
$GLOBALS['MI']=array('name'=>'New Civil Hospital Surat Laboratory Services',
                                                'section'=>'VRDL Microbiology Section',
                                                'address'=>'3nd Floor, GMC, Surat',
                                                'phone'=>' '
                                                );

$GLOBALS['normal_qc_str']='QC/5/';
$GLOBALS['abnormal_qc_str']='QC/8/';
$GLOBALS['normal_qc_tick']='N';
$GLOBALS['abnormal_qc_tick']='A';


$GLOBALS['critical_autoinsert']='yes';	# 'yes' to enable, anything else to disable
$GLOBALS['absurd_low_message']='<--Absurd Low';
$GLOBALS['absurd_high_message']='<--Absurd High';
$GLOBALS['critical_low_message']='<--Critical Low';
$GLOBALS['critical_high_message']='<--Critical High';
$GLOBALS['abnormal_low_message']='<--Abnormal Low';
$GLOBALS['abnormal_high_message']='<--Abnormal High';


#for TAT
$GLOBALS['collection_date']=1015;
$GLOBALS['collection_time']=1016;

$GLOBALS['receipt_date']=1017;
$GLOBALS['receipt_time']=1018;


#for records
$GLOBALS['record_tables']='record_tables';
$GLOBALS['ongoing_acceptibility_record_type_id']=3;

#for STE
$GLOBALS['all_records_limit']=100;

#main menu reminder
#to ensure that if table donot exist, menu donot get broken
$GLOBALS['reminders_table']='reminders';

//20200531233109 date format for XL ASTM communication
//08/01/2020 14:02:40 date format for XL export communication

//example configutation file for passwords
/*
<?php
$GLOBALS['main_user']='for main database access';
$GLOBALS['main_pass']='xyz';
$GLOBALS['main_server_main_user']='to access distant server';
$GLOBALS['main_server_main_pass']='xyz';

$GLOBALS['email_user']='to access email-db server';
$GLOBALS['email_pass']='xyz';
$GLOBALS['email_db_server']='ip address where email database and exim4 is running for SMARTHOST';
?>

*/

?>
