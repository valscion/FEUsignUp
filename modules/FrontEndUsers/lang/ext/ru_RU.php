<?php
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
$lang['info_std_auth_settings'] = 'The following settings are only applicable if using the "Builtin Authentication".';
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
$lang['msg_reset_session'] = 'Your login session is about to expire, please click ""Ok" to confirm your activity on this website.';
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
$lang['editing_user'] = 'Изменить пользователя';
$lang['noinline'] = 'Не встроенные формы';
$lang['info_lostun'] = 'Нажмите здесь, если вы забыли свой логин';
$lang['info_forgotpw'] = 'Нажмите здесь, если вы забыли свой пароль';
$lang['info_logout'] = 'Нажмите здесь, чтобы выйти';
$lang['info_changesettings'] = 'Нажмите здесь, чтобы изменить свой пароль или другую информацию';
$lang['viewuser_template'] = 'Посмотреть шаблон пользователя';
$lang['event'] = 'Событие';
$lang['feu_event_notification'] = 'FEU уведомления о событиях';
$lang['prompt_notification_address'] = 'Адрес email уведомления';
$lang['prompt_notification_template'] = 'Шаблон уведомления по email';
$lang['prompt_notification_subject'] = 'Тема уведомления по email';
$lang['prompt_notifications'] = 'Уведомления по email';
$lang['OnLogin'] = 'На вход';
$lang['OnLogout'] = 'На выход';
$lang['OnExpireUser'] = 'На истекшую сессию';
$lang['OnCreateUser'] = 'На вновь созданного пользователя';
$lang['OnDeleteUser'] = 'На удаленного пользователя';
$lang['OnUpdateUser'] = 'On User Settings Changed';
$lang['OnCreateGroup'] = 'On User Group Created';
$lang['OnDeleteGroup'] = 'On User Group Deleted';
$lang['lostunconfirm_premsg'] = 'The lost login details functionality has successfully completed.  We have found a unique username that matches the details you entered.';
$lang['your_username_is'] = 'Ваше имя пользователя';
$lang['lostunconfirm_postmsg'] = 'Мы рекомендуем Вам сохранить эту информацию в безопасном, но доступном месте.';
$lang['prompt_after_change_settings'] = 'PageID/Alias to jump to after change settings';
$lang['prompt_after_verify_code'] = 'PageID/Alias to jump to after code verification *';
$lang['lostun_details_template'] = 'Lost Username Details Template';
$lang['lostun_confirm_template'] = 'Lost Username Confirm Template';
$lang['error_nonuniquematch'] = 'Ошибка: более чем один пользователь имеет указанные свойства';
$lang['error_cantfinduser'] = 'Ошибка: невозможно найти пользователя';
$lang['error_groupnotfound'] = 'Ошибка: невозможно найти группу с этим именем';
$lang['readonly'] = 'Только для чтения';
$lang['prompt_usermanipulator'] = 'Класс User Manipulator ';
$lang['admin_logout'] = 'Выполнен выход администратора';
$lang['prompt_loggedinonly'] = 'Показать только залогиневшихся пользователей';
$lang['prompt_logout'] = 'Выход этого пользователя';
$lang['user_properties'] = 'Настройки пользователя';
$lang['userhistory'] = 'История пользователя';
$lang['export'] = 'Экспорт';
$lang['clear'] = 'Очистка';
$lang['prompt_exportuserhistory'] = 'Экспорт истории пользователя в ASCII по крайней мере';
$lang['prompt_clearuserhistory'] = 'Очистить историю пользователя по крайней мере';
$lang['title_lostusername'] = 'Забыли ваш логин?';
$lang['title_rssexport'] = 'Экспорт определения группы (и свойств) в XML';
$lang['title_userhistorymaintenance'] = 'Обслуживание истории пользователя';
$lang['yes'] = 'Да';
$lang['no'] = 'Нет';
$lang['prompt_of'] = 'в';
$lang['date_allrecords'] = '** Без ограничений **';
$lang['date_onehourold'] = 'За текущий час';
$lang['date_sixhourold'] = 'За шесть часов';
$lang['date_twelvehourold'] = 'За двенадцать часов';
$lang['date_onedayold'] = 'За один день';
$lang['date_oneweekold'] = 'За одну неделю';
$lang['date_twoweeksold'] = 'За две недели';
$lang['date_onemonthold'] = 'За один месяц';
$lang['date_threemonthsold'] = 'За три месяца';
$lang['date_sixmonthsold'] = 'За шесть месяцев';
$lang['date_oneyearold'] = 'За один год';
$lang['title_groupsort'] = 'Группировка и сортировка';
$lang['prompt_recordsfound'] = 'Записи, соответствующие критериям';
$lang['sortorder_username_desc'] = 'По алфавиту А-Я';
$lang['sortorder_username_asc'] = 'По алфавиту Я-А';
$lang['sortorder_date_desc'] = 'По дате (убывание)';
$lang['sortorder_date_asc'] = 'По дате (возрастание)';
$lang['sortorder_action_desc'] = 'По типу события (убывание)';
$lang['sortorder_action_asc'] = 'По типу события (возрастание)';
$lang['sortorder_ipaddress_desc'] = 'По IP (убывание)';
$lang['sortorder_ipaddress_asc'] = 'По IP (возрастание)';
$lang['info_nohistorydetected'] = 'История не найдена';
$lang['reset'] = 'Сбросить';
$lang['prompt_group_ip'] = 'Группировать по IP';
$lang['prompt_filter_eventtype'] = 'Фильтр типа события';
$lang['prompt_filter_date'] = 'Показывать только события, которые раньше чем:';
$lang['prompt_pagelimit'] = 'Лимит страницы';
$lang['for'] = 'для';
$lang['title_userhistory'] = 'Отчёт истории пользователя';
$lang['unknown'] = 'Неизвестный';
$lang['prompt_ipaddress'] = 'IP адрес';
$lang['prompt_eventtype'] = 'Тип события';
$lang['prompt_date'] = 'Дата';
$lang['prompt_return'] = 'Вернуться';
$lang['import_complete_msg'] = 'Операция импорта завершена';
$lang['prompt_linesprocessed'] = 'Обработано строк';
$lang['prompt_errors'] = 'Обнаружено ошибок';
$lang['prompt_recordsadded'] = 'Добавлено записей';
$lang['error_nogroupproprelns'] = 'Невозможно найти свойства для группы %s';
$lang['error_noresponsefromserver'] = 'нет ответа от SMTP сервера';
$lang['error_importfilenotfound'] = 'Указанный файл (%s) не обнаружен';
$lang['error_importfieldvalue'] = 'неверное значение выпадающего списка %s';
$lang['error_importfieldlength'] = 'Превышение максимальной длины поля %s ';
$lang['error_importusers'] = 'Ошибка импорта (строка %s): %s';
$lang['error_propertydefns'] = 'Could not get the property definitions (internal error)';
$lang['error_problemsettinginfo'] = 'Problem setting user info';
$lang['error_importrequiredfield'] = 'Could not find a column to match the required field %s';
$lang['error_nogroupproperties'] = 'Could not find properties for the specified group';
$lang['error_importfileformat'] = 'The file specified for import is not in the correct format';
$lang['error_couldnotopenfile'] = 'Не удалось открыть файл';
$lang['info_importusersfileformat'] = '<h4>File Format Information</h4>
<p>The input file must be in ASCII format using comma separated values.  Each line in this input file (with the exception of the header line, discussed below) represents one user record.  Each line must contain the same number of fields, and the order of the fields in each line must be identical.</p>
<h5>Header line</h5>
<ul>
<li>The first line of the file must begin with two pound (\\#) characters, and names each of the fields in the file.  The names of these fields is significant.  There are some required field names (see below), and other field names must match the property names associated with the group users are going to be added into.</li>
<li>The import process will fail if the fields in the input file does not match all of the required properties associated with the group that users are being added into</li>
<li>The input file may contain fields representing some of the optional properties in the specified group.</li>
<li>The import process will ignore any fields in the input file that are either not known, or map to properties that are <em>off</em> in the specified user group.</li>
</ul>
<h5>Columnar Data</h5>
<ul>
<li>The <strong>username</strong> Field - The desired username.
    <p>This field must exist in the headerline, and in each and every line of the input file. The record will fail if a user with that username already exists in the database.</p></li>
<li>The <strong>password</strong> Field - Todo</li>
<li>The <strong>expires</strong> Field - Todo</li>
<li>Dropdown Fields
    <p>The value of dropdown properties in an import file is represented as the string that is shown in the dropdown control in the FrontEndUsers module.</p>
</li>
<li>Multiselect Fields
    <p>Multiselect fields are contained within the ASCII file as a : separated list of strings, where each string represents the text shown in the multiselect list</p>
</li>
<li>Image Fields
    <p>Image are fields who\'s column name matches a property of type Image.  If this field is a required part of the destination group, then the name specified in these columns must exist in the uploads disrectory of the CMS installation.  If the image does not exist, and the field is required, then the record will fail.</p>
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
$lang['prompt_importdestgroup'] = 'Импорт пользователей в эту группу';
$lang['prompt_importfilename'] = 'Входной файл CSV';
$lang['prompt_importxmlfile'] = 'Входной файл XML';
$lang['prompt_exportusers'] = 'Экспорт пользователей';
$lang['prompt_importusers'] = 'Импорт пользователей';
$lang['prompt_clear'] = 'Очистка';
$lang['prompt_image_destination_path'] = 'Image Destination Path';
$lang['error_missing_upload'] = 'A problem occurred with a missing (but required) upload';
$lang['error_bad_xml'] = 'Could not parse the provided XML file';
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
<li><em>id</em> - The id of the logged in user</li>
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
$lang['event_info_OnUpdateGroup'] = 'An event generated when a user group is updated';
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
$lang['prompt_usecookiestoremember'] = 'Use cookies to remember login details';
$lang['prompt_cookiename'] = 'The name of the cookie';
$lang['prompt_allow_duplicate_emails'] = 'Allow duplicate emails';
$lang['prompt_username_is_email'] = 'Email address is username';
$lang['info_cookie_keepalive'] = 'Attempt to keep logins alive by the use of a cookie <em>(the cookie is reset on activity in the website)</em>';
$lang['info_allow_duplicate_emails'] = '(allow multiple users with the same email address)';
$lang['info_username_is_email'] = '(user\'s email address is their username -- don\'t set this with "allow duplicate email addresses"!)';
$lang['prompt_allow_duplicate_reminders'] = 'Allow duplicate "forgot password" reminders?';
$lang['info_allow_duplicate_reminders'] = '(allow a users to request a password reset, even if they haven\'t acted on a previous one)';
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
$lang['error_dberror'] = 'Ошибка базы данных';
$lang['message_forgotpwemail'] = 'You are receiving this message because somebody told our site that you had lost your password.  If this is the case, read the instructions below.  If you don\'t have a clue what this is, then you are safe to delete this message, and we thank you for your time.';
$lang['prompt_code'] = 'Код';
$lang['message_code'] = 'The following code has been generated randomly generated in order to verify the user account.  when you click on the link below you will be presented with a field to enter this code.  Normally the field is pre-completed for you, but incase it isn\'t the code is:';
$lang['prompt_link'] = 'Clicking on the following link will take you to the website where you can enter the above code, and reset your password:';
$lang['lostpassword_emailsubject'] = 'Забыли пароль';
$lang['error_nomailermodule'] = 'Не удалось найти модуль CMSMailer';
$lang['info_forgotpwmessagesent'] = 'На электронную почту было выслано %s  с инструкцией как сбросить пароль. Спасибо';
$lang['lostpw_message'] = 'Итак вы забыли или потеряли свой пароль. Хорошо, введите имя пользователя в систему, и если мы сможем найти вас мы отправим вам письмо с инструкцией по смене пароля';
$lang['forgotpassword_template'] = 'Шаблон восстановления пароля';
$lang['lostusername_template'] = 'Шаблон восстановления имени пользователя';
$lang['error_propnotfound'] = 'Свойство %s не найдено';
$lang['propsfound'] = 'Свойства найдены';
$lang['addprop'] = 'Добавить свойство';
$lang['error_requiredfield'] = 'Обязательное поле (%s) не заполнено';
$lang['info_emptypasswordfield'] = 'Enter a new password here to change your password';
$lang['error_notloggedin'] = 'You do not appear to be logged in';
$lang['user_settings'] = 'Настройки';
$lang['user_registration'] = 'Регистрация';
$lang['error_accountexpired'] = 'Эта учетная запись просрочена';
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
$lang['nogroups'] = 'Нет определённых групп';
$lang['groupsfound'] = 'Найдено групп';
$lang['error_onegrouprequired'] = 'Membership in at least one group is required';
$lang['prompt_requireonegroup'] = 'Require membership in atleast one group';
$lang['back'] = 'Назад';
$lang['error_missing_required_param'] = '%s это обязательное поле';
$lang['requiredfieldmarker'] = 'Помечать обязательные поля';
$lang['requiredfieldcolor'] = 'Hilite required fields in';
$lang['next'] = 'Дальше';
$lang['error_groupexists'] = 'A Group with that name already exists';
$lang['required'] = 'Required';
$lang['optional'] = 'Optional';
$lang['off'] = 'Off';
$lang['size'] = 'Размер';
$lang['sizecomment'] = '<br/>(Maximum size of any one dimension of the image in pixels)';
$lang['length'] = 'Длина';
$lang['lengthcomment'] = '<br>(символов в вводе текста)';
$lang['seloptions'] = 'Dropdown options, separated by line breaks.  Values can be separated from text with a = character. i.e: Female=f';
$lang['radiooptions'] = 'Radiobutton labels, separated by line breaks. Values can be separated from text with a = character. i.e: Female=f';
$lang['prompt'] = 'Prompt';
$lang['prompt_type'] = 'Тип';
$lang['type'] = 'Тип';
$lang['fieldstatus'] = 'Поле статуса';
$lang['usedinlostun'] = 'Ask in Lost<br/>Username';
$lang['text'] = 'Текст';
$lang['checkbox'] = 'Checkbox';
$lang['multiselect'] = 'Multi Select List';
$lang['radiobuttons'] = 'Radio Buttons';
$lang['image'] = 'Изображение';
$lang['email'] = 'Адрес email';
$lang['textarea'] = 'Область текста';
$lang['dropdown'] = 'Список';
$lang['msg_currentlyloggedinas'] = 'Добро пожаловать';
$lang['logout'] = 'выход';
$lang['prompt_newgroupname'] = 'Используйте это название группы';
$lang['prompt_changesettings'] = 'Изменить мои настройки';
$lang['error_loginfailed'] = 'Вход не удался - Неверное имя пользователя или пароль?';
$lang['login'] = 'вход';
$lang['prompt_signin_button'] = 'Sign in button label';
$lang['prompt_username'] = 'Имя пользователя';
$lang['prompt_email'] = 'Адрес email';
$lang['prompt_password'] = 'Пароль';
$lang['prompt_rememberme'] = 'Запомнить меня на этом компьютере';
$lang['register'] = 'Регистрация';
$lang['forgotpw'] = 'Забыли ваш пароль?';
$lang['lostusername'] = 'Забыли ваш логин?';
$lang['defaults'] = 'По умолчанию';
$lang['template'] = 'Шаблон';
$lang['error_usernotfound'] = 'Could not find information for this user';
$lang['error_usernametaken'] = 'That username (%s) is already in use';
$lang['prompt_smtpvalidate'] = 'Использовать SMTP для подтвеждения email адреса?';
$lang['prompt_minpwlen'] = 'Минимальная длина пароля';
$lang['prompt_maxpwlen'] = 'Максимальная длина пароля';
$lang['prompt_minunlen'] = 'Минимальная длина имени пользователя';
$lang['prompt_maxunlen'] = 'Максимальная длина имени пользователя';
$lang['prompt_sessiontimeout'] = 'Тайм-аут сеанса (в секундах)';
$lang['prompt_cookiekeepalive'] = 'Use cookies to keep logins alive';
$lang['prompt_allowemailreg'] = 'Allow Email Registration';
$lang['prompt_dfltgroup'] = 'Группа по-умолчанию для нового пользователя';
$lang['changesettings_template'] = 'Изменить настройки шаблона';
$lang['error_passwordmismatch'] = 'Пароли не совпадают';
$lang['error_invalidusername'] = 'Неправильное имя пользователя';
$lang['error_invalidpassword'] = 'Неправильный пароль';
$lang['edituser'] = 'Изменить пользователя';
$lang['valid'] = 'Действительный';
$lang['username'] = 'Имя пользователя';
$lang['status'] = 'Статус';
$lang['error_membergroups'] = 'Этот пользователь не является членом какой-либо группы';
$lang['error_properties'] = 'Нет свойств';
$lang['error_dup_properties'] = 'Попытка импорта дубликата свойства';
$lang['value'] = 'Значение';
$lang['groups'] = 'Группы';
$lang['properties'] = 'Свойства';
$lang['propname'] = 'Название свойства';
$lang['propvalue'] = 'Значение свойства';
$lang['add'] = 'Добавить';
$lang['history'] = 'История';
$lang['edit'] = 'Изменить';
$lang['expires'] = 'Истекает';
$lang['specify_date'] = 'Укажите дату';
$lang['12hrs'] = '12 часов';
$lang['24hrs'] = '24 часа';
$lang['48hrs'] = '48 часов';
$lang['1week'] = '1 неделя';
$lang['2weeks'] = '2 недели';
$lang['1month'] = '1 месяц';
$lang['3months'] = '3 месяца';
$lang['6months'] = '6 месяцев';
$lang['1year'] = '1 год';
$lang['never'] = 'Никогда';
$lang['postinstallmessage'] = 'Module installed sucessfully.<br/>Be sure to set the "Modify FrontEndUser Properties permission.  Additionally, we recommend that you install the Captcha module.  If installed, validation of a captcha image will be required in addition to the username and password to login.  This is intended to prevent brute force attacks.  <strong>Note:</strong> The nocaptcha parameter can be used to disable this functionality even if the Captcha module is installed."';
$lang['password'] = 'Пароль';
$lang['repeatpassword'] = 'Ещё раз';
$lang['error_groupname_exists'] = 'Группа с таким именем уже существует';
$lang['editgroup'] = 'Редактировать группу';
$lang['submit'] = 'Отправить';
$lang['cancel'] = 'Отмена';
$lang['delete'] = 'Удалить';
$lang['confirm_editgroup'] = 'Are you sure this is the proper settings for this group?\\nTurning a property off will not delete any entries in the properties table for this group/user.  They will merely be unavailable.';
$lang['areyousure_deletegroup'] = 'Вы уверены что хотите удалить эту группу?';
$lang['confirm_delete_prop'] = 'Are you sure you want to completely delete this property?\\nDoing so will also erase any user entries for this property.';
$lang['error_insufficientparams'] = 'Недостаточно параметров';
$lang['id'] = 'Id';
$lang['name'] = 'Имя';
$lang['error_cantaddprop'] = 'Проблема добавления свойства';
$lang['error_cantaddgroupreln'] = 'Проблема при добавлении связи группы';
$lang['error_cantaddgroup'] = 'Проблема добавления группы';
$lang['error_cantassignuser'] = 'Проблема добавления пользователя в группу';
$lang['error_couldnotdeleteproperty'] = 'Проблема удаления свойства';
$lang['error_couldnotfindemail'] = 'Не удалось найти email';
$lang['error_destinationnotwritable'] = 'Нет прав на запись в папку назначения';
$lang['error_invalidparams'] = 'Неправильные параметры';
$lang['error_nogroups'] = 'Не удалось найти какие-либо группы';
$lang['applyfilter'] = 'Применить';
$lang['filter'] = 'Фильтр';
$lang['userfilter'] = 'Имя пользователя регулярное выражение';
$lang['description'] = 'Описание';
$lang['groupname'] = 'Имя группы';
$lang['accessdenied'] = 'Доступ запрещён';
$lang['error'] = 'Ошибка';
$lang['addgroup'] = 'Добавить группу';
$lang['importgroup'] = 'Импорт группы';
$lang['adduser'] = 'Добавить пользователя';
$lang['usersfound'] = 'Найдены пользователи, соответствующие критерию';
$lang['group'] = 'Группа';
$lang['selectgroup'] = 'Выберите группу';
$lang['registration_template'] = 'Шаблон регистрации';
$lang['logout_template'] = 'Шаблон выхода';
$lang['login_template'] = 'Шаблон входа';
$lang['preferences'] = 'Настройки';
$lang['users'] = 'Пользователи';
$lang['friendlyname'] = 'Интерфейс управления пользователями';
$lang['moddescription'] = 'Разрешить пользователям войти во фронтенд вашего сайта';
$lang['defaultfrontpage'] = 'Главная страница по умолчанию ';
$lang['lastaccessedpage'] = 'Последний доступ к странице';
$lang['otherpage'] = 'Другая страница: ';
$lang['captcha_title'] = 'Введите код с картинки';
$lang['help'] = '<h3>What Does This Do?</h3>
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
<li><p>Thirdly you should create some users.  Adding users is a two step process.  When creating a user you are asked for the username/email and password, and an expiry date for that user.  You then must select the groups that that user is a member of, and click \\\'Next\\\'</p>
<p><em>Note: </em>This is a labour intensive and boring process, it is easier to let users register themselves <em>(See the SelfRegistration Module)</em>, and then you can edit their group information.  but for testing purposes, please create at lest one user</p></li>
<li><p>Lastly, after the system has determined all of the information fields to be presented for that user, you are presented with a form asking for all of the required user information.  Complete this form to complete the user addition</p></li>
<li><p>You are now ready to add the front end functionality to your site.  This is as simple as adding the {cms_module module=FrontEndUsers} tag to your page or template</p></li>
</ul>
<h3>Smarty Functions</h3>
<p>Some limited interaction with the FrontEndUsers module database is possible with smarty and the $feu_smarty object.</p>
<h4>Functions:</h4>
<ul>
<li><strong><code>{$feu_smarty-&gt;get_users_by_groupname($groupname,$assign)}</code></strong>
<p>This function can be used to extract an array of usernames and userids for all users that belong to the specified group.  The output is assigned to a smarty variable specified in the &quot;assign&quot; parameter.</p>
<p>Example:<br/><code>{$feu_smarty-&gt;get_users_by_groupname(\'members\',\'mymembers\')}<br/>{$mymembers|@print_r}</code></p>
</li>
<li><strong><code>{$feu_smarty-&gt;get_user_properties($uid,$assign)}</code></strong>
<p>This function can be used to extract a list of properties for the specified user and assign them to a smarty variable with the specified name.</p>
<p>Example:<br/><code>{$feu_smarty-&gt;get_user_properties(5,\'userprops\')}<br/>{$userprops|@print_r}</code></p>
</li>

<li><strong><code>{$feu_smarty-&gt;get_dropdown_text($propname,$propvalue[,$assign])}</code></strong>
<p>This smarty function returns the text specified for a particular option value for a specified dropdown property.</li>
<p>Example:<br/><code>{$feu_smarty-&gt;get_dropdown_text(\'age_range\',$onepropvalue)}</code></p>
</li>

<li><strong><code>{$feu_smarty-&gt;get_multiselect_text($propname,$propvalue,$assign)}</code></strong>
<p>This smarty function returns an array of option texts corresponding to a comma separated list of option values.</li>
<p>Example:<br/><code>{$feu_smarty-&gt;get_multiselect_text(\'favorite_foods\',$onepropvalue,\'favorite_foods\')}<br/>{$favorite_foods|@print_r}</code></p>
</li>

<li><strong>code>{$feu_smarty-&gt;get_user_expiry($uid[,$assign])}</code></strong>
<p>This smarty method returns the unix timestamp that the specified uid account expires.  The function will return false if the uid cannot be found or some other error occurred.</p>
<p>Example:<br/><code>{$feu_smarty-&gt;get_user_expiry(25,\'expiry\')}<br/>{$expiry|cms_date_format}</code></p>
</li>

<li><strong>code>{$feu_smarty-&gt;user_expired($uid[,$assign])}</code></strong>
<p>This smarty method returns a boolean indicating wether the specified user account has expired.  The method will also return false if the uid cannot be found or some other error occurred.</p>
<p>Example:<br/><code>{$feu_smarty-&gt;user_expired(25,\'expired\')}<br/>{if $expired}UID 25 can no longer login to the system{/if}</code></p>
</li>
</ul>

<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module, FAQs, or to file a Bug Report or buy commercial support, please visit calguy\\\'s
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
</ul>';
$lang['qca'] = 'P0-38317492-1275420055165';
$lang['utmz'] = '156861353.1300041074.107.10.utmcsr=forum.cmsmadesimple.org|utmccn=(referral)|utmcmd=referral|utmcct=/viewforum.php';
$lang['utma'] = '156861353.1888202211.1275420054.1300041074.1300043376.108';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353.1.10.1300043376';
?>