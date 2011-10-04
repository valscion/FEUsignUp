<?php
# Simple Language file for the Calendar module.
# Copyright (c) 2004 by Rob Allen <rob@akrabat.com>
$lang['delete'] = 'Delete';
$lang['cd_company'] = 'Company Directory Company';
$lang['dflt_urlprefix'] = 'Default URL prefix for Pretty URLS';
$lang['dflt_alldayevent'] = 'New events are &quot;All Day&quot; events by default';
$lang['dflt_starttime'] = 'Default start time for new events';
$lang['info_dflt_starttime'] = '<em>(applies only if new events are not &quot;All Day&quot; events.)</em>';
$lang['search_type'] = 'Search Type';
$lang['search_any'] = 'Return results matching any word';
$lang['search_all'] = 'Return results matching all words';
$lang['info_customfields'] = '<span style="color: red;">Note:</span> Only text fields are searchable.  Clicking the chechbox on other field types will have no effect.';
$lang['searchable'] = 'Searchable';
$lang['help_param_editeventtemplate'] = 'Applicable only to the myevents action, this parameter allows specifying a non default edit event template to use when a user creates or edits an event';
$lang['help_param_editpage'] = 'Applicable only to the myevents action, this parameter allows specifying a different page for the edit form.';
$lang['help_param_myeventstemplate'] = 'Applicable only to the myevents action, this parameter allows specifying a non default template to use';
$lang['cal_edit_event'] = 'Edit Calendar Event';
$lang['error_dberror'] = 'Database Error';
$lang['submit'] = 'Submit';
$lang['info_sysdflt_editevent_template'] = 'System Default &quot;Edit Event&quot; Template';
$lang['info_sysdflt_myevents_template'] = 'System Default &quot;My Events&quot; Template';
$lang['prompt_feedit_group'] = 'Members of this FEU group can add events';
$lang['prompt_feedit_page'] = 'Default page for the frontend edit form.';
$lang['none'] = 'None';
$lang['owner'] = 'Owner';
$lang['cal_editevent_templates'] = 'Edit Event Form Templates';
$lang['info_editevent_template_tab'] = 'The list of templates that are available for the edit event form';
$lang['editeventtemplate_addedit'] = 'Add/Edit an Edit Event Form Template';
$lang['cal_myevents_templates'] = 'My Events List Templates';
$lang['info_myevents_template_tab'] = 'The list of templates that are available to display a list of user events';
$lang['myeventstemplate_addedit'] = 'Add/Edit a &quot;My Events&quot; report template';
$lang['areyousure_removeconflicting'] = 'This action will remove any events that conflict with non-overlappable events.  Are you sure you want to do this?';
$lang['filter_conflicting'] = 'Filter Conflicting Events';
$lang['overlap_action_remove'] = 'Silently remove conflicting events';
$lang['overlap_action_error'] = 'Display an error';
$lang['prompt_overlap_action'] = 'What should happen when a conflict is detected during editing or adding of an event';
$lang['error_event_conflict'] = 'The event values specified overlap with an existing event that does not allow conflicts';
$lang['cal_info_overlap'] = 'Applies only to events with an end time (or all day events)';
$lang['cal_overlap'] = 'Allow new events to overlap with this one';
$lang['prompt_overlap_policy'] = 'Event Overlap Policy';
$lang['policy_all'] = 'All Events can overlap';
$lang['policy_none'] = 'No Events can overlap';
$lang['policy_individual'] = 'Decided on an event by event basis';
$lang['lbl_back'] = 'Back';
$lang['lbl_templates'] = 'Templates';
$lang['textarea'] = 'Text Area';
$lang['error_calendar_incompatible'] = 'We have detected that the Calendar module is also installed..  This module is not compatible with the Calendar module and cannot co-exist with it on the same install.  Please uninstall the Calendar module';
$lang['error_event_not_found'] = 'Either event_id is not in the database, or there is more than one event with this id! (%d)';
$lang['first_page'] = '&lt;&lt;';
$lang['prev_page'] = '&lt;';
$lang['next_page'] = '&gt;';
$lang['last_page'] = '&gt;&gt;';
$lang['page_of'] = 'Page %d of %d';
$lang['search_results'] = 'Calendar Search Results';
$lang['search_words'] = 'Search Words';
$lang['no_results_found'] = 'No results found matching the query specified';
$lang['frequency'] = 'Frequency';
$lang['specified_date'] = 'Use the specified date';
$lang['first_sunday'] = 'First Sunday of the Month';
$lang['first_monday'] = 'First Monday of the Month';
$lang['first_tuesday'] = 'First Tuesday of the Month';
$lang['first_wednesday'] = 'First Wednesday of the Month';
$lang['first_thursday'] = 'First Thursday of the Month';
$lang['first_friday'] = 'First Friday of the Month';
$lang['first_saturday'] = 'First Saturday of the Month';
$lang['second_sunday'] = 'Second Sunday of the Month';
$lang['second_monday'] = 'Second Monday of the Month';
$lang['second_tuesday'] = 'Second Tuesday of the Month';
$lang['second_wednesday'] = 'Second Wednesday of the Month';
$lang['second_thursday'] = 'Second Thursday of the Month';
$lang['second_friday'] = 'Second Friday of the Month';
$lang['second_saturday'] = 'Second Saturday of the Month';
$lang['third_sunday'] = 'Third Sunday of the Month';
$lang['third_monday'] = 'Third Monday of the Month';
$lang['third_tuesday'] = 'Third Tuesday of the Month';
$lang['third_wednesday'] = 'Third Wednesday of the Month';
$lang['third_thursday'] = 'Third Thursday of the Month';
$lang['third_friday'] = 'Third Friday of the Month';
$lang['third_saturday'] = 'Third Saturday of the Month';
$lang['fourth_sunday'] = 'Fourth Sunday of the Month';
$lang['fourth_monday'] = 'Fourth Monday of the Month';
$lang['fourth_tuesday'] = 'Fourth Tuesday of the Month';
$lang['fourth_wednesday'] = 'Fourth Wednesday of the Month';
$lang['fourth_thursday'] = 'Fourth Thursday of the Month';
$lang['fourth_friday'] = 'Fourth Friday of the Month';
$lang['fourth_saturday'] = 'Fourth Saturday of the Month';
$lang['last_sunday'] = 'Last Sunday of the Month';
$lang['last_monday'] = 'Last Monday of the Month';
$lang['last_tuesday'] = 'Last Tuesday of the Month';
$lang['last_wednesday'] = 'Last Wednesday of the Month';
$lang['last_thursday'] = 'Last Thursday of the Month';
$lang['last_friday'] = 'Last Friday of the Month';
$lang['last_saturday'] = 'Last Saturday of the Month';

$lang['error_invalid_recur_monthly_freq'] = 'Invalid frequency.... you cannot specify both the specified date AND other values';
$lang['searchresulttemplate_addedit'] = 'Add/Edit a Search Result Template';
$lang['info_searchresult_template_tab'] = 'The list of templates that are available for the search results display';
$lang['info_sysdflt_searchresult_template'] = 'System Default Search Result Template';
$lang['cal_search_result_templates'] = 'Search Result Templates';
$lang['error_query_failed'] = 'Database Query Failed';
$lang['error_search_invalid_dates'] = 'Invalid Search Dates Specified';
$lang['text'] = 'Text';
$lang['search'] = 'Search';
$lang['category'] = 'Category';
$lang['info_sysdflt_search_template'] = 'System Default Search Form Template';
$lang['searchtemplate_addedit'] = 'Add/Edit a Search Form Template';
$lang['info_search_template_tab'] = 'The list of templates that are available for the search form';
$lang['cal_search_form_templates'] = 'Search Form Templates';
$lang['max'] = 'max';
$lang['times'] = 'times';
$lang['on'] = 'on';
$lang['areyousure_uninstall'] = 'Are you sure you want to do this?  Continuing will permanenently erase all data associated with this module.';
$lang['post_uninstall'] = 'The Calendar module has been uninstalled and all event and template information associated with this module has been removed';
$lang['fieldupdated'] = 'Field Updated';
$lang['every'] = 'Every';
$lang['or'] = 'or';
$lang['update_children'] = 'Update Child Events';
$lang['error_nocategory'] = 'You must select at least one category';
$lang['error_nothingselected'] = 'Nothing has been selected to delete';
$lang['error_eventoverlap'] = 'The recuring event parameters you have specified would result in overlapping events.';
$lang['recurs'] = 'Recurs';
$lang['error_invalid_dates'] = 'One or more of the date values entered were invalid';
$lang['sunday'] = 'Sunday';
$lang['monday'] = 'Monday';
$lang['tuesday'] = 'Tuesday';
$lang['wednesday'] = 'Wednesday';
$lang['thursday'] = 'Thursday';
$lang['friday'] = 'Friday';
$lang['saturday'] = 'Saturday';

$lang['abbr_sunday'] = 'Su';
$lang['abbr_monday'] = 'Mo';
$lang['abbr_tuesday'] = 'Tu';
$lang['abbr_wednesday'] = 'We';
$lang['abbr_thursday'] = 'Th';
$lang['abbr_friday'] = 'Fr';
$lang['abbr_saturday'] = 'Sa';

$lang['weekdays'] = 'Weekdays';
$lang['plural_daily'] = 'Days';
$lang['plural_weekly'] = 'Weeks';
$lang['plural_monthly'] = 'Months';
$lang['plural_yearly'] = 'Years';
$lang['no'] = 'No';
$lang['daily'] = 'Daily';
$lang['weekly'] = 'Weekly';
$lang['monthly'] = 'Monthly';
$lang['yearly'] = 'Yearly';
$lang['interval'] = 'Repeat every';
$lang['cal_recur_details'] = 'Recurring Event Details';
$lang['unlimited'] = 'Unlimited';
$lang['max_recur_events'] = 'Maximum number of child events';
$lang['use_to_date'] = 'Specify a different end date?';
$lang['cancel'] = 'Cancel';
$lang['show_child_events'] = 'Show Child Events <em>(may result in very long display)</em>';
$lang['n/a'] = 'n/a';
$lang['recurs_until'] = 'Recur Until';
$lang['parent'] = 'Parent';
$lang['recur_period'] = 'Recur Period';
$lang['filter'] = 'Filter';
$lang['start_date'] = 'Start Date';
$lang['end_date'] = 'End Date';
$lang['info_upcominglist_template_tab'] = 'The list of templates that are available for upcominglist views';
$lang['upcominglisttemplate_addedit'] = 'Add/Edit an Upcominglist Display Template';
$lang['info_sysdflt_upcominglist_template'] = 'System Default Upcominglist Template';
$lang['info_list_template_tab'] = 'The list of templates that are available for list views';
$lang['listtemplate_addedit'] = 'Add/Edit an List Display Template';
$lang['info_sysdflt_list_template'] = 'System Default List Template';
$lang['info_event_template_tab'] = 'The list of templates that are available for event views';
$lang['eventtemplate_addedit'] = 'Add/Edit an Event Display Template';
$lang['info_sysdflt_event_template'] = 'System Default Event Template';
$lang['info_calendar_template_tab'] = 'The list of templates that are available for calendar views';
$lang['calendartemplate_addedit'] = 'Add/Edit a Calendar Display Template';
$lang['info_sysdflt_calendar_template'] = 'System Default Calendar Template';
$lang['info_sysdflt_template'] = 'This form defines the template that will be used when you click &quot;New Template&quot; in the appropriate tab.  Changing this value will have no immediate effect on the displays generated from this module.';

# Language: en_US
$lang['eventdesc-EventAdded'] = 'Called after adding a calendar event';
$lang['eventdesc-EventEdited'] = 'Called after editing an existing calendar event';
$lang['eventdesc-EventDeleted'] = 'Called after an event has been deleted';
$lang['eventdesc-CategoryAdded'] = 'Called after a category is created';
$lang['eventdesc-CategoryEdited'] = 'Called after a category is edited';
$lang['eventdesc-CategoryDeleted'] = 'Called after a category is deleted';

$lang['eventhelp-EventAdded'] = '
<p>Sent when a calendar event is added.</p>
<h4>Parameters</h4>
<ul>
<li>\"event_title\" - Event Title</li>
<li>\"event_summary\" - Summary Text</li>
<li>\"event_details\" - Detailed Description</li>
<li>\"event_date_start\" - The event start date/time</li>
<li>\"event_date_end\" - The event end date/time</li>
<li>\"event_created_by\" - The userid of the author</li>
<li>\"event_id\" - The event id</li>
</ul>
';
$lang['eventhelp-EventEdited'] = '
<p>Sent when a calendar event is edited.</p>
<h4>Parameters</h4>
<ul>
<li>\"event_title\" - Event Title</li>
<li>\"event_summary\" - Summary Text</li>
<li>\"event_details\" - Detailed Description</li>
<li>\"event_date_start\" - The event start date/time</li>
<li>\"event_date_end\" - The event end date/time</li>
<li>\"event_created_by\" - The userid of the author</li>
<li>\"event_id\" - The event id</li>
</ul>
';
$lang['eventhelp-EventDeleted'] = '
<p>Sent when a calendar event is deleted.</p>
<h4>Parameters</h4>
<ul>
<li>\"event_id\" - The event id</li>
</ul>
';
$lang['eventhelp-CategoryAdded'] = '
<p>Sent when a calendar category is added.</p>
<h4>Parameters</h4>
<ul>
<li>\"category_id\" - The category id</li>
</ul>
';
$lang['eventhelp-CategoryEdited'] = '
<p>Sent when a calendar category is edited.</p>
<h4>Parameters</h4>
<ul>
<li>\"category_id\" - The category id</li>
<li>\"category_name\" - The category name</li>
<li>\"category_order\" - The category sort order</li>
</ul>
';
$lang['eventhelp-CategoryDeleted'] = '
<p>Sent when a calendar category is deleted.</p>
<h4>Parameters</h4>
<ul>
<li>\"category_id\" - The category id</li>
<li>\"category_name\" - The category name</li>
<li>\"category_order\" - The category sort order</li>
</ul>
';

$lang['msg_eventadded'] = 'Event Added';
$lang['error_noeventname'] = 'A name for the event is required';
$lang['error_noupload'] = 'ERROR: No uploaded file found';
$lang['error_invalidfilename'] = 'ERROR: The file uploaded cannot be accepted';
$lang['error_problemwithupload'] = 'ERROR: A problem occurred trying to upload the file';
$lang['error_filecopyfailed'] = 'ERROR: A Problem occurred when copying the file to its final destination';
$lang['error_fileexists'] = 'ERROR: A file by that name already exists';
$lang['error_csvfilenotfound'] = 'ERROR: Could not find the CSV File';
$lang['error_cantopenfile'] = 'ERROR: Cannot open file';
$lang['error_categoryexists'] = 'ERROR: A category with the name %s already exists';

$lang['cal_id'] = 'Id';
$lang['cal_calendar'] = 'Calguys Calendar';
$lang['cal_default_templates'] = 'Default Templates';
$lang['cal_description'] = 'Add, edit and remove events';
$lang['cal_addevent'] = 'Add Event';
$lang['cal_import_events'] = 'Import Events';
$lang['cal_events'] = 'Events';
$lang['cal_categories'] = 'Categories';
$lang['cal_calendar_template'] = 'Calendar Templates';
$lang['cal_list_template'] = 'List Templates';
$lang['cal_upcominglist_template'] = 'Upcoming Templates';
$lang['cal_event_template'] = 'Event Templates';
$lang['cal_settings'] = 'Settings';
$lang['cal_prev'] = '&laquo; Prev';
$lang['cal_next'] = 'Next &raquo;';

$lang['cal_categories_updated'] = 'Categories Updated';
$lang['cal_settings_updated'] = 'Settings Updated';
$lang['cal_add_event'] = 'Add Event';
$lang['cal_edit'] = 'Edit';
$lang['cal_delete'] = 'Delete';
$lang['cal_areyousure'] = 'Are you sure you want to delete';
$lang['cal_update_template'] = 'Update Template';

$lang['cal_sunday'] = 'Sunday';
$lang['cal_monday'] = 'Monday';
$lang['cal_tuesday'] = 'Tuesday';
$lang['cal_wednesday'] = 'Wednesday';
$lang['cal_thursday'] = 'Thursday';
$lang['cal_friday'] = 'Friday';
$lang['cal_saturday'] = 'Saturday';
$lang['cal_sun'] = 'Sun';
$lang['cal_mon'] = 'Mon';
$lang['cal_tues'] = 'Tue';
$lang['cal_wed'] = 'Wed';
$lang['cal_thurs'] = 'Thu';
$lang['cal_fri'] = 'Fri';
$lang['cal_sat'] = 'Sat';

$lang['cal_january'] = 'January';
$lang['cal_february'] = 'February';
$lang['cal_march'] = 'March';
$lang['cal_april'] = 'April';
$lang['cal_may'] = 'May';
$lang['cal_june'] = 'June';
$lang['cal_july'] = 'July';
$lang['cal_august'] = 'August';
$lang['cal_september'] = 'September';
$lang['cal_october'] = 'October';
$lang['cal_november'] = 'November';
$lang['cal_december'] = 'December';

$lang['cal_add'] = 'Add';
$lang['cal_update'] = 'Update';
$lang['cal_event'] = 'Event';
$lang['cal_date'] = 'Date';
$lang['cal_summary'] = 'Summary';
$lang['cal_details'] = 'Details';
$lang['cal_more'] = 'more >>';
$lang['cal_return'] = 'Return';
$lang['cal_to'] = 'to';
$lang['cal_past_events'] = 'Past Events';
$lang['cal_upcoming_events'] = 'Upcoming Events';
$lang['cal_any_category'] = 'Any Category';
$lang['cal_show_only_events_in'] = 'Show Only Events In';
$lang['cal_filter_by'] = 'Filter Title By <em>(regex)</em>';
$lang['cal_go'] = 'Go';
$lang['cal_title'] = 'Title';
$lang['cal_fromdate'] = 'From Date';
$lang['cal_todate'] = 'To Date';
$lang['cal_summary'] = 'Summary';
$lang['cal_description'] = 'A full featured, and flexible module to allow displaying information about events in numerous formats.';
$lang['cal_update_categories'] = 'Update Categories';
$lang['cal_language'] = 'Language';
$lang['cal_updatesettings'] = 'Update Settings';
$lang['cal_use_twelve_hour_clock'] = 'Use twelve hour clock on hour drop-downs?';
$lang['cal_default_category'] = 'Default Category';
$lang['cal_update_fields'] = 'Update Fields';
$lang['force_category']='Force at least one category';
$lang['showpastyears']='How many years in the past is allowed';
$lang['showfutureyears']='How many year into the future is allowed';
$lang['hidesummary']='Should the summary field be hidden';
$lang['hidecontent']='Should the content field be hidden';

$lang['category_reminder']='Please check one or more categories for this event';
$lang["module_example_stylesheet"]="Calguys Calendar CSS example";

$lang['error_permission'] = 'You need the appropriate permission (%s) to access this functionality';
$lang['install_postmessage'] = 'Make sure to set the "Modify Calendar" permission on users who will be administering calendar events.';

$lang["deletetagged"]="Delete tagged events";
$lang["confirmdeletetagged"]="Are you sure these events should be deleted?";
$lang["taggeddeleted"]="Tagged events successfully deleted";
$lang['templates'] = 'Templates';
$lang['template_help'] = 'Template Help';
$lang['file_templates'] = 'File Templates';
$lang['addtemplate'] = 'Add Template';
$lang['template'] = 'Template';
$lang['templatenametext'] = 'Template Name';
$lang['edittemplate'] = 'Edit Template';
$lang['deletetemplate'] = 'Delete Template';
$lang['newtemplate'] = 'New Template Name';
$lang['templatenameexists'] = 'Error: A template with that name already exists. Please choose a different name.';
$lang['templateimported'] = 'The template was sucessfully imported into the database and is now installed for use.';
$lang['view_default_stylesheet'] = 'View Default Stylesheet';
$lang['filename'] = 'Filename';
$lang['importtemplate'] = 'Import Template';
$lang['template_deleted'] = 'The template was successfully deleted from the database.';
$lang["updatetemplatesuccess"]="The template was updated successfully";
$lang["updatetemplatefailure"]="An error occurred updating the template";
$lang["settingssaved"]="Settings was saved successfully";
$lang["categorydeleted"]="Category deleted";
$lang["categoryupdated"]="Category updated";
$lang["categoryadded"]="Category added";
$lang["eventdeleted"]="The event was deleted";
$lang["eventupdated"]="The event was updated";
$lang['default_page_error'] = 'Error: You must set a default page in order to use Calendar with pretty URLs turned on. Please go to the Calendar settings tab and choose one.';
$lang["time_at"]="at";
$lang['type']='Type';
$lang["name"]="Name";
$lang["order"]="Order";

$lang['fieldadded'] = 'Field Successfully Added';
$lang['fielddeleted'] = 'Field Deleted';
$lang['fields'] = 'Custom Fields';
$lang['textfield'] = 'Text Field';
$lang['uploadfield'] = 'File upload field';
$lang["description"]="<p>Calendar is a module for displaying events on your page. When the
		module is installed, a Calendar admin page is added to the content menu
		that will allow you to manage your events.</p>";

$lang['defaultcalendarpage'] = 'Default page that contains Calendar. This page must contain a Smarty tag that calls Calendar. Required if you use the pretty URLs.';
$lang['uploaddirectory'] = 'Directory where file uploads should be placed';
$lang['uploadfiletypes'] = 'Allowed file types';
$lang['uploadunique'] = 'Ensure unique filenames';
$lang['thumb_width'] = 'Thumbnail Width';
$lang['thumb_height'] = 'Thumbnail Height';
$lang['large_width'] = 'Large Image Width';
$lang['large_height'] = 'Large Image Height';

$lang['cal_recur_period'] = 'Recurs';
$lang['cal_recur_until'] = 'Recurs Until';


$lang['help_template'] = '
<p><b>Print Author Name:</b></p>
<code>Author: {$event.authorname}</code>
';
$lang['cal_help'] = <<<EOT
<h3>Notice:</h3>
<p>Version 1.0 of the Calguy Calendar module is a complete fork of the old calendar module.  However, this module is not compatible in any way with the other module.</p>
<h3>What does this do?</h3>
<p>Calguys Calendar is a module for displaying events on your page. When the
module is installed, a &quot;Calguys Calendar&quot; admin page is added to the plugins menu
that will allow you to manage your events.</p>
<h3>Security</h3>
<p>The user must belong to a group with the 'Modify Calendar' permission
in order to add, edit, or delete calendar event entries.</p>
<h3>How do I use it?</h3>
<ol>
  <li>Put the cms_module tag in the page content. Make sure it is not enclosed in &lt;pre&gt;...&lt;/pre&gt; tags.  You will need to view source code for this.  The code would look something like:<br />
  <tt>{cms_module module="CGCalendar"}</tt><br />
  <li>Style the calendar appropriately for your display (an example stylesheet is provided for this purpose)</li>
</ol>
<br/>
<p><b>To attach the sample stylesheet to your template:</b></p>
<ol>
<li>Go to "Layout -> Templates"</li>
<li>Click the CSS icon (Attach Stylesheet to Template) button to the right of your template</li>
<li>Choose "Calguys Calendar CSS example" from the drop-down menu.</li>
<li>Click the "Add a Stylesheet" button.</li>
</ol>
<br/>
<h3>Parameters</h3>
<table border=0 cellpadding=3 cellspacing=0>
  <tr>
     <td>action</td>
     <td>Acceptable values:<br>
        "default" - Specifies the default action, works in conjunction with the "display" parameter below.<br/>
	"search" - Display a form for advanced searching of calendar events.<br/>
        "myevents" - Display a list of all of a users events, and allow adding, editing or deleting those events<br/>
        "addedit_event" - Display a form allowing to add or edit a single event.;
     </td>
  </tr>

  <tr>
     <td>display</td>
     <td>Acceptable values:<br>
	 "calendar" - displays events for the current month in a traditional grid.  Inclues links to prev. and next months.<br/>
	 "event" - display a detail report for a specific event.  To use this display mode, the event_id parameter must be specified.<br/>
	 "list" - displays events for the current month as a list.  Includes links to prev. and next months.<br/>
	 "yearlist" - displays events for the current year in a list.  Includes links to prev. and next years.<br/>
	 "pastlist" - displays all past events.  No prev/next links.<br/>
	 "upcominglist" - displays all upcoming events.  No prev/next links.<br/>
		Defaults to "calendar" <em>(optional)</em>
     </td>
  </tr>

  <tr>
     <td>category</td>
     <td>Only display items for that category. Leaving unset, will show all categories. Note that
	 you can limit to multiple categories by separating each one with a comma. This parameter can be 
         used with the myevents action and with the various display options.  If multiple category names are specified
         a match is done on ANY of the categories specified. <em>(optional)</em></td>
  </tr>

  <tr>
     <td>month</td>
     <td>Display entries for a particular month. If year is not set, then the current year is
	 assumed. This option only works if display is set to "list" or "calendar". <em>(optional)</em></td>
  </tr>

  <tr>
     <td>year</td>
     <td>Display entries for a particular year.
	This option only works if display is set to "list" or "calendar". <em>(optional)</em></td>
  </tr>

  <tr>
     <td>limit</td>
     <td>Set to the maximum number of events to display. This option only works if display is set to "list", "pastlist" or "upcominglist". <em>(optional)</em></td>
  </tr>

  <tr>
     <td>first_day_of_week</td>
     <td>Set to the first day of the week as a number between 0 and 6 (0 = Sunday). Default is 1 (Monday).
	 This option only works if display is set to "calendar". <em>(optional)</em></td>
  </tr>

  <tr>
     <td>use_session</td>
	 <td>Use session variables to store the specifications of the calendar. This will allow a calendar to remember its settings over numerous page views and while scrolling to different months.  In the search form it allows saving the search settings until the browser is reset.  Default is false.  If specified, the value should contain a unique identifier for that calendar instance.  This option only works if display is set to "calendar" or "list", or if "action" is search. <em>(optional)</em></td>
  </tr>

  <tr>
     <td>inline</td>
     <td>Set to 1 to set all of the event links to inlined mode (they will replace the oringal tag).  Default is 0. <em>(optional)</em></td>
  </tr>

  <tr>
     <td>reverse</td>
     <td>Set to true to display events in reverse chronological order. Applicable to "list", "pastlist" and "upcominglist" displays. Default is false. For the "pastlist", reverse=true is assumed.<em>(optional)</em></td>
  </tr>

  <tr>
     <td>detailpage="pagealias"</td>
     <td>Page to display Calendar event details in. This can either be a page alias or an id. Used to allow details to be displayed in a different template from the summary. Default is current page. <em>(optional)</em></td>
  </tr>

  <tr>
     <td>columns</td>
     <td>Makes Calendar output only a subset of relevant events for allowing displaying in columns. Allowed values 1/2. Default is 1. Implemented for upcominglist and pastlist only. <em>(optional)</em></td>
  </tr>

  <tr>
     <td>columnstyle</td>
     <td>If columns=2 this parameter sets whether the order of events in columns should be organized horizontally (0) or vertically (1). Default is 1. <em>(optional)</em></td>
  </tr>

  <tr>
     <td>currentcolumn</td>
     <td>If columns=2 this indicated whether Calendar should display content of column 1 or 2. Allowed values 1/2. Default is 1. <em>(optional)</em></td>
  </tr>

  <tr>
     <td>event_id</td>
     <td>Used with the display=event mode, this parameter allows you to display information about a specific event on demand.</td>
  </tr>

  <tr>
     <td>limit</td>
     <td>Used with the list displays, this parameter allows specifying a maximum number of events to display, and then provides pagination capabilities.</td>
  </tr>

  <tr>
     <td>calendartemplate</td>
     <td>Used with display=calendar, this parameter allows you to specify a non default calendar template.</td>
  </tr>

  <tr>
     <td>eventtemplate</td>
     <td>Used with display=event, or you can also specify this parameter on any Calendar module call, this parameter allows you to specify a non default event template.</td>
  </tr>

  <tr>
     <td>listtemplate</td>
     <td>Used with display=list, this parameter allows you to specify a non default list template.</td>
  </tr>

  <tr>
     <td>upcominglisttemplate</td>
     <td>Used with display=upcominglist, this parameter allows you to specify a non default upcominglist template.</td>
  </tr>

  <tr>
     <td>unique_only</td>
     <td>Used with display=upcominglist, and with action=search, this parameter allows you to specify that only one event with a certain name should be returned.  Default value is 0';
  </tr>

  <tr>
     <td>displayforday</td>
     <td>Used with display=upcominglist, this parameter specifies that 00:01 of the current day should be used for calculating wether an event should be displayed, rather than the current server time.</td>
  </tr>

</table>

<h3>Custom Fields</h3>
<p>It is possible to define a number of custom fields to associate with each event using the Fields tab in the admin. Once one or more fields has been defined the values of that field for each event can be set using the events tab in the admin. These field values can be rendered using a template using the syntax event.fields.fieldname. Hint - insert {debug} into your template see all the data passed to the template.</p>

<h3>Examples</h3>
<h4>Example of allowing Comments on Calendar events</h4>
<p>Install the Comments module and put this in your Calendar "Event Template":</p>
<pre>{cms_module module='comments' modulename='CGCalendar' pageid=\$event.event_id}</pre>
<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>Discussion of this module may also be found in the <a href="http://forum.cmsmadesimple.org">CMS Made Simple Forums</a>.</li>
<li>The author, calguy1000, can often be found in the <a href="irc://irc.freenode.net/#cms">CMS IRC Channel</a>.</li>
<li>Lastly, you may have some success emailing the author directly.</li>  
</ul>
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

EOT;
?>
