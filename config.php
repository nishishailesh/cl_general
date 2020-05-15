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
