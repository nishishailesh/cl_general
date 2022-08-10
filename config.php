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



// in /var/gmcs_config/staff.conf $GLOBALS['email_db_server']='11.207.1.1';


////Important examination IDs
$GLOBALS['mrd']=1001;
$GLOBALS['sample_requirement']=1000;
$GLOBALS['patient_name']=1002;
$GLOBALS['OPD/Ward']=1006;
$GLOBALS['email']=1024;
$GLOBALS['sms_date']=1043;
$GLOBALS['sms_time']=1044;


//for checking function integrity
$GLOBALS['plasma_glucose']=5031;
$GLOBALS['serum_TBIL']=5009;
$GLOBALS['serum_DBIL']=5010;
$GLOBALS['serum_IBIL']=5024;

$GLOBALS['serum_CHOL']=5015;
$GLOBALS['serum_TG']=5018;
$GLOBALS['serum_HDL']=5016;
$GLOBALS['serum_VLDL']=5017;
$GLOBALS['serum_LDL']=5028;

$GLOBALS['Remark']=5098;
$GLOBALS['Critical_Alert']=5097;


$GLOBALS['pid_profile']=1;

$GLOBALS['print_side_or_below']=100;
$GLOBALS['max_non_ex_profile']=20;

$GLOBALS['ser']='XYZ LAb';

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

$GLOBALS['.']=array('name'=>'New Civil Hospital Surat',
                                                'section'=>'Radiology',
                                                'address'=>'NCH Campus, Surat',
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


#for Sample Status

$GLOBALS['request_date']=1027;
$GLOBALS['request_time']=1028; 
 
$GLOBALS['collection_date']=1015;
$GLOBALS['collection_time']=1016; 

$GLOBALS['receipt_date']=1017;
$GLOBALS['receipt_time']=1018;

$GLOBALS['sample_preparation_date']=1029;
$GLOBALS['sample_preparation_time']=1030; 

$GLOBALS['analysis_date']=1031;
$GLOBALS['analysis_time']=1032;

$GLOBALS['verification_date']=1033;
$GLOBALS['verification_time']=1034;

$GLOBALS['release_date']=1035;
$GLOBALS['release_time']=1036;
$GLOBALS['released_by']=1014;

$GLOBALS['interim_release_date']=1037;
$GLOBALS['interim_release_time']=1038;
$GLOBALS['interim_released_by']=1019;

#for records
$GLOBALS['record_tables']='record_tables';
$GLOBALS['ongoing_acceptibility_record_type_id']=3;

#for STE
$GLOBALS['all_records_limit']=100;

#main menu reminder
#to ensure that if table donot exist, menu donot get broken
$GLOBALS['reminders_table']='reminders';

$GLOBALS['TAT_warn_hours']=4;
$GLOBALS['TAT_remark_id']=5191;
$GLOBALS['QC_Remark_id']=5098;


$GLOBALS['sample_status']=
array(
		['sample_requested',[$GLOBALS['request_date'],$GLOBALS['request_time']],'white',['date','time'],'hide'],
		['sample_collected',[$GLOBALS['collection_date'],$GLOBALS['collection_time']],'lightgray',['date','time'],'show'],
		['sample_received',[$GLOBALS['receipt_date'],$GLOBALS['receipt_time']],'yellow',['date','time'],'show'],
		['sample_prepared',[$GLOBALS['sample_preparation_date'],$GLOBALS['sample_preparation_time']],'orange',['date','time'],'show'],
		['analysis_started',[$GLOBALS['analysis_date'],$GLOBALS['analysis_time']],'lightpink',['date','time'],'show'],
		['verification_done',[$GLOBALS['verification_date'],$GLOBALS['verification_time']],'lightblue',['date','time'],'hide'],
		['interim_report_released',[$GLOBALS['interim_release_date'],$GLOBALS['interim_release_time']],'greenyellow',['date','time'],'hide'],		
		['interim_report_released',[$GLOBALS['interim_released_by']],'greenyellow',['username'],'hide'],
		['report_released',[$GLOBALS['release_date'],$GLOBALS['release_time']],'lightgreen',['date','time'],'hide'],		
		['report_released',[$GLOBALS['released_by']],'lightgreen',['username'],'hide']
	);

$GLOBALS['is_verification_success_important']='yes';

//$GLOBALS['state_colorcode']=array('white','lightgray','yellow','orange','lightpink','lightblue','lightgreen','lightgreen','lightgreen');

$GLOBALS['eq_color_code']=array('C'=>'lightpink','I'=>'red','A'=>'cyan','D'=>'#00F5E0','6'=>'violet','K'=>'#6699ff','E'=>'mediumvioletred','U'=>'#FFA500');



////Accreditation symbol
$GLOBALS['display_accreditation_image']="yes";
$GLOBALS['accreditation_image_src']="img/nabl.png";
$GLOBALS['accreditation_image_txt']="ML-0450";
$GLOBALS['qr_link_prefix']='https://gmcsurat.edu.in:12349/cl_general/';
$GLOBALS['unaccredited_string']='(Not in NABL Scope)';





//example configutation file for passwords  
//see above: $GLOBALS['main_user_location']='/var/gmcs_config/staff.conf';
/*
<?php
$GLOBALS['main_user']='for main database access';
$GLOBALS['main_pass']='xyz';
$ser='Dept Label';
$GLOBALS['main_server_main_user']='to access distant server';
$GLOBALS['main_server_main_pass']='xyz';

$GLOBALS['email_user']='to access email-db server';
$GLOBALS['email_pass']='xyz';
$GLOBALS['email_db_server']='ip address where email database and exim4 is running for SMARTHOST';

$GLOBALS['sms_site']    ='complate address link';
$GLOBALS['sms_UserID']  ='user';
$GLOBALS['sms_UserPass']='pass';
$GLOBALS['sms_GSMID']   ='GSMID';

$GLOBALS['_telegram_chatid_']='chat ID';
$GLOBALS['_telegram_token_']='bot token';

?>
*/

?>
