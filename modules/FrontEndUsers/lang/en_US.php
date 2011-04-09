<?php
$lang['postuninstall'] = 'All data associated with the FrontEndUsers module has been deleted';
$lang['info_ecomm_paidregistration'] = 'If enabled, this module will listen to events from the Ecommerce suite.  The following settings only have effect if this setting is enabled.';
$lang['prompt_ecomm_paidregistration'] = 'Listen to Order Events';
$lang['info_paidreg_settings'] = 'The following settings only apply if using self registration and allowing for paid registration';
$lang['none'] = 'None';
$lang['delete_user'] = 'Delete User';
$lang['expire_user'] = 'Expire User';
$lang['prompt_action_ordercancelled'] = 'Action to perform when a subscription order is cancelled';
$lang['prompt_action_orderdeleted'] = 'Action to perform when a subscription order is deleted';
$lang['ecommerce_settings'] = 'Ecommerce Settings';
$lang['securefieldmarker'] = 'Secure Field Marker';
$lang['securefieldcolor'] = 'Secure Field Color';
$lang['prompt_encrypt'] = 'Store this data encrypted in the database';
$lang['error_notsupported'] = 'The chosen option is not supported given your current configuration';
$lang['audit_user_created'] = 'User automatically created';
$lang['info_auto_create_unknown'] = 'If a user is authenticated by an external authentication module but is not known in the FrontEndUsers module should an FEU account be created automatically?';
$lang['prompt_auto_create_unknown'] = 'Automatically Create Unknown Users';
$lang['display_settings'] = 'Display Settings';
$lang['info_std_auth_settings'] = 'The following settings are only applicable if using the &quot;Builtin Authentication&quot;.';
$lang['info_support_lostun'] = 'Selecting No will disable the ability for a user to request lost login information, irrespective of other settings';
$lang['info_support_lostpw'] = 'Selecting No will disable the ability for a user to a password reset, irrespective of other settings';
$lang['prompt_support_lostun'] = 'Allow users to request their username';
$lang['prompt_support_lostpw'] = 'Allow users to request a password change';
$lang['auth_settings'] = 'Authentication Settings';
$lang['authentication'] = 'Builtin Authentication';
$lang['auth_builtin'] = 'FEU Standard Authentication';
$lang['auth_module'] = 'Authentication Module/Method';
$lang['info_auth_module'] = 'The FrontendUsers module supports using alternate authentication methods, with varying capabilities.  Some functionality will not function or be disabled when not using the built in authentication method';
$lang['error_user_nonunique_field_value'] = 'The value specified for %s is already in use by another user';
$lang['unique'] = 'Unique';
$lang['error_nonunique_field_value'] = 'The value specified for %s (%s) is not unique';
$lang['prompt_force_unique'] = 'Force values of this property to be unique across all user accounts';
$lang['help_returnlast'] = 'Used with the login and logout forms, this parameter if specified will indicate that the user should be returned to the page (by url) that the user was viewing before the action occurred.  This parameter will override the redirect preferences, and the returnto parameter.';
$lang['help_noinline'] = 'Used with one of the forms, this parameter specifies that the forms should not be placed inline, instead the resulting output after form submission will replace the default content block';
$lang['title_reset_session'] = 'Login Session Timeout Warning';
$lang['msg_reset_session'] = 'Your login session is about to expire, please click "&quot;Ok&quot; to confirm your activity on this website.';
$lang['ok'] = 'Ok';
$lang['resetsession_template'] = 'Reset Session Template';
$lang['info_name'] = 'This is the field name, to be used for addressing in smarty.  It must consist of only alphanumeric characters and underscores.';
$lang['visitors_tab'] = 'Visitors';
$lang['feu_groups_prompt'] = 'Select one or more FEU groups that are allowed to view this page';
$lang['error_mustselect_group'] = 'A group must be selected';
$lang['selectone'] = 'Select One';
$lang['start_year'] = 'Start Year';
$lang['end_year'] = 'End Year';
$lang['date'] = 'Date';
$lang['prompt_thumbnail_size'] = 'Thumbnail Size';
$lang['OnUpdateGroup'] = 'On User Group Modified';
$lang['error_toomanyselected'] = 'Too many users are selected for bulk operations.... Please trim it to 250 or less';
$lang['confirm_delete_selected'] = 'Are you sure you want to delete the selected users?';
$lang['delete_selected'] = 'Delete Selected';
$lang['prompt_randomusername'] = 'Generate random username when adding new users';
$lang['months'] = 'months';
$lang['prompt_expireage'] = 'Default user expiry period';
$lang['notification_settings'] = 'Notification Settings';
$lang['property_settings'] = 'Property Settings';
$lang['redirection_settings'] = 'Redirection Settings';
$lang['general_settings'] = 'General Settings';
$lang['session_settings'] = 'Session and Cookie Settings';
$lang['field_settings'] = 'Field Settings';
$lang['error_lostun_nonrequired'] = 'The lostusername flag can only be used on required fields';
$lang['prop_textarea_wysiwyg'] = 'Allow use of wysiwyg on this text area';
$lang['info_cookiestoremember'] = '<strong>Note: </strong> This uses the mcrypt functions for encryption purposes, and they could not be detected on your install.   Please contact your server administrator.';
$lang['editing_user'] = 'Editing User';
$lang['noinline'] = 'Do not inline forms';
$lang['info_lostun'] = 'Click here if you cannot remember your login details';
$lang['info_forgotpw'] = 'Click here if you cannot remember your password';
$lang['info_logout'] = 'Click here to sign out';
$lang['info_changesettings'] = 'Click here to adjust your password or other information';
$lang['viewuser_template'] = 'View User Template';
$lang['event'] = 'Event';
$lang['feu_event_notification'] = 'FEU Event Notification';
$lang['prompt_notification_address'] = 'Notification Email Address';
$lang['prompt_notification_template'] = 'Notification Email Template';
$lang['prompt_notification_subject'] = 'Notification Email Subject';
$lang['prompt_notifications'] = 'Email Notifications';
$lang['OnLogin'] = 'On Login';
$lang['OnLogout'] = 'On Logout';
$lang['OnExpireUser'] = 'On Session Expiry';
$lang['OnCreateUser'] = 'On New User Created';
$lang['OnDeleteUser'] = 'On User Deleted';
$lang['OnUpdateUser'] = 'On User Settings Changed';
$lang['OnCreateGroup'] = 'On User Group Created';
$lang['OnDeleteGroup'] = 'On User Group Deleted';

$lang['lostunconfirm_premsg'] = 'The lost login details functionality has successfully completed.  We have found a unique username that matches the details you entered.';
$lang['your_username_is'] = 'Your username is';
$lang['lostunconfirm_postmsg'] = 'We recommend you record this information in a secure, but retrievable location.';
$lang['prompt_after_change_settings'] = 'PageID/Alias to jump to after change settings';
$lang['prompt_after_verify_code'] = 'PageID/Alias to jump to after code verification *';
$lang['lostun_details_template'] = 'Lost Username Details Template';
$lang['lostun_confirm_template'] = 'Lost Username Confirm Template';
$lang['error_nonuniquematch'] = 'Error: More than one user account matched the properties specified';
$lang['error_cantfinduser'] = 'Error: Could not find a matching user';
$lang['error_groupnotfound'] = 'Error: Could not find a group by that name';
$lang['readonly'] = 'Read Only';
$lang['prompt_usermanipulator'] = 'User Manipulator Class';
$lang['admin_logout'] = 'Logged out by administrator';
$lang['prompt_loggedinonly'] = 'Show Only Logged In Users';
$lang['prompt_logout'] = 'Logout this user';
$lang['user_properties'] = 'User Properties';
$lang['userhistory'] = 'User History';
$lang['export'] = 'Export';
$lang['clear'] = 'Clear';
$lang['prompt_exportuserhistory'] = 'Export User History To ASCII that is at least';
$lang['prompt_clearuserhistory'] = 'Clear User History records that is at least';
$lang['title_lostusername'] = 'Forgot Your Login Details?';
$lang['title_rssexport'] = 'Export group definition (and properties) to XML';
$lang['title_userhistorymaintenance'] = 'User History Maintenance';
$lang['yes'] = 'Yes';
$lang['no'] = 'No';
$lang['prompt_of'] = 'Of';
$lang['date_allrecords'] = '** No Limit **';
$lang['date_onehourold'] = 'One Hour Old';
$lang['date_sixhourold'] = 'Six Hours Old';
$lang['date_twelvehourold'] = 'Twelve Hours Old';
$lang['date_onedayold'] = 'One Day Old';
$lang['date_oneweekold'] = 'One Week Old';
$lang['date_twoweeksold'] = 'Two weeks Old';
$lang['date_onemonthold'] = 'One Month Old';
$lang['date_threemonthsold'] = 'Three Months Old';
$lang['date_sixmonthsold'] = 'Six Months Old';
$lang['date_oneyearold'] = 'One Year Old';
$lang['title_groupsort'] = 'Grouping and Sorting';
$lang['prompt_recordsfound'] = 'Records matching the criteria';
$lang['sortorder_username_desc'] = 'Descending Username';
$lang['sortorder_username_asc'] = 'Ascending Username';
$lang['sortorder_date_desc'] = 'Descending Date';
$lang['sortorder_date_asc'] = 'Ascending Date';
$lang['sortorder_action_desc'] = 'Descending Event Type';
$lang['sortorder_action_asc'] = 'Ascending Event Type';
$lang['sortorder_ipaddress_desc'] = 'Descending Ip Address';
$lang['sortorder_ipaddress_asc'] = 'Ascending Ip Address';
$lang['info_nohistorydetected'] = 'No History Detected';
$lang['reset'] = 'Reset';
$lang['prompt_group_ip'] = 'Group By IP Address';
$lang['prompt_filter_eventtype'] = 'Event Type Filter';
$lang['prompt_filter_date'] = 'Display only events that are less than:';
$lang['prompt_pagelimit'] = 'Page Limit';
$lang['for'] = 'for';
$lang['title_userhistory'] = 'User History Report';
$lang['unknown'] = 'Unknown';
$lang['prompt_ipaddress'] = 'IP Address';
$lang['prompt_eventtype'] = 'Event Type';
$lang['prompt_date'] = 'Date';
$lang['prompt_return'] = 'Return';
$lang['import_complete_msg'] = 'Import Operation Complete';
$lang['prompt_linesprocessed'] = 'Lines Processed';
$lang['prompt_errors'] = 'Errors Encountered';
$lang['prompt_recordsadded'] = 'Records Added';
$lang['error_nogroupproprelns'] = 'Could not find properties for group %s';
$lang['error_noresponsefromserver'] = 'Could not get a response from the SMTP server';
$lang['error_importfilenotfound'] = 'File specified (%s) could not be found';
$lang['error_importfieldvalue'] = 'Invalid value for dropdown or multiselect field %s';
$lang['error_importfieldlength'] = 'Field %s exceeds maximum length';
$lang['error_importusers'] = 'Import Error (line %s): %s';
$lang['error_propertydefns'] = 'Could not get the property definitions (internal error)';
$lang['error_problemsettinginfo'] = 'Problem setting user info';
$lang['error_importrequiredfield'] = 'Could not find a column to match the required field %s';
$lang['error_nogroupproperties'] = 'Could not find properties for the specified group';
$lang['error_importfileformat'] = 'The file specified for import is not in the correct format';
$lang['error_couldnotopenfile'] = 'Could not open file';
$lang['info_importusersfileformat'] = '
<h4>File Format Information</h4>
<p>The input file must be in ASCII format using comma separated values.  Each line in this input file (with the exception of the header line, discussed below) represents one user record.  The order of the fields in each line must be identical.</p>
<h5>Header line</h5>
<ul>
<li>The first line of the file must begin with two pound (\#) characters, and names each of the fields in the file.  The names of these fields is significant.  There are some required field names (see below), and other field names must match the property names associated with the group users are going to be added into.</li>
<li>The import process will fail if the fields in the input file does not match all of the required properties associated with the group that users are being added into</li>
<li>The input file may contain fields representing some of the optional properties in the specified group.</li>
<li>The import process will ignore any fields in the input file that are either not known, or map to properties that are <em>off</em> in the specified user group.</li>
</ul>
<h5>Columnar Data</h5>
<ul>
<li>The <strong>userid</strong> Field - The userid for the user. A value in this field will indicate you are doing an update.</li>
<li>The <strong>username</strong> Field - The desired username.
    <p>This field must exist in the headerline, and in each and every line of the input file. The record will fail if a user with that username already exists in the database.</p></li>
<li>The <strong>password</strong> Field - The password to set for the user</li>
<li>The <strong>createdate</strong> Field - todo</li>
<li>The <strong>expires</strong> Field - todo</li>
<li>The <strong>groupname</strong> Field - The groups that you want to have the user be a member of. If all required fields are not filled in the insert/update of the record will fail. See Multiselect Fields below for syntax.</li>
<li>Dropdown/Radio Fields
    <p>The value of dropdown properties in an import file is represented as the string that is shown in the dropdown control in the FrontEndUsers module.</p>
</li>
<li>Multiselect Fields
    <p>Multiselect fields are contained within the ASCII file as a : separated list of strings, where each string represents the text shown in the multiselect list</p>
</li>
<li>Date Fields
    <p>Must be in the format of MM-DD-YYYY</p>
</li>
<li>Image Fields
    <p>Image are fields who\'s column name matches a property of type Image.  If this field is a required part of the destination group, then the name specified in these columns must exist in the uploads disrectory of the CMS installation.  If the image does not exist, and the field is required, then the record will fail.</p></li>
</ul>
<h5>Notes</h5>
<p>The import process is subject to the limitations imposed by the host provider, such as memory limitations, processing time, file size upload, and safe mode restrictions.  Any one of these limitations may cause the import to fail. Therefore it is advisable to ensure that import files are smaller in size, and simpler in nature.</p>
<p>Though every effort has been made to ensure that database corruption will not occur, it is advisable to perform a database backup before doing a user import.</p>
<p>The Export data is in the same format as needed for import.</p>
<h5>Example</h5>
<pre>
##username,first_name,last_name,email,city,state,country,zip
user1,test,user,user1@somedomain.com,somewhere,TX,US,12345
</pre>
';
$lang['prompt_importdestgroup'] = 'Import Users Into This Group';
$lang['prompt_importfilename'] = 'Input CSV File';
$lang['prompt_importxmlfile'] = 'Input XML File';
$lang['prompt_exportusers'] = 'Export Users';
$lang['prompt_importusers'] = 'Import Users';
$lang['prompt_clear'] = 'Clear';
$lang['prompt_image_destination_path'] = 'Image Destination Path';
$lang['error_missing_upload'] = 'A problem occurred with a missing (but required) upload';
$lang['error_bad_xml'] = 'Could not parse the provided XML file';
$lang['error_notemptygroup'] = 'Cannot delete a group that still has users';
$lang['error_norepeatedlogins'] = 'This user is already logged in';
$lang['error_captchamismatch'] = 'The text from the image was not entered correctly';
$lang['prompt_allow_repeated_logins'] = 'Allow users to login more than once';
$lang['prompt_allowed_image_extensions'] = 'Image File Extensions that Users allowed to upload';
$lang['event_help_OnDeleteUser'] = '
<h3>OnDeleteUser<h3>
<p>An event generated when a user is deleted</p>
<h4>Parameters</h4>
<ul>
<li><em>username</em> - The user name</li>
<li><em>id</em> - The user id</li>
<li><em>props</em> - A hash filled with the properties of the user</li>
</ul> 
';
$lang['event_help_OnCreateUser'] = '
<h3>OnCreateUser<h3>
<p>An event generated when a user is created</p>
<h4>Parameters</h4>
<ul>
<li><em>name</em> - The user name</li>
<li><em>id</em> - The user id</li>
</ul> 
';
$lang['event_help_OnUpdateUser'] = '
<h3>OnUpdateUser<h3>
<p>An event generated when a user is updated (either by user themself or admin)</p>
<h4>Parameters</h4>
<ul>
<li><em>name</em> - The user name</li>
<li><em>id</em> - The user id</li>
</ul> 
';
$lang['event_help_OnCreateGroup'] = '
<h3>OnCreateGroup<h3>
<p>An event generated when a group is created</p>
<h4>Parameters</h4>
<ul>
<li><em>name</em> - The group name</li>
<li><em>description</em> - The group description</li>
<li><em>id</em> - The group id</li>
</ul> 
';
$lang['event_help_OnDeleteGroup'] = '
<h3>OnDeleteGroup<h3>
<p>An event generated when a group is deleted</p>
<h4>Parameters</h4>
<ul>
<li><em>name</em> - The group name</li>
<li><em>id</em> - The group id</li>
</ul> 
';
$lang['event_help_OnLogin'] = '
<h3>OnLogin<h3>
<p>An event generated when a user logs in</p>
<h4>Parameters</h4>
<ul>
<li><em>id</em> - The id of the logged in user</li>
<li><em>username</em> - The name of the logged in user</li>
<li><em>ip</em> - The ip address of the client</li>
</ul>
'; 
$lang['event_help_OnLogout'] = '
<p>An event generated when a user logs out</p>
<h4>Parameters</h4>
<ul>
<li><em>username</em> - The name of the loggedout user</li>
<li><em>id</em> - The user id</li>
</ul>
'; 
$lang['event_help_OnExpireUser'] = '
<p>An event generated when a user session expires</p>
<h4>Parameters</h4>
<ul>
<li><em>username</em> - The name of the expired user</li>
<li><em>id</em> - The user id of the expired user</li>
</ul>
'; 
$lang['event_info_OnLogin'] = 'An event generated when a user logs in to the system';
$lang['event_info_OnLogout'] = 'An event generated when a user logs out of the system';
$lang['event_info_OnExpireUser'] = 'An event generated when a user session is expired';
$lang['event_info_OnCreateUser'] = 'An event generated when a new user is created';
$lang['event_info_OnUpdateUser'] = 'An event generated when a user info is updated';
$lang['event_info_OnDeleteUser'] = 'An event generated when a user account is deleted';
$lang['event_info_OnCreateGroup'] = 'An event generated when a user group is created';
$lang['event_info_OnUpdateGroup'] = 'An event generated when a user group is updated';
$lang['event_info_OnDeleteGroup'] = 'An event generated when a user group is deleted';
$lang['backend_group'] = 'Backend Group';
$lang['info_star'] = '* The following fields are full smarty templates.<br/>Along with other pre-existing smarty variables and plugins, the {$username} and {$group} variables are availabie.  <em>(The {$group} variable matches the first group to which the user belongs.)</em>.';
$lang['info_admin_password'] = 'Edit this field to reset the users password';
$lang['info_admin_repeatpassword'] = 'Edit this field to reset the users password';
$lang['error_username_exists'] = 'A user with that username already exists';
$lang['nocsvresults'] = 'No results returned from csv export';
$lang['prompt_unfldlen'] = 'Length of username field';
$lang['prompt_pwfldlen'] = 'Length of password field';
$lang['error_invalidpasswordlengths'] = 'Min/Max password lengths are invalid';
$lang['error_invalidusernamelengths'] = 'Min/Max username lengths are invalid';
$lang['error_invalidemailaddress'] = 'Invalid Email address';
$lang['error_noemailaddress'] = 'We could not find an email address for this account';
$lang['error_problemseettinginfo'] = 'Problem setting user info';
$lang['error_settingproperty'] = 'Problem setting property';
$lang['user_added'] = 'User Added %s = %s';
$lang['user_deleted'] = 'User Deleted uid=%s';
$lang['propertyfilter'] = 'Property';
$lang['valueregex'] = 'Value (regular expression)';
$lang['warning_effectsfieldlength'] = 'Warning: These fields affect the size of input fields for forms.  Decreasing this number on an existing site may not be advisable';
$lang['confirm_submitprefs'] = 'Are you sure you want to adjust the module preferences?';
$lang['error_emailalreadyused'] = 'Email address already used';
$lang['prompt_usecookiestoremember'] = 'Use cookies to remember login details';
$lang['prompt_cookiename'] = 'The name of the cookie';
$lang['prompt_allow_duplicate_emails'] = 'Allow duplicate emails';
$lang['prompt_username_is_email'] = 'Email address is username';
$lang['info_cookie_keepalive'] = 'Attempt to keep logins alive by the use of a cookie <em>(the cookie is reset on activity in the website)</em>';
$lang['info_allow_duplicate_emails'] = '(Allow multiple users with the same email address)';
$lang['info_username_is_email'] = '(user\'s email address is their username -- don\'t set this with "allow duplicate email addresses"!)';
$lang['prompt_allow_duplicate_reminders'] = 'Allow duplicate "forgot password" reminders?';
$lang['info_allow_duplicate_reminders'] = '(Allow a users to request a password reset, even if they haven\'t acted on a previous one)';
$lang['prompt_feusers_specific_permissions'] = 'Use Front-end User specific permissions?';
$lang['info_feusers_specific_permissions'] = '(Normally, FEUSers permissions are the same as the equivalent Admin Area permissions like Add User, Add Group, etc. If you select this option, there will be separate permissions for FEUsers.)';
$lang['error_missingupload'] = 'Could not find the uploaded file (internal error)';
$lang['error_problem_upload'] = 'There was a problem with your uploaded file.  Please try again';
$lang['error_missingusername'] = 'You did not enter a username';
$lang['error_missingemail'] = 'You did not enter your email';
$lang['error_missingpassword'] = 'You did not enter a password';
$lang['frontenduser_logout'] = 'Frontend User Logout';
$lang['frontenduser_loggedin'] = 'Frontend User Login';
$lang['editprop_infomsg'] = '<font color="red"><b>USE CAUTION</b> when changing existing properties that are assigned to groups, you may potentially cause damage and break an existing site <i>(especially if you reduce field lengths, etc)</i></font>';
$lang['info_smtpvalidate'] = 'This function does not work on windows';
$lang['msg_dontcreateusername'] = 'Do not create a property for username, or password as these properties are builtin to the FrontEndUsers module';
$lang['prompt_exportcsv'] = 'Export Users to CSV';
$lang['exportcsv'] = 'Export';
$lang['importcsv'] = 'Import';
$lang['admin'] = 'Admin';
$lang['editprop'] = 'Edit Property: <em>%s</em>';
$lang['maxlength'] = 'Maximum Length';
$lang['created'] = 'Created';
$lang['sortby'] = 'Sort By';
$lang['sort'] = 'Sorting';
$lang['usersingroup'] = 'Users in the selected group(s)';
$lang['userlimit'] = 'Limit results to';
$lang['error_noemailfield'] = 'Could not find an email field for this user.  You may need to contact the system administrator';
$lang['prompt_forgotpw_page'] = 'PageID/Alias for Forgot Password form';
$lang['prompt_changesettings_page'] = 'PageID/Alias for Change Settings form';
$lang['prompt_login_page'] = 'PageID/Alias to jump to after login *';
$lang['prompt_logout_page'] = 'PageID/Alias to jump to after logout *';
$lang['sortorder'] = 'Sort order';
$lang['prompt_numresetrecord'] = 'A number of users are in the middle of resetting lost passwords.  Currently this count is at:';
$lang['remove1week'] = 'Remove all entries more than a week old';
$lang['remove1month'] = 'Remove all entries more than a month old';
$lang['removeall'] = 'Remove all entries';
$lang['areyousure'] = 'Are you sure?'; 
$lang['error_invalidcode'] = 'An invalid code has been entered, please try again';
$lang['error_tempcodenotfound'] = 'A temporary code for your user id could not be found in the database';
$lang['forgotpassword_verifytemplate'] = 'Template used to display verification form';
$lang['forgotpassword_emailtemplate'] = 'Template used for forgotten password email'; 
$lang['error_resetalreadysent'] = 'Either yourself or someone else has already triggered a password reset operation for this account.  Check your email, you may have further instructions on how to reset your password in your inbox';
$lang['error_dberror'] = 'Database error';
$lang['message_forgotpwemail'] = 'You are receiving this message because somebody told our site that you had lost your password.  If this is the case, read the instructions below.  If you don\'t have a clue what this is, then you are safe to delete this message, and we thank you for your time.';
$lang['prompt_code'] = 'Code';
$lang['message_code'] = 'The following code has been generated randomly generated in order to verify the user account.  when you click on the link below you will be presented with a field to enter this code.  Normally the field is pre-completed for you, but incase it isn\'t the code is:';
$lang['prompt_link'] = 'Clicking on the following link will take you to the website where you can enter the above code, and reset your password:';
$lang['lostpassword_emailsubject'] = 'Lost Password';
$lang['error_nomailermodule'] = 'Could not find the CMSMailer module';
$lang['info_forgotpwmessagesent'] = 'An email has been sent to %s with instructions as to how to reset your password.  Thank you';
$lang['lostpw_message'] = 'So you forgot or lost your password. Well, type your username in here, and if we can find you we will send you an email with instructions on how to reset it';
$lang['forgotpassword_template'] = 'Forgot Password Templates';
$lang['lostusername_template'] = 'Lost Username Template';
$lang['error_propnotfound'] = 'Property %s not found';
$lang['propsfound'] = 'Properties found';
$lang['addprop'] = 'Add Property';
$lang['error_requiredfield'] = 'A required field (%s) was empty';
$lang['info_emptypasswordfield'] = 'Enter a new password here to change your password';
$lang['error_notloggedin'] = 'You do not appear to be logged in';
$lang['user_settings'] = 'Settings';
$lang['user_registration'] = 'Registration';
$lang['error_accountexpired'] = 'This account has expired';
$lang['error_improperemailformat'] = 'Improper email address formatting';
$lang['error_invalidexpirydate'] = 'Invalid expiry date.  This may be system related.  Try setting an earlier year.';
$lang['error_problemsettingproperty'] = 'Error setting property %s for user $s';
$lang['error_invalidgroupid'] = 'Invalid group id %s';
$lang['sortorder'] = 'Sort order';
$lang['hiddenfieldmarker'] = 'Hidden field marker';
$lang['hiddenfieldcolor'] = 'Hidden field color';
$lang['hidden'] = 'Hidden';
$lang['error_duplicatename'] = 'A property with that name is already defined';
$lang['error_noproperties'] = 'No properties defined';
$lang['error_norelations'] = 'No properties were selected for this group';
$lang['nogroups'] = 'No Groups are defined';
$lang['groupsfound'] = 'Groups found';
$lang['error_onegrouprequired'] = 'Membership in at least one group is required';
$lang['prompt_requireonegroup'] = 'Require membership in atleast one group';
$lang['back'] = 'Back';
$lang['error_missing_required_param'] = '%s is a required field';
$lang['requiredfieldmarker'] = 'Mark required fields with';
$lang['requiredfieldcolor'] = 'Hilite required fields in';
$lang['next'] = 'Next';
$lang['error_groupexists'] = 'A Group with that name already exists';
$lang['required'] = 'Required';
$lang['optional'] = 'Optional';
$lang['off'] = 'Off';
$lang['size'] = 'Size';
$lang['sizecomment'] = '<br/>(Maximum size of any one dimension of the image in pixels)';
$lang['length'] = 'Length';
$lang['lengthcomment'] = '<br>(chars in the text input)';
$lang['seloptions'] = 'Dropdown options, separated by line breaks.  Values can be separated from text with a = character. i.e: Female=f';
$lang['radiooptions'] = 'Radiobutton labels, separated by line breaks. Values can be separated from text with a = character. i.e: Female=f';
$lang['yes'] = 'Yes';
$lang['prompt'] = 'Prompt';
$lang['prompt_type'] = 'Type';
$lang['type'] = 'Type';
$lang['required'] = 'Required';
$lang['fieldstatus'] = 'Field Status';
$lang['usedinlostun'] = 'Ask in Lost<br/>Username';
$lang['text'] = 'Text';
$lang['checkbox'] = 'Checkbox';
$lang['multiselect'] = 'Multi Select List';
$lang['radiobuttons'] = 'Radio Buttons';
$lang['image'] = 'Image';
$lang['email'] = 'Email';
$lang['textarea'] = 'Textarea';
$lang['dropdown'] = 'Dropdown';
$lang['msg_currentlyloggedinas'] = 'Welcome';
$lang['logout'] = 'Sign out';
$lang['prompt_newgroupname'] = 'Use this group name';
$lang['prompt_changesettings'] = 'Change My Settings';
$lang['error_loginfailed'] = 'Login failed - Invalid username or password?';
$lang['login'] = 'Sign in';
$lang['prompt_signin_button'] = 'Sign in button label';
$lang['prompt_username'] = 'Username';
$lang['prompt_email'] = 'Email Address';
$lang['prompt_password'] = 'Password';
$lang['prompt_rememberme'] = 'Remember me on this computer';
$lang['register'] = 'Register';
$lang['forgotpw'] = 'Forgot Your Password?';
$lang['lostusername'] = 'Forgot Your Login Details?';
$lang['defaults'] = 'Defaults';
$lang['template'] = 'Template';
$lang['error_usernotfound'] = 'User ID not found';
$lang['error_usernametaken'] = 'That username (%s) is already in use';
$lang['prompt_smtpvalidate'] = 'Use SMTP to validate email addresses?';
$lang['prompt_minpwlen'] = 'Minimum Password Length';
$lang['prompt_maxpwlen'] = 'Maximum Password Length';
$lang['prompt_minunlen'] = 'Minimum Username Length';
$lang['prompt_maxunlen'] = 'Maximum Username Length';
$lang['prompt_sessiontimeout'] = 'Session Timeout (seconds)';
$lang['prompt_cookiekeepalive'] = 'Use cookies to keep logins alive';
$lang['prompt_allowemailreg'] = 'Allow Email Registration';
$lang['prompt_dfltgroup'] = 'Default Group for new users';
$lang['changesettings_template'] = 'Change Settings Template';
$lang['error_passwordmismatch'] = 'Passwords Do not match';
$lang['error_invalidusername'] = 'Invalid Username';
$lang['error_invalidpassword'] = 'Invalid Password';
$lang['error_usernotfound'] = 'Could not find information for this user';
$lang['edituser'] = 'Edit User';
$lang['valid'] = 'Valid';
$lang['username'] = 'Username';
$lang['status'] = 'Status';
$lang['error_membergroups'] = 'This user is not a member of any groups';
$lang['error_properties'] = 'No Properties';
$lang['error_dup_properties'] = 'Attempt to import duplicate properties';
$lang['value'] = 'Value';
$lang['groups'] = 'Groups';
$lang['properties'] = 'Properties';
$lang['propname'] = 'Property Name';
$lang['propvalue'] = 'Property Value';
$lang['add'] = 'Add';
$lang['history'] = 'History';
$lang['edit'] = 'Edit';
$lang['expires'] = 'Expires';
$lang['specify_date'] = 'Specify Date';
$lang['12hrs'] = '12 Hours';
$lang['24hrs'] = '24 Hours';
$lang['48hrs'] = '48 Hours';
$lang['1week'] = '1 Week';
$lang['2weeks'] = '2 Weeks';
$lang['1month'] = '1 Month';
$lang['3months'] = '3 Months';
$lang['6months'] = '6 Months';
$lang['1year'] = '1 Year';
$lang['never'] = 'Never';
$lang['postinstallmessage'] = 'Module installed sucessfully.<br/>Be sure to set the "Modify FrontEndUser Properties permission.  Additionally, we recommend that you install the Captcha module.  If installed, validation of a captcha image will be required in addition to the username and password to login.  This is intended to prevent brute force attacks.  <strong>Note:</strong> The nocaptcha parameter can be used to disable this functionality even if the Captcha module is installed."';
$lang['email'] = 'Email Address';
$lang['password'] = 'Password';
$lang['repeatpassword'] = 'Again';
$lang['error_groupname_exists'] = 'Group by that name already exists';
$lang['editgroup'] = 'Edit Group';
$lang['submit'] = 'Submit';
$lang['cancel'] = 'Cancel';
$lang['delete'] = 'Delete';
$lang['confirm_editgroup'] = 'Are you sure this is the proper settings for this group?\nTurning a property off will not delete any entries in the properties table for this group/user.  They will merely be unavailable.';
$lang['areyousure_deletegroup'] = 'Are you sure you want to delete this group?';
$lang['confirm_delete_prop'] = 'Are you sure you want to completely delete this property?\nDoing so will also erase any user entries for this property.';
$lang['error_insufficientparams'] = 'Insufficient Parameters';
$lang['id'] = 'Id';
$lang['username'] = 'Username';
$lang['name'] = 'Name';
$lang['error_cantaddprop'] = 'Problem adding property';
$lang['error_cantaddgroupreln'] = 'Problem adding group relation';
$lang['error_cantaddgroup'] = 'Problem adding group';
$lang['error_cantassignuser'] = 'Problem adding a user to a group';
$lang['error_couldnotdeleteproperty'] = 'Problem deleting a property';
$lang['error_couldnotfindemail'] = 'Could not find an email address';
$lang['error_destinationnotwritable'] = 'No write permission to destination directory';
$lang['error_invalidparams'] = 'Invalid Parameters';
$lang['error_nogroups'] = 'Could not find any groups';
$lang['applyfilter'] = 'Apply';
$lang['filter'] = 'Filter';
$lang['userfilter'] = 'Username Regular Expression';
$lang['description'] = 'Description';
$lang['name'] = 'Name';
$lang['groupname'] = 'Group Name';
$lang['accessdenied'] = 'Access Denied';
$lang['error'] = 'Error';
$lang['addgroup'] = 'Add Group';
$lang['importgroup'] = 'Import Group';
$lang['adduser'] = 'Add User';
$lang['groupsfound'] = 'Groups Found';
$lang['usersfound'] = 'Users found that match the criteria';
$lang['group'] = 'Group';
$lang['selectgroup'] = 'Select Group';
$lang['registration_template'] = 'Registration Template';
$lang['logout_template'] = 'Logout Template';
$lang['login_template'] = 'Login Template';
$lang['preferences'] = 'Preferences';
$lang['groups'] = 'Groups';
$lang['users'] = "Users";
$lang['friendlyname'] = 'Frontend User Management';
$lang['moddescription'] = 'Allow users to log in to the frontend of your site';
$lang['defaultfrontpage'] = "Default front page";
$lang['lastaccessedpage'] = 'Last accessed page';
$lang['otherpage'] = 'Other page: ';
$lang['captcha_title'] = 'Enter the text from the image';
$lang['help'] = <<<EOF
<h3>What Does This Do?</h3>
<p>This module allows management and administration of front end users <i>(users who have no admin accesss)</i>.  It allows creation of user groups, and user accounts and allows users to login and logout.  it can be used in conjunction with the CustomContent module to display different content to different users once they have logged in</p>
<h3>Features</h3>
<ul>
<li><p>User account expiration.  You can create temporary users</p></li>
<li><p>Group Properties.  You can ask for different information from members of different groups</p></li>
<li><p>Capable of handling hundreds of users</p></li>
<li><p>Forgot password, and forgot username functionality.... allows users to set a new password, and/or to recover their username if they completely forgot login details.</p></li>
<li><p>Has an extensive API for adding functionality</p></li>
</ul>
<h3>How do I use it</h3>
<ul>
<li><p>After installation you can access admin panel to the FrontEndUsers module under the &quot;Users & gGroups&quot; menu.</p></li>
<li>
<p>Secondly, you need to define at least one property.  Properties are essentially field definitions, here you specify the type of information you want to gather, and limits. i.e:  Name, Age, City, State, Country, etc.</p>
<p><b>Note:</b> You do not need to define properties for username (or email address) and password, these will be provided for you</b>
<p><b>Note:</b> New installations of the FEU module specify that the users email address is their username (this option can be changed in the preferences tab).  So if using this option you will not need to create an email address property.</p>
</li>
<li><p>Next you must create one or more user groups.  When you create a group, you are asked for a group name, a description and to associate properties with that group, specify the properties sort order, and wether it is an optional, required, or hidden field <i>(off is also valid)</i></p></li>
<li><p><b>Note:</b> Before proceeding, you should ensure that the preferences are set correctly.</p></li>
<li><p>Thirdly you should create some users.  Adding users is a two step process.  When creating a user you are asked for the username/email and password, and an expiry date for that user.  You then must select the groups that that user is a member of, and click \'Next\'</p>
<p><em>Note: </em>This is a labour intensive and boring process, it is easier to let users register themselves <em>(See the SelfRegistration Module)</em>, and then you can edit their group information.  but for testing purposes, please create at lest one user</p></li>
<li><p>Lastly, after the system has determined all of the information fields to be presented for that user, you are presented with a form asking for all of the required user information.  Complete this form to complete the user addition</p></li>
<li><p>You are now ready to add the front end functionality to your site.  This is as simple as adding the {cms_module module=FrontEndUsers} tag to your page or template</p></li>
</ul>
<h3>Smarty Functions</h3>
<p>Some limited interaction with the FrontEndUsers module database is possible with smarty and the \$feu_smarty object.</p>
<h4>Functions:</h4>
<ul>
<li><strong><code>{\$feu_smarty-&gt;get_users_by_groupname(\$groupname,\$assign)}</code></strong>
<p>This function can be used to extract an array of usernames and userids for all users that belong to the specified group.  The output is assigned to a smarty variable specified in the &quot;assign&quot; parameter.</p>
<p>Example:<br/><code>{\$feu_smarty-&gt;get_users_by_groupname('members','mymembers')}<br/>{\$mymembers|@print_r}</code></p>
</li>
<li><strong><code>{\$feu_smarty-&gt;get_user_properties(\$uid,\$assign)}</code></strong>
<p>This function can be used to extract a list of properties for the specified user and assign them to a smarty variable with the specified name.</p>
<p>Example:<br/><code>{\$feu_smarty-&gt;get_user_properties(5,'userprops')}<br/>{\$userprops|@print_r}</code></p>
</li>

<li><strong><code>{\$feu_smarty-&gt;get_dropdown_text(\$propname,\$propvalue[,\$assign])}</code></strong>
<p>This smarty function returns the text specified for a particular option value for a specified dropdown property.</li>
<p>Example:<br/><code>{\$feu_smarty-&gt;get_dropdown_text('age_range',\$onepropvalue)}</code></p>
</li>

<li><strong><code>{\$feu_smarty-&gt;get_multiselect_text(\$propname,\$propvalue,\$assign)}</code></strong>
<p>This smarty function returns an array of option texts corresponding to a comma separated list of option values.</li>
<p>Example:<br/><code>{\$feu_smarty-&gt;get_multiselect_text('favorite_foods',\$onepropvalue,'favorite_foods')}<br/>{\$favorite_foods|@print_r}</code></p>
</li>

<li><strong>code>{\$feu_smarty-&gt;get_user_expiry(\$uid[,\$assign])}</code></strong>
<p>This smarty method returns the unix timestamp that the specified uid account expires.  The function will return false if the uid cannot be found or some other error occurred.</p>
<p>Example:<br/><code>{\$feu_smarty-&gt;get_user_expiry(25,'expiry')}<br/>{\$expiry|cms_date_format}</code></p>
</li>

<li><strong>code>{\$feu_smarty-&gt;user_expired(\$uid[,\$assign])}</code></strong>
<p>This smarty method returns a boolean indicating wether the specified user account has expired.  The method will also return false if the uid cannot be found or some other error occurred.</p>
<p>Example:<br/><code>{\$feu_smarty-&gt;user_expired(25,'expired')}<br/>{if \$expired}UID 25 can no longer login to the system{/if}</code></p>
</li>
</ul>

<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module, FAQs, or to file a Bug Report or buy commercial support, please visit calguy\'s
module homepage at <a href="http://calguy1000.com">calguy1000.com</a>.</li>
<li>Additional discussion of this module may also be found in the <a href="http://forum.cmsmadesimple.org">CMS Made Simple Forums</a>.</li>
<li>The author, calguy1000, can often be found in the <a href="irc://irc.freenode.net/#cms">CMS IRC Channel</a>.</li>
<li>Lastly, you may have some success emailing the author directly.</li>  
</ul>
<h3>Parameters</h3>
<ul>
<li><em>(optional)</em> action="default"<li>
<p>Actions:
<ul>
<li><em>default</em> - The default action, which enables the normal form= behaviour.</li>
<li><em>reset_session</em> - Provide a javascript controlled template to allow the manual, or automatic pinging of the user session.  This template can be used to remind the user that his login session is about to expire, and to trigger its reset.  Normally this method is not required as any page that displays the FrontEndUser controls would handle this, just requiring the user to view a page on a regular basis.  However, if there are pages with alot of content requiring extensive reading, this may be a useful solution.</li>
<li><em>viewuser</em> - Display a report for a single user, requires use of the uid parameter.</li>
</ul>
</p>
<li><em>(optional)</em> form="name"</li>
<p>Forms:
<ul>
 <li><em>login</em> - Display the login form</li>
 <li><em>logout</em> - Display the logout form</li>
 <li><em>changesettings</em> - Display the change settings form</li>
 <li><em>forgotpw</em> - Display the forgot password form</li>
 <li><em>lostusername</em> - Display the lost username form.</li>
<li><em>silent</em> = Display nothing, but export properties and other smarty variables for the currently logged in user.  If no user is logged in, then no variables are exported.</li>
</ul>
</p>
<li><em>(optional)</em> returnto="page"</li>
<p>Used with the login, logout, and changesettings forms, this parameter contains the page id or alias of a page to redirect to, when the form has been successfully completed</p>
<li><em>(optional)</em> only_groups="group1, group2, group3"</li>
<p>Used with the login forms.  Basically only allows users to login if they belong to that particular group(s).</p>
<li><em>(optional)</em> lostun_group="group"</li>
<p>Used with the lostusername form, this feature specifies the frontend user group to assume tht users are members of.</p>
<li><em>(optional)</em> nocaptcha="1"</li>
<p>Used with the login forms. his will disnable captcha on the form. By default, if the Captcha module is installed, validation of a captcha image will be required for login.  This is a security measure intented to prevent brute force attacks.</p>
<li><em>(optional)</em> uid=null</li>
<p>Used with the viewuser action.  This parameter is required to specify which user to view the details of.</p>
</ul>
<p>As per the GPL, this software is provided as-is. Please read the text
of the license for the full disclaimer.</p>
<h3>Requirements</h3>
<p>In order to implement the forgotten password functionality, this module requires the CMSMailer module to be previously installed and properly configured.</p>
<h3>Copyright and License</h3>
<p>Copyright &copy; 2008, Robert Campbel <a href="mailto:calguy1000@cmsmadesimple.org">&lt;calguy1000@cmsmadesimple.org&gt;</a>. All Rights Are Reserved.</p>
<p>This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.</p>
<p>However, as a special exception to the GPL, this software is distributed
as an addon module to CMS Made Simple.  You may not use this software
in any Non GPL version of CMS Made simple, or in any version of CMS
Made simple that does not indicate clearly and obviously in its admin 
section that the site was built with CMS Made simple.</p>
<p>This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
Or read it <a href="http://www.gnu.org/licenses/licenses.html#GPL">online</a></p>
<h3>Sponsors</h3>
<p>There have been many sponsors for this module, some of these are listed below:</p>
<ul.>
 <li><a href="http://www.matterhornmarketing.com">Matterhorn Marketing</a></li>
 <li><a href="http://www.bpti.eu">Balkan Institute of Advanced Technology</a></li>
</ul>
EOF;
?>
