<?php

$lang = array();

/* DataTables */
$lang['dataTables'] = "lang/dataTable.English.json";

/* Buttons */
$lang['add'] = "Add";
$lang['edit_settings'] = "Settings";
$lang['delete'] = "Delete";
$lang['Cancel'] = "Cancel";
$lang['Apply'] = "Apply";
$lang['Validate'] = "Valider";
$lang['close'] = "Close";
$lang['display'] = "Display";

/* index & Menu*/
$lang['Sign_in'] = "Sign in";
$lang['User login'] = "User login";
$lang['Password'] = "Password";
$lang['Users'] = "Users";
$lang['Browse_Sites'] = "Browse Sites";
$lang['Things'] = "Things";
$lang['Channels'] = "Channels";
$lang['ThingHTTPs'] = "ThingHTTPs";
$lang['Reacts'] = "Reacts";
$lang['Sign_Out'] = "Sign Out";
$lang['My_Account'] = "My Account";
$lang['docs_page'] = "Aggregator Docs for this page";
$lang['Data_visualisation'] = "Data visualisation";
$lang['Data_Analysis'] = "Data Analysis";

/* thingView */
$lang['graphic'] = "Graphic";
$lang['hide_all'] = "Hide All";
$lang['More_Historical_Data'] = "More Historical Data";
$lang['setting filter'] = "Setting filter";
$lang['simple_moving_average'] = "Simple Moving Average";
$lang['exponential_moving_average'] = "Exponential Moving Average";
$lang['period'] = "Period";

/* Users */
$lang['Change_Password'] = "Change Password";
$lang['Change_Time_Zone'] = "Change Time Zone";
$lang['New_API_Key'] = "New API Key";
$lang['Suspending'] = "Suspending";
$lang['Failed_login'] = "Failed login";
$lang['Failed_logins'] = "Failed Logins";

$lang['Users'] = "Users";
$lang['Users_suspending'] = "Users suspending";
$lang['API_Key'] = "API_Key";
$lang['login'] = "Login";
$lang['Time_Zone'] = "Time Zone";
$lang['last_sign_in'] = "Last Sign In";
$lang['count'] = "Count";

/* things */
$lang['things'] = "Things";
$lang['access'] = "Access";
$lang['tag'] = "Tag";
$lang['author'] = "Author";
$lang['Ip_address'] = "IP Address";

/* channels */
$lang['channel'] = "Channel";
$lang['write_API_Key'] = "Write API Key";
$lang['last_write_entry'] = "Date last entry";
$lang['last_entry_id'] = "Nb of values";
$lang['generate_New_API_Key'] = "Generate New API Key";
$lang['view_last_values'] = "View last values";
$lang['download_CSV'] = "Download CSV";
$lang['clear_all_feed'] = "Clear all feed"; 

/* thingHTTPs */
$lang['created'] = "Created";
$lang['method'] = "Method";
$lang['send']    = "Send";

/* SMS */
$lang['read'] = "Read";
$lang['write'] = "Write";
$lang['date_of_issue'] = "Date of issue";
$lang['date_of_receipt'] = "Date of receipt";
$lang['to'] = "To";
$lang['from'] = "From";
$lang['sent'] = "Sent";
$lang['received'] = "Received";

/* Reacts */
$lang['user'] = "User";
$lang['name'] = "Name";
$lang['channel_to_check'] = "Channel to check";
$lang['Choose_your_channel'] = "Choose your channel";
$lang['field'] = "Field to check";
$lang['Choose_your_field'] = "Choose your field";
$lang['condition'] = "Condition";
$lang['action'] = "Action perform";
$lang['Has_not_been_updated_for'] = "Has not been updated for";

/* webcam */
$lang['download_picture'] = "Download picture";

/* react formulaire */
$lang['select_react_type'] = array('0'=>'Run action only the first time the condition is met',
                                   '1'=>'Run action each time condition is met');
								   
$lang['select_channel_id'] = "Choose a Channel";

$lang['select_actionable_type'] = array('' => 'Choose your action', 
                                        'thingHTTP' => "ThingHTTP",
										'email' => "Send a email" );
										
$lang['select_interval'] = array('on_insertion' => "On data insertion",
                         '10' =>"Every 10 minutes",
                         '30' =>"Every 30 minutes",
                         '60' =>"Every 60 minutes" );

$lang['select_condition'] = array(	'gt' => 'is greater than',
                                    'gte' => 'is greater or equal to',
                                    'lt' => 'is less than',
                                    'lte' => 'is less than or equal',
                                    'eq' =>  'is equal to',
                                    'neq' => 'is not equal' );

$lang['select_react_type'] = array('0'=>'Run action only the first time the condition is met',
                                  '1' =>'Run action each time condition is met');

//------------Text sur le coté du Formulaire React---------------//
$lang['react_aide'] = "<h3>Reacts Settings</h3>
<ul>
	<li>React Name: Enter a unique name for your React.</li>
	<li>Test Frequency: Choose whether to test your condition every time data enters the channel or on a periodic basis.</li>
	<li>Condition: Select a channel, a field and the condition for your React.</li>
	<li>Action: Select ThingHTTP, Send a SMS, Send a email to run when the condition is met.</li>
	<li>Options: Select when the React runs.</li>
</ul>";

 ?>