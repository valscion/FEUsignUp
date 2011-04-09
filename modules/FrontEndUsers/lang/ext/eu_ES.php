<?php
$lang['readonly'] = 'Irakurtzeko soilik';
$lang['prompt_usermanipulator'] = 'User Manipulator Class';
$lang['admin_loggout'] = 'Administratzaileak saiotik bota du';
$lang['prompt_loggedinonly'] = 'Saioa hasita duten erabiltzaileak erakutsi';
$lang['prompt_logout'] = 'Erabiltzailea saiotik atera';
$lang['user_properties'] = 'Erabiltzailearen Propietateak';
$lang['userhistory'] = 'Erabiltzailearen Historiala';
$lang['export'] = 'Exportatu';
$lang['clear'] = 'Garbitu';
$lang['prompt_exportuserhistory'] = 'Exportatu Erabiltzaile Historiala ASCII formatura';
$lang['prompt_clearuserhistory'] = 'Garbitu Erabiltzaile Historialaren erregistroak';
$lang['title_userhistorymaintenance'] = 'Erabiltzaile Historialaren Mantenua';
$lang['yes'] = 'Bai';
$lang['no'] = 'Ez';
$lang['prompt_of'] = 'Of';
$lang['date_allrecords'] = '** Mugarik gabe **';
$lang['date_onehourold'] = 'Ordubetekoa';
$lang['date_sixhourold'] = 'Sei ordutakoa';
$lang['date_twelvehourold'] = 'Hamabi ordutakoa';
$lang['date_onedayold'] = 'Egun batekoa';
$lang['date_oneweekold'] = 'Astebetekoa';
$lang['date_twoweeksold'] = 'Bi Astetakoa';
$lang['date_onemonthold'] = 'Hilabetekoa';
$lang['date_threemonthsold'] = 'Hiru Hilabetetakoa';
$lang['date_sixmonthsold'] = 'Sei Hilabetetakoa';
$lang['date_oneyearold'] = 'Urtebetakoa';
$lang['title_groupsort'] = 'Taldekaketa eta Sailkaketa';
$lang['prompt_recordsfound'] = 'Bilaketa-irizpidea betetzen duten erregistroak';
$lang['sortorder_username_desc'] = 'Erabiltzaile-izena beheranzka';
$lang['sortorder_username_asc'] = 'Erabiltzaile-izena goranzka';
$lang['sortorder_date_desc'] = 'Data beheranzka';
$lang['sortorder_date_asc'] = 'Data goranzka';
$lang['sortorder_action_desc'] = 'Gertaera-mota beheranzka';
$lang['sortorder_action_asc'] = 'Gertaera-mota goranzka';
$lang['sortorder_ipaddress_desc'] = 'IP helbidea beheranzka';
$lang['sortorder_ipaddress_asc'] = 'IP helbidea goranzka';
$lang['info_nohistorydetected'] = 'Ez da Historialik topatu';
$lang['reset'] = 'Berrezarri';
$lang['prompt_group_ip'] = 'IP helbidearen arabera Taldekatu';
$lang['prompt_filter_eventtype'] = 'Gertaera-mota iragazkia';
$lang['prompt_filter_date'] = 'Hau baino gutxiago diren gertaerak bakarrik erakutsi:';
$lang['prompt_pagelimit'] = 'Orrialde-muga';
$lang['for'] = 'for';
$lang['title_userhistory'] = 'Erabiltzaile Historialaren Txostena';
$lang['unknown'] = 'Ezezaguna';
$lang['prompt_ipaddress'] = 'IP Helbidea';
$lang['prompt_eventtype'] = 'Gertaera-mota';
$lang['prompt_date'] = 'Data';
$lang['prompt_return'] = 'Itzuli';
$lang['import_complete_msg'] = 'Inportasio-eragiketa Amaituta';
$lang['prompt_linesprocessed'] = 'Prozesaturiko lerroak';
$lang['prompt_errors'] = 'Erroreak aurkitu dira';
$lang['prompt_recordsadded'] = 'Erregistruak gehituta';
$lang['error_noresponsefromserver'] = 'Ezin izan da SMTP zerbitzaritik erantzunik jaso';
$lang['error_importfilenotfound'] = 'Ezin izan da adierazitako fitxategia (%s) topatu';
$lang['error_importfieldvalue'] = 'Invalid value for dropdown or multiselect field %s';
$lang['error_importfieldlength'] = 'Field %s exceeds maximum length';
$lang['error_importusers'] = 'Import Error (line %s): %s';
$lang['error_propertydefns'] = 'Could not get the property definitions (internal error)';
$lang['error_importrequiredfield'] = 'Could not find a column to match the required field %s';
$lang['error_nogroupproperties'] = 'Could not find properties for the specified group';
$lang['error_importfileformat'] = 'The file specified for import is not in the correct format';
$lang['error_couldnotopenfile'] = 'Could not open file';
$lang['info_importusersfileformat'] = '<h4>File Format Information</h4>
<p>The input file must be in ASCII format using comma separated values.  Each line in this input file (with the exception of the header line, discussed below) represents one user record.  Each line must contain the same number of fields, and the order of the fields in each line must be identical.</p>
<h5>Header line</h5>
<ul>
<li>The first line of the file must begin with two pound (\#) characters, and names each of the fields in the file.  The names of these fields is significant.  There are some required field names (see below), and other field names must match the property names associated with the group users are going to be added into.</li>
<li>The import process will fail if the fields in the input file does not match all of the required properties associated with the group that users are being added into</li>
<li>The input file may contain fields representing some of the optional properties in the specified group.</li>
<li>The import process will ignore any fields in the input file that are either not known, or map to properties that are <em>off</em> in the specified user group.</li>
</ul>
<h5>Columnar Data</h5>
<ul>
<li>The <strong>username</strong> Field - The desired username.
    <p>This field must exist in the headerline, and in eacn and every line of the input file. The record will fail if a user with that username already exists in the database.</p></li>
<li>The <strong>password</strong> Field - Todo</li>
<li>The <strong>expires</strong> Field - Todo</li>
<li>Dropdown Fields
    <p>The value of dropdown properties in an import file is represented as the string that is shown in the dropdown control in the FrontEndUsers module.</p>
</li>
<li>Multiselect Fields
    <p>Multiselect fields are contained within the ASCII file as a : separated list of strings, where each string represents the text shown in the multiselect list</p>
</li>
<li>Image Fields
    <p>Image are fields who&#039;s column name matches a property of type Image.  If this field is a required part of the destination group, then the name specified in these columns must exist in the uploads disrectory of the CMS installation.  If the image does not exist, and the field is required, then the record will fail.</p>
</ul>
<h5>Notes</h5>
<p>The import process is subject to the limitations imposed by the host provider, such as memory limitations, processing time, file size upload, and safe mode restrictions.  Any one of these limitations may cause the import to fail. Therefore it is advisable to ensure that import files are smaller in size, and simpler in nature.</p>
<p>Though every effort has been made to ensure that database corruption will not occur, it is advisable to perform a database backup before doing a user import.</p>
<h5>Example</h5>
<pre>
##username,first_name,last_name,email,city,state,country,zip
user1,test,user,user1@somedomain.com,somewhere,TX,US,12345
</pre>
';
$lang['prompt_importdestgroup'] = 'Import Users Into This Group';
$lang['prompt_importfilename'] = 'Input CSV File';
$lang['prompt_exportusers'] = 'Export Users';
$lang['prompt_importusers'] = 'Import Users';
$lang['prompt_clear'] = 'Clear';
$lang['prompt_image_destination_path'] = 'Image Destination Path';
$lang['error_missing_upload'] = 'A problem occurred with a missing (but required) upload';
$lang['error_notemptygroup'] = 'Cannot delete a group that still has users';
$lang['error_norepeatedlogins'] = 'This user is already logged in';
$lang['error_captchamismatch'] = 'The text from the image was not entered correctly';
$lang['prompt_allow_repeated_logins'] = 'Allow users to login more than once';
$lang['prompt_allowed_image_extensions'] = 'Image File Extensions that Users allowed to upload';
$lang['event_help_OnDeleteUser'] = '<h3>OnDeleteUser<h3>
<p>An event generated when a user is deleted</p>
<h4>Parameters</h4>
<ul>
<li><em>username</em> - The user name</li>
<li><em>id</em> - The user id</li>
</ul> 
';
$lang['event_help_OnCreateUser'] = '<h3>OnCreateUser<h3>
<p>An event generated when a user is created</p>
<h4>Parameters</h4>
<ul>
<li><em>name</em> - The user name</li>
<li><em>id</em> - The user id</li>
</ul> 
';
$lang['event_help_OnUpdateUser'] = '<h3>OnUpdateUser<h3>
<p>An event generated when a user is updated (either by user themself or admin)</p>
<h4>Parameters</h4>
<ul>
<li><em>name</em> - The user name</li>
<li><em>id</em> - The user id</li>
</ul> 
';
$lang['event_help_OnCreateGroup'] = '<h3>OnCreateGroup<h3>
<p>An event generated when a group is created</p>
<h4>Parameters</h4>
<ul>
<li><em>name</em> - The group name</li>
<li><em>description</em> - The group description</li>
<li><em>id</em> - The group id</li>
</ul> 
';
$lang['event_help_OnDeleteGroup'] = '<h3>OnDeleteGroup<h3>
<p>An event generated when a group is deleted</p>
<h4>Parameters</h4>
<ul>
<li><em>name</em> - The group name</li>
<li><em>id</em> - The group id</li>
</ul> 
';
$lang['event_help_OnLogin'] = '<h3>OnLogin<h3>
<p>An event generated when a user logs in</p>
<h4>Parameters</h4>
<ul>
<li><em>username</em> - The name of the logged in user</li>
<li><em>ip</em> - The ip address of the client</li>
</ul>
';
$lang['event_help_OnLogout'] = '<p>An event generated when a user logs out</p>
<h4>Parameters</h4>
<ul>
<li><em>username</em> - The name of the loggedout user</li>
<li><em>id</em> - The user id</li>
</ul>
';
$lang['event_help_OnExpireUser'] = '<p>An event generated when a user session expires</p>
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
$lang['event_info_OnDeleteGroup'] = 'An event generated when a user group is deleted';
$lang['backend_group'] = 'Backend Group';
$lang['info_star'] = '* The following macros can be used in these fields: {$username},{$group}. When using the {$group} macro, the system will subsitute the name of the first member group that the user belongs to, and will redirect to that page.';
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
$lang['prompt_allow_duplicate_emails'] = 'Allow duplicate emails';
$lang['info_allow_duplicate_emails'] = '(allow multiple users with the same email address)';
$lang['prompt_allow_duplicate_reminders'] = 'Allow duplicate &quot;forgot password&quot; reminders?';
$lang['info_allow_duplicate_reminders'] = '(allow a users to request a password reset, even if they haven&#039;t acted on a previous one)';
$lang['prompt_feusers_specific_permissions'] = 'Use Front-end User specific permissions?';
$lang['info_feusers_specific_permissions'] = '(Normally, FEUSers permissions are the same as the equivalent Admin Area permissions like Add User, Add Group, etc. If you select this option, there will be separate permissions for FEUsers.)';
$lang['error_missingupload'] = 'Could not find the uploaded file (internal error)';
$lang['error_missingusername'] = 'You did not enter a username';
$lang['error_missingpassword'] = 'You did not enter a password';
$lang['frontenduser_logout'] = 'Frontend User Logout';
$lang['frontenduser_loggedin'] = 'Frontend User Login';
$lang['editprop_infomsg'] = '<font color=&quot;red&quot;><b>USE CAUTION</b> when changing existing properties that are assigned to groups, you may potentially cause damage and break an existing site <i>(especially if you reduce field lengths, etc)</i></font>';
$lang['info_smtpvalidate'] = 'This function does not work on windows';
$lang['msg_dontcreateusername'] = 'Do not create a property for username, or password as these properties are builtin to the FrontEndUsers module';
$lang['prompt_exportcsv'] = 'Export Users to CSV';
$lang['exportcsv'] = 'Export';
$lang['importcsv'] = 'Import';
$lang['admin'] = 'Admin';
$lang['editprop'] = 'Edit Property';
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
$lang['message_forgotpwemail'] = 'You are receiving this message because somebody told our site that you had lost your password.  If this is the case, read the instructions below.  If you don&#039;t have a clue what this is, then you are safe to delete this message, and we thank you for your time.';
$lang['prompt_code'] = 'Code';
$lang['message_code'] = 'The following code has been generated randomly generated in order to verify the user account.  when you click on the link below you will be presented with a field to enter this code.  Normally the field is pre-completed for you, but incase it isn&#039;t the code is:';
$lang['prompt_link'] = 'Clicking on the following link will take you to the website where you can enter the above code, and reset your password:';
$lang['lostpassword_emailsubject'] = 'Lost Password';
$lang['error_nomailermodule'] = 'Could not find the CMSMailer module';
$lang['info_forgotpwmessagesent'] = 'An email has been sent to %s with instructions as to how to reset your password.  Thank you';
$lang['lostpw_message'] = 'So you forgot or lost your password. Well, type your username in here, and if we can find you we will send you an email with instructions on how to reset it';
$lang['forgotpassword_template'] = 'Forgot Password Templates';
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
$lang['error_invalidexpirydate'] = 'Invalid expiry date';
$lang['error_problemsettingproperty'] = 'Error setting property %s for user $s';
$lang['error_invalidgroupid'] = 'Invalid group id %s';
$lang['hiddenfieldmarker'] = 'Hidden field marker';
$lang['hiddenfieldcolor'] = 'Hidden field color';
$lang['hidden'] = 'Hidden';
$lang['error_duplicatename'] = 'A property with that name is already defined';
$lang['error_noproperties'] = 'No properties defined';
$lang['error_norelations'] = 'No properties were selected for this group';
$lang['nogroups'] = 'No Groups are defined';
$lang['groupsfound'] = 'Groups Found';
$lang['error_onegrouprequired'] = 'Membership in at least one group is required';
$lang['prompt_requireonegroup'] = 'Require membership in atleast one group';
$lang['back'] = 'Back';
$lang['error_missing_required_param'] = '%s is a required field';
$lang['requiredfieldmarker'] = 'Mark required fields with';
$lang['requiredfieldcolor'] = 'Hilite required fields in';
$lang['next'] = 'Next';
$lang['error_groupexists'] = 'A Group with that name already exists';
$lang['required'] = 'Required Field';
$lang['optional'] = 'Optional';
$lang['off'] = 'Off';
$lang['size'] = 'Size';
$lang['sizecomment'] = '<br/>(Maximum size of any one dimension of the image in pixels)';
$lang['length'] = 'Length';
$lang['lengthcomment'] = '<br>(chars in the text input)';
$lang['seloptions'] = 'Dropdown options, separated by line breaks.  Values can be separated from text with a = character. i.e: Female=f';
$lang['prompt'] = 'Prompt';
$lang['prompt_type'] = 'Type';
$lang['type'] = 'Type';
$lang['text'] = 'Text';
$lang['checkbox'] = 'Checkbox';
$lang['multiselect'] = 'Multi Select List';
$lang['image'] = 'Image';
$lang['email'] = 'Email Address';
$lang['textarea'] = 'Textarea';
$lang['dropdown'] = 'Dropdown';
$lang['msg_currentlyloggedinas'] = 'Welcome';
$lang['logout'] = 'Sign out';
$lang['prompt_changesettings'] = 'Change My Settings';
$lang['error_loginfailed'] = 'Login failed - Invalid username or password?';
$lang['login'] = 'Sign in';
$lang['prompt_signin_button'] = 'Sign in button label';
$lang['prompt_username'] = 'Username';
$lang['prompt_password'] = 'Password';
$lang['register'] = 'Register';
$lang['forgotpw'] = 'Forgot Your Password?';
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
$lang['edituser'] = 'Edit User';
$lang['valid'] = 'Valid';
$lang['username'] = 'Username';
$lang['status'] = 'Status';
$lang['error_membergroups'] = 'This user is not a member of any groups';
$lang['error_properties'] = 'No Properties';
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
$lang['postinstallmessage'] = 'Module installed sucessfully.<br/>Be sure to set the &quot;Modify FrontEndUser Properties permission.  Additionally, we recommend that you install the Captcha module.  If installed, validation of a captcha image will be required in addition to the username and password to login.  This is intended to prevent brute force attacks.  <strong>Note:</strong> The nocaptcha parameter can be used to disable this functionality even if the Captcha module is installed.&quot;';
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
$lang['name'] = 'Name';
$lang['error_cantaddgorup'] = 'Problem adding group';
$lang['error_invalidparams'] = 'Invalid Parameters';
$lang['applyfilter'] = 'Apply';
$lang['filter'] = 'Filter';
$lang['userfilter'] = 'Username Regular Expression';
$lang['description'] = 'Description';
$lang['groupname'] = 'Group Name';
$lang['accessdenied'] = 'Access Denied';
$lang['error'] = 'Error';
$lang['addgroup'] = 'Add Group';
$lang['adduser'] = 'Add User';
$lang['usersfound'] = 'Users found that match the criteria';
$lang['group'] = 'Group';
$lang['selectgroup'] = 'Select Group';
$lang['registration_template'] = 'Registration Template';
$lang['logout_template'] = 'Logout Template';
$lang['login_template'] = 'Login Template';
$lang['preferences'] = 'Preferences';
$lang['users'] = 'Users';
$lang['friendlyname'] = 'Frontend User Management';
$lang['moddescription'] = 'Allow users to log in to the frontend of your site';
$lang['defaultfrontpage'] = 'Default front page';
$lang['lastaccessedpage'] = 'Last accessed page';
$lang['otherpage'] = 'Other page: ';
$lang['captcha_title'] = 'Enter the text from the image';
$lang['changelog'] = '<ul>
<li>0.0.1 - October, 2005 - Initial NRPT (Not Ready for Prime Time) release</li>
<li>0.1.0 - October, 2005 - Initial release</li>
<li>0.1.1 - October, 2005 - Fixed issues with properties</li>
<li>0.1.2 - October, 2005 - Added forgotten password functionality</li>
<li><p>0.1.3 - November, 2005</p>
    <p>Added the ability to specify a redirect page on login, logout, forgot password, and change settings, and added the returnto and form parameters to the user side of things, also did a couple lf little cleanups.  This version requires v0.11 and above for certain.</p></li>
<li>0.1.4 - November, 2005 - Very minor change with respect to a forgotten and no longer needed function call</li>
<li><p>0.1.5 - November, 2005</p>
    <p>Another very minor change, added some text to the PostInstall message.</p></li>
<li><p>0.1.6 - January, 2006<p>
    <p>Changes to the permission model, and minor bug fixes to the preferences.  Also some php5 fixes but I am sure that there are more out there.</p></li>
<li><p>0.1.7 - January, 2006<p>
    <p>Many thanks to <b>katon</b> for adding the textarea and dropdown property types.</p>
    <p>Fixes to the property adding to fix problems with spaces in property names (we no longer let that happen).</p>
</li>
<li><p>1.0.0 - February, 2006<p>
    <p>Added filtering and row limiting to the admin panel. This will have big benefits to those that are using this module for high trafic, and high user sites.</p>
    <p>Added sorting to the admin panel</p>
    <p>Added max length ability to text and email fields</p>
    <p>Fixed a small problem with the default group not being checked when adding a user</p>
    <p>Save filter settings in preferences, and the active tab too.</p>
    <p>Delete user properties when a property is deleted <em>Note</em>, not when it is disabled in the edit group dialog</p>
    <p>Add confirmation message in edit groups.</p>
    <p>Added a couple more confirmation messages.</p>
    <p>Added CSV Export option</p>
    <p>Todo - Add preferences for username and password fieldlength</p>
</li>
<li><p>1.0.1 - March, 2006<p>
    <p>Added the ability to check for duplicate email addresses</p>
    <p>Fix problem where expiry date was being modified when admin modified user settings</p>
    <p>Add a confirmation message to the preferences submit button</p>
    <p>Fixed a minor bug when couting the number of users in a group</p>
    <p>Fixes to the size of username and password fields, and maxlength</p>
    <p>Added advanced filtering on properties</p>
    <p>Changes to labeling in add or edit user</p>
    <p>Fixes to problems with inline and non inline forms, the password is never sent on the get line</p>
    <p>Changed to require CMS 0.12-beta2 at a minimum (for safety purposes)</p>
</li>
<li><p>1.0.2 - March, 2006<p>
    <p>More field length fixes</p>
</li>
<li><p>1.0.3 - March, 2006<p>
    <p>Export to smarty all of the user properties when they are logged in</p>
</li>
<li><p>1.0.4 - May, 2006<p>
    <p>Fixes to the export code</p>
    <p>Code cleanup (alphabetize functions)</p>
    <p>Minor fixes and enhancements (recommended by nils73) for dealing with the change password stuff.</p>
    <p>Removed the requirement for CMS 0.12, and put it back to 0.11.2</p>
    <p>Added the \&#039;silent\&#039; form</p>
    <p>Cleaned up database access stuff for performance reasons (hopefully)</p>
    <p>Added copyright info</p>
    <p>Added macros for redirecto to a user specific page on login or logout</p>
    <p>Tweaks to the admin preferences tab</p>
</li>
<li><p>1.0.5 - May, 2006</p>
    <p>Fixed a problem with expiry dates</p>
    <p>Start splitting the code up into several files</p>
<li><p>1.0.6 - May, 2006</p>
    <p>Fixed a problem with editing dropdowns</p>
</li>
<li><p>1.1.0 - May, 2006</p>
    <p>Events</p>
    <p>Optionally disallow repeated logins</p>
    <p>Export the user id to smarty</p>
    <p>Added optionally \{$group\} for the pages to jump to on login</p>
</li>
<li><p>1.1.1 - Sept, 2006</p>
    <p>Fixed a bug when a user was editing his settings with \&#039;allow duplicate emails\&#039; was off</p>
    <p>Changed the dropdown table to 255 characters</p>
    <p>Minor cleanups</p>
</li>
<li><p>1.1.2 - Dec, 2006</p>
    <p>Fixes (hopefuly) to the adodb/adodb-lite DATETIME issue</p>
    <p>Add captcha support to the login screen (optional), thanks dittman</p>
    <p>Fixes to cancel handling on the lost password and change settings screens</p>
    <p>Fixes to user expiry (more DBTimestamp issues), thanks again dittman</p>
    <p>Option to allow FEUsers to have its own set of permissions asside from the admin permissions.  Thanks _SjG_</p>
    <p>Option to allow duplicate password reminder requests and to specify text on the signin button.  Thanks _SjG_</p>
    <p>General cleanup of functions that were not being used and notices/warnings</p>
    <p>Added the only_groups param for login forms.  Thanks wishy</p>
    <p>Fixes to the length of the email field in the change password form</p>
    <p>Fixes to the email validation stuff</p>
</li>
    <li><p>1.2.0 - April, 2007</p>
    <p>elijahlofgren - Fixes to captcha support, and some template cleanups.</p>
    <p>Add support for multi select lists</p>
    <p>Template cleanups (more of em)</p>
    <p>Add support for value=key stuff in the dropdown and multi select lists.</p>
    <p>better checking of the &quot;at least one group required&quot; stuff</p>
    <p>Output more smarty variables on the user settings page, to allow people to modify the template to something that is more accessibile</p>
    <p>Split into more files for performance</p>
    <p>You can now not delete a group that still has users</p>
    <p>Now handle regex problems better in the admin section users tab</p>
    <p>Email fields, when specified as optional, make em actually optional</p>
    <p>Add support for image uploads, this is a big feature.  Images are scaled to a maximum size in one dimension, and stored as files in a configurable directory under the uploads_path.</p>
    <p>Captcha mode is now on by default, unless you use the nocaptcha parameter in the tag.</p>
    <p>Fixes to CSV export... it was assuming the db_prefix is cms_</p>
    <p>Import Users from CSV</p>
    <p>Fixes to the install and uninstall methods, and now the allow_repeated_logins preference should work</p>
    <p>Adds proper user history tracking.  Now track failed logins, logins, expiries, and logouts, on a per user basis.</p>
    <p>Fixes to the cancel button of the user settings page, if the user settings form is on a different page.</p>
    <p>Fixes to the cancel button of the forgot password page, if the forgot password form is on a different page.</p>
    <p>Minor fixes to behaviour oaf the preferences panels.</p>
</li>
<li>
<p>1.2.1 - June, 2007</p>
	<p>A cookie is now used to keep track of login state between sessions, however the cookie does not last any longer than the timeout specified in the user settings.</p>
	<p>Added the ability for an administrator to logout users</p>
	<p>Added the ability to filter by logged in status</p>
	<p>Added the ability for read-only properties.</p>
	<p>Added more variables in each object in the changesettings form</p>
</li>
<li>
	<p>1.2.2 - June, 2007</p>
	<p>tsw - Added event OnUpdateUser which gets called when user (or admin) updates user info</p>
</li>
</ul>';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>This module allows management and administration of front end users <i>(users who have no admin accesss)</i>.  It allows creation of user groups, and user accounts and allows users to login and logout.  it can be used in conjunction with the CustomContent module to display different content to different users once they have logged in</p>
<h3>Features</h3>
<ul>
<li><p>User account expiration.  You can create temporary users</p></li>
<li><p>Group Properties.  You can ask for different information from members of different groups</p></li>
<li><p>Capable of handling hundreds of users</p></li>
<li><p>Has an extensive API for adding functionality</p></li>
</ul>
<h3>How do I use it</h3>
<ul>
<li><p>After installation you can access admin panel to the FrontEndUsers module under the &quot;Users &amp; gGroups&quot; menu.</p></li>
<li>
<p>Secondly, you should define properties.  Properties are essentially field definitions, here you specify the type of information you want to gather, and limits. i.e:  Name, Age, City, State, Country, Email address, etc.</p>
<p><b>Note:</b> You do not need to define properties for username and password, these will be provided for you</b>
</li>
<li><p>Next you should create one or more user groups.  When you create a group, you are asked for a group name, a description and to associate properties with that group, specify the properties sort order, and wether it is an optional, required, or hidden field <i>(off is also valid)</i></p></li>
<li><p><b>Note:</b> Before proceeding, you should ensure that the preferences are set correctly.</p></li>
<li><p>Thirdly you should create some users.  Adding users is a two step process.  When creating a user you are asked for the username and password, and an expiry date for that user.  You then must select the groups that that user is a member of, and click \&#039;Next\&#039;</p>
<p><em>Note: </em>This is a labour intensive and boring process, it is easier to let users register themselves <em>(See the SelfRegistration Module)</em>, and then you can edit their group information.  but for testing purposes, please create at lest one user</p></li>
<li><p>Lastly, after the system has determined all of the information fields to be presented for that user, you are presented with a form asking for all of the required user information.  Complete this form to complete the user addition</p></li>
<li><p>You are now ready to add the front end functionality to your site.  This is as simple as adding the {cms_module module=FrontEndUsers} tag to your page or template</p></li>
</ul>
<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module, FAQs, or to file a Bug Report or buy commercial support, please visit calguy\&#039;s
module homepage at <a href=&quot;http://techcom.dyndns.org&quot;>techcom.dyndns.org</a>.</li>
<li>Additional discussion of this module may also be found in the <a href=&quot;http://forum.cmsmadesimple.org&quot;>CMS Made Simple Forums</a>.</li>
<li>The author, calguy1000, can often be found in the <a href=&quot;irc://irc.freenode.net/#cms&quot;>CMS IRC Channel</a>.</li>
<li>Lastly, you may have some success emailing the author directly.</li>  
</ul>
<h3>Parameters</h3>
<ul>
<li><em>(optional)</em> form=&quot;name&quot;</li>
<p>Forms:
<ul>
 <li><em>login</em> - Display the login form</li>
 <li><em>logout</em> - Display the logout form</li>
 <li><em>changesettings</em> - Display the change settings form</li>
 <li><em>forgotpw</em> - Display the forgot password form</li>
<li><em>silent</em> = Display nothing, but export properties and other smarty variables for the currently logged in user.  If no user is logged in, then no variables are exported.</li>
</ul>
</p>
<li><em>(optional)</em> returnto=&quot;page&quot;</li>
<p>Used with the login, logout, and changesettings forms, this parameter contains the page id or alias of a page to redirect to, when the form has been successfully completed</p>
<li><em>(optional)</em> only_groups=&quot;group1, group2, group3&quot;</li>
<p>Used with the login forms.  Basically only allows users to login if they belong to that particular group(s).</p>
<li><em>(optional)</em> nocaptcha=&quot;1&quot;</li>
<p>Used with the login forms. his will disnable captcha on the form. By default, if the Captcha module is installed, validation of a captcha image will be required for login.  This is a security measure intented to prevent brute force attacks.</p>
</ul>
<p>As per the GPL, this software is provided as-is. Please read the text
of the license for the full disclaimer.</p>
<h3>Requirements</h3>
<p>In order to implement the forgotten password functionality, this module requires the CMSMailer module to be previously installed</p>
<h3>Copyright and License</h3>
<p>Copyright &copy; 2005, Robert Campbel <a href=&quot;mailto:calguy1000@hotmail.com&quot;><calguy1000@hotmail.com></a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href=&quot;http://www.gnu.org/licenses/licenses.html#GPL&quot;>GNU Public License</a>. You must agree to this license before using the module.</p>';
$lang['utma'] = '156861353.775372662.1187730593.1187730593.1187730593.1';
$lang['utmc'] = '156861353';
$lang['utmz'] = '156861353.1187730593.1.1.utmccn=(direct)|utmcsr=(direct)|utmcmd=(none)';
?>