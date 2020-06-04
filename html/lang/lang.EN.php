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

/* Failed login */
$lang['Ip_address'] = "Adresse IP";

/* react formulaire */
$lang['react'] = "React";
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



///////////////support/Reacts///////////////
$lang['reacts_title1'] = "Overview of reacts (react to events)";
$lang['reacts_text1a'] = "Respond when a channel's data meets certain conditions";
$lang['reacts_text1b'] = "Reacts work with ThingHTTP applications, to perform actions when the data of a channel meets a certain condition.
                          You can configure a react to notify an event by SMS or Mail.
                          For example, when the weight of a hive suddenly drops, ask ThingHTTP to send an SMS containing a description of the event.";
$lang['reacts_title2'] = "Read archived reacts";
$lang['reacts_text2a'] = "Choose Reacts in the user menu to display the table of archived reacts.";
$lang['reacts_text2b'] = "For each of the reacts the following information is displayed.";
$lang['reacts_text2c'] = "The login of the owner user";
$lang['reacts_text2d'] = "The name of the react";
$lang['reacts_text2e'] = "The designation of the channel to be checked";
$lang['reacts_text2f'] = "The logical condition for triggering the action. This condition is made up of three parts :";
$lang['reacts_text2g'] = "A canal field";
$lang['reacts_text2h'] = "A digital comparison operator";
$lang['reacts_text2i'] = "A numerical value";
$lang['reacts_text2j'] = "The designation of the thingHtttp application (this application triggers the service requested via an http request)";
$lang['reacts_title3'] = "Delete Reacts";
$lang['reacts_text3a'] = "You can delete one or more archived Reacts. Check the Reacts to delete then click on the Delete button. A confirmation window opens.
                          Validate the action";
$lang['reacts_title4'] = "Edit a React";
$lang['reacts_text4a'] = "Check the react to modify then click on the setting button. A form opens.";


//------------Text sur le coté du Formulaire---------------//
$lang['react_aide'] = "<h3>Reacts Settings</h3>
<ul>
	<li>React Name: Enter a unique name for your React.</li>
	<li>Test Frequency: Choose whether to test your condition every time data enters the channel or on a periodic basis.</li>
	<li>Condition: Select a channel, a field and the condition for your React.</li>
	<li>Action: Select ThingHTTP, Send a SMS, Send a email to run when the condition is met.</li>
	<li>Options: Select when the React runs.</li>
</ul>";

 ?>