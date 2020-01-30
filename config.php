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
$GLOBALS['max_non_ex_profile']=20;
$GLOBALS['released_by']=1014;
$GLOBALS['pid_profile']=1;

$GLOBALS['advice']='
		<ul>
				<LI><h6 class="bg-danger d-inline">Copy and Paste relevent part from here to advice box</h6></LI>
				<LI><h6 class="bg-warning d-inline">Click Paste-bin button again to close this</h6></LI>
                <li>Target Cells</li>
                <li>Polychromatic</li>
                <li>Microcytic</li>
        </ul>
';

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
?>
