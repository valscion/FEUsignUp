<?php
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
$lang['sunday'] = 'Pazar';
$lang['monday'] = 'Pazartesi';
$lang['tuesday'] = 'Salı';
$lang['wednesday'] = '&Ccedil;arşamba';
$lang['thursday'] = 'Perşembme';
$lang['friday'] = 'Cuma';
$lang['saturday'] = 'Cumartesi';
$lang['abbr_sunday'] = 'Pz';
$lang['abbr_monday'] = 'Pt';
$lang['abbr_tuesday'] = 'Sa';
$lang['abbr_wednesday'] = '&Ccedil;a';
$lang['abbr_thursday'] = 'Pe';
$lang['abbr_friday'] = 'Cu';
$lang['abbr_saturday'] = 'Ct';
$lang['weekdays'] = 'Hafta i&ccedil;i';
$lang['plural_daily'] = 'G&uuml;nler';
$lang['plural_weekly'] = 'Haftalar';
$lang['plural_monthly'] = 'Aylar';
$lang['plural_yearly'] = 'Yıllar';
$lang['no'] = 'No';
$lang['daily'] = 'G&uuml;nl&uuml;k';
$lang['weekly'] = 'Haftalık';
$lang['monthly'] = 'Aylık';
$lang['yearly'] = 'Yıllık';
$lang['interval'] = 'Repeat every';
$lang['cal_recur_details'] = 'Recurring Event Details';
$lang['unlimited'] = 'Limitsiz';
$lang['max_recur_events'] = 'Maximum number of child events';
$lang['use_to_date'] = 'Specify a different end date?';
$lang['cancel'] = 'Vazge&ccedil;';
$lang['show_child_events'] = 'Show Child Events <em>(may result in very long display)</em>';
$lang['n/a'] = 'n/a';
$lang['recurs_until'] = 'Recur Until';
$lang['parent'] = 'Parent';
$lang['recur_period'] = 'Recur Period';
$lang['filter'] = 'Filtre';
$lang['start_date'] = 'Başlama Tarihi';
$lang['end_date'] = 'Bitiş Tarihi';
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
$lang['eventdesc-EventAdded'] = 'Called after adding a calendar event';
$lang['eventdesc-EventEdited'] = 'Called after editing an existing calendar event';
$lang['eventdesc-EventDeleted'] = 'Called after an event has been deleted';
$lang['eventdesc-CategoryAdded'] = 'Called after a category is created';
$lang['eventdesc-CategoryEdited'] = 'Called after a category is edited';
$lang['eventdesc-CategoryDeleted'] = 'Called after a category is deleted';
$lang['eventhelp-EventAdded'] = '<p>Sent when a calendar event is added.</p>
<h4>Parameters</h4>
<ul>
<li>\&quot;event_title\&quot; - Event Title</li>
<li>\&quot;event_summary\&quot; - Summary Text</li>
<li>\&quot;event_details\&quot; - Detailed Description</li>
<li>\&quot;event_date_start\&quot; - The event start date/time</li>
<li>\&quot;event_date_end\&quot; - The event end date/time</li>
<li>\&quot;event_created_by\&quot; - The userid of the author</li>
<li>\&quot;event_id\&quot; - The event id</li>
</ul>
';
$lang['eventhelp-EventEdited'] = '<p>Sent when a calendar event is edited.</p>
<h4>Parameters</h4>
<ul>
<li>\&quot;event_title\&quot; - Event Title</li>
<li>\&quot;event_summary\&quot; - Summary Text</li>
<li>\&quot;event_details\&quot; - Detailed Description</li>
<li>\&quot;event_date_start\&quot; - The event start date/time</li>
<li>\&quot;event_date_end\&quot; - The event end date/time</li>
<li>\&quot;event_created_by\&quot; - The userid of the author</li>
<li>\&quot;event_id\&quot; - The event id</li>
</ul>
';
$lang['eventhelp-EventDeleted'] = '<p>Sent when a calendar event is deleted.</p>
<h4>Parameters</h4>
<ul>
<li>\&quot;event_id\&quot; - The event id</li>
</ul>
';
$lang['eventhelp-CategoryAdded'] = '<p>Sent when a calendar category is added.</p>
<h4>Parameters</h4>
<ul>
<li>\&quot;category_id\&quot; - The category id</li>
</ul>
';
$lang['eventhelp-CategoryEdited'] = '<p>Sent when a calendar category is edited.</p>
<h4>Parameters</h4>
<ul>
<li>\&quot;category_id\&quot; - The category id</li>
<li>\&quot;category_name\&quot; - The category name</li>
<li>\&quot;category_order\&quot; - The category sort order</li>
</ul>
';
$lang['eventhelp-CategoryDeleted'] = '<p>Sent when a calendar category is deleted.</p>
<h4>Parameters</h4>
<ul>
<li>\&quot;category_id\&quot; - The category id</li>
<li>\&quot;category_name\&quot; - The category name</li>
<li>\&quot;category_order\&quot; - The category sort order</li>
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
$lang['cal_calendar'] = 'Takvim';
$lang['cal_default_templates'] = 'Default Templates';
$lang['cal_description'] = 'A&ccedil;ıklama';
$lang['cal_addevent'] = 'Add Event';
$lang['cal_import_events'] = 'Import Events';
$lang['cal_events'] = 'Events';
$lang['cal_categories'] = 'Categories';
$lang['cal_calendar_template'] = 'Calendar Templates';
$lang['cal_list_template'] = 'List Templates';
$lang['cal_upcominglist_template'] = 'Upcoming Templates';
$lang['cal_event_template'] = 'Event Templates';
$lang['cal_settings'] = 'Settings';
$lang['cal_prev'] = '&laquo; &Ouml;nceki';
$lang['cal_next'] = 'Sonraki &raquo;';
$lang['cal_categories_updated'] = 'Categories Updated';
$lang['cal_settings_updated'] = 'Settings Updated';
$lang['cal_add_event'] = 'Add Event';
$lang['cal_edit'] = 'D&uuml;zenle';
$lang['cal_delete'] = 'Sil';
$lang['cal_areyousure'] = 'Are you sure you want to delete';
$lang['cal_update_template'] = 'Update Template';
$lang['cal_sunday'] = 'Pazar';
$lang['cal_monday'] = 'Pazartesi';
$lang['cal_tuesday'] = 'Salı';
$lang['cal_wednesday'] = '&Ccedil;arşamba';
$lang['cal_thursday'] = 'Perşembe';
$lang['cal_friday'] = 'Cuma';
$lang['cal_saturday'] = 'Cumartesi';
$lang['cal_sun'] = 'Paz';
$lang['cal_mon'] = 'Pts';
$lang['cal_tues'] = 'Sal';
$lang['cal_wed'] = '&Ccedil;ar';
$lang['cal_thurs'] = 'Per';
$lang['cal_fri'] = 'Cum';
$lang['cal_sat'] = 'Cts';
$lang['cal_january'] = 'Ocak';
$lang['cal_february'] = 'Şubat';
$lang['cal_march'] = 'Mart';
$lang['cal_april'] = 'Nisan';
$lang['cal_may'] = 'Mayıs';
$lang['cal_june'] = 'Haziran';
$lang['cal_july'] = 'Temmuz';
$lang['cal_august'] = 'Ağustos';
$lang['cal_september'] = 'Eyl&uuml;l';
$lang['cal_october'] = 'Ekim';
$lang['cal_november'] = 'Kasım';
$lang['cal_december'] = 'Aralık';
$lang['cal_add'] = 'Ekle';
$lang['cal_update'] = 'G&uuml;ncelle';
$lang['cal_event'] = 'Event';
$lang['cal_date'] = 'Tarih';
$lang['cal_summary'] = '&Ouml;zet';
$lang['cal_details'] = 'Ayrıntılar';
$lang['cal_more'] = 'more >>';
$lang['cal_return'] = 'Return';
$lang['cal_to'] = 'to';
$lang['cal_past_events'] = 'Past Events';
$lang['cal_upcoming_events'] = 'Upcoming Events';
$lang['cal_any_category'] = 'Any Category';
$lang['cal_show_only_events_in'] = 'Show Only Events In';
$lang['cal_filter_by'] = 'Filter Title By <em>(regex)</em>';
$lang['cal_go'] = 'Git';
$lang['cal_title'] = 'Başlık';
$lang['cal_fromdate'] = 'From Date';
$lang['cal_todate'] = 'To Date';
$lang['cal_update_categories'] = 'Update Categories';
$lang['cal_language'] = 'Language';
$lang['cal_updatesettings'] = 'Update Settings';
$lang['cal_use_twelve_hour_clock'] = 'Use twelve hour clock on hour drop-downs?';
$lang['cal_default_category'] = 'Default Category';
$lang['cal_update_fields'] = 'Update Fields';
$lang['force_category'] = 'Force at least one category';
$lang['showpastyears'] = 'How many years in the past is allowed';
$lang['showfutureyears'] = 'How many year into the future is allowed';
$lang['hidesummary'] = 'Should the summary field be hidden';
$lang['hidecontent'] = 'Should the content field be hidden';
$lang['category_reminder'] = 'Please check one or more categories for this event';
$lang['module_example_stylesheet'] = 'Calendar CSS example';
$lang['error_permission'] = 'You need the appropriate permission (%s) to access this functionality';
$lang['install_postmessage'] = 'Make sure to set the &quot;Modify Calendar&quot; permission on users who will be administering calendar events.';
$lang['deletetagged'] = 'Delete tagged events';
$lang['confirmdeletetagged'] = 'Are you sure these events should be deleted?';
$lang['taggeddeleted'] = 'Tagged events successfully deleted';
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
$lang['updatetemplatesuccess'] = 'The template was updated successfully';
$lang['updatetemplatefailure'] = 'An error occurred updating the template';
$lang['settingssaved'] = 'Settings was saved successfully';
$lang['categorydeleted'] = 'Category deleted';
$lang['categoryupdated'] = 'Category updated';
$lang['categoryadded'] = 'Category added';
$lang['eventdeleted'] = 'The event was deleted';
$lang['eventupdated'] = 'The event was updated';
$lang['default_page_error'] = 'Error: You must set a default page in order to use Calendar with pretty URLs turned on. Please go to the Calendar settings tab and choose one.';
$lang['time_at'] = 'at';
$lang['type'] = 'Type';
$lang['name'] = 'Name';
$lang['order'] = 'Order';
$lang['fieldadded'] = 'Field Successfully Added';
$lang['fielddeleted'] = 'Field Deleted';
$lang['fields'] = 'Custom Fields';
$lang['textfield'] = 'Text Field';
$lang['uploadfield'] = 'File upload field';
$lang['description'] = '<p>Calendar is a module for displaying events on your page. When the
		module is installed, a Calendar admin page is added to the content menu
		that will allow you to manage your events.</p>';
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
$lang['help_template'] = '<p><b>Print Author Name:</b></p>
<code>Author: {$event.authorname}</code>
';
$lang['cal_help'] = '<h3>Notice:</h3>
<p>Version 1.0 of the Calendar module broke backward compatibility with previous versions.  Upgrading a previous installation of Calendar to this version is not possible.</p>
<h3>What does this do?</h3>
<p>Calendar is a module for displaying events on your page. When the
module is installed, a Calendar admin page is added to the plugins menu
that will allow you to manage your events.</p>
<h3>Security</h3>
<p>The user must belong to a group with the &#039;Modify Calendar&#039; permission
in order to add, edit, or delete calendar event entries.</p>
<h3>How do I use it?</h3>
<ol>
  <li>Put the cms_module tag in the page content. Make sure it is not enclosed in <pre>...</pre> tags.  You will need to view source code for this.  The code would look something like:<br />
  <tt>{cms_module module=&quot;Calendar&quot;}</tt><br />
  <li>Style the calendar appropriately for your display (an example stylesheet is provided for this purpose)</li>
</ol>
<br/>
<p><b>To attach the sample stylesheet to your template:</b></p>
<ol>
<li>Go to &quot;Layout -> Templates&quot;</li>
<li>Click the CSS icon (Attach Stylesheet to Template) button to the right of your template</li>
<li>Choose &quot;Calendar CSS example&quot; from the drop-down menu.</li>
<li>Click the &quot;Add a Stylesheet&quot; button.</li>
</ol>
<br/>
<h3>Parameters</h3>
<table border=0 cellpadding=3 cellspacing=0>
  <tr>
     <td>display</td>
     <td>Acceptable values:<br>
	 &quot;calendar&quot; - displays events for the current month in a traditional grid.  Inclues links to prev. and next months.<br/>
	 &quot;event&quot; - display a detail report for a specific event.  To use this display mode, the event_id parameter must be specified.<br/>
	 &quot;list&quot; - displays events for the current month as a list.  Includes links to prev. and next months.<br/>
	 &quot;yearlist&quot; - displays events for the current year in a list.  Includes links to prev. and next years.<br/>
	 &quot;pastlist&quot; - displays all past events.  No prev/next links.<br/>
	 &quot;upcominglist&quot; - displays all upcoming events.  No prev/next links.<br/>
		Defaults to &quot;calendar&quot; <em>(optional)</em>
     </td>
  </tr>

  <tr>
     <td>category</td>
     <td>Only display items for that category. Leaving unset, will show all categories. Note that
	 you can limit to muliple categories by separating each one with a comma.<em>(optional)</em></td>
  </tr>

  <tr>
     <td>month</td>
     <td>Display entries for a particular month. If year is not set, then the current year is
	 assumed. This option only works if display is set to &quot;list&quot; or &quot;calendar&quot;. <em>(optional)</em></td>
  </tr>

  <tr>
     <td>year</td>
     <td>Display entries for a particular year.
	This option only works if display is set to &quot;list&quot; or &quot;calendar&quot;. <em>(optional)</em></td>
  </tr>

  <tr>
     <td>limit</td>
     <td>Set to the maximum number of events to display. This option only works if display is set to &quot;list&quot;, &quot;pastlist&quot; or &quot;upcominglist&quot;. <em>(optional)</em></td>
  </tr>

  <tr>
     <td>first_day_of_week</td>
     <td>Set to the first day of the week as a number between 0 and 6 (0 = Sunday). Default is 1 (Monday).
	 This option only works if display is set to &quot;calendar&quot;. <em>(optional)</em></td>
  </tr>

  <tr>
     <td>summaries</td>
     <td>Set to 1 to display the summary information or 0 to not display it in calendar mode. Default is 1. <em>(optional)</em></td>
  </tr>

  <tr>
     <td>detail</td>
     <td>Set to 1 to display the detail information or 0 to not display it in list mode. Default is 0. <em>(optional)</em></td>
  </tr>

  <tr>
     <td>use_session</td>
     <td>Use a session variable to store the current month of the calendar. Default is true. <em>(optional)</em></td>
  </tr>

  <tr>
     <td>compact_view</td>
     <td>Set to 1 to hide the navigation links. Helpful to show current month&#039;s events on the home page. Default is 0. <em>(optional)</em></td>
  </tr>

  <tr>
     <td>inline</td>
     <td>Set to 0 to set all of the event links to inlined mode (they will replace the page content).  Default is 1. <em>(optional)</em></td>
  </tr>

  <tr>
     <td>reverse</td>
     <td>Set to true to display events in reverse chronological order. Applicable to list, pastlist and upcominglist displays. Default is false. For the pastlist, reverse=true is assumed.<em>(optional)</em></td>
  </tr>

  <tr>
     <td>detailpage=&quot;pagealias&quot;</td>
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
     <td>moretext</td>
     <td>Used in the various summary templates, this parameter allows specifying different text for the link to the event detail display.</td>
  </tr>
</table>

<h3>Custom Fields</h3>
<p>It is possible to define a number of custom fields to associate with each event using the Fields tab in the admin. Once one or more fields has been defined the values of that field for each event can be set using the events tab in the admin. These field values can be rendered using a template using the syntax event.fields.fieldname. Hint - insert {debug} into your template see all the data passed to the template.</p>

<h3>Examples</h3>
<h4>Example of allowing Comments on Calendar events</h4>
<p>Install the Comments module and put this in your Calendar &quot;Event Template&quot;:</p>
<pre>{cms_module module=&#039;comments&#039; modulename=&#039;Calendar&#039; pageid=$event.event_id}</pre>
<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>Discussion of this module may also be found in the <a href="http://forum.cmsmadesimple.org">CMS Made Simple Forums</a>.</li>
<li>The author, calguy1000, can often be found in the <a href="irc://irc.freenode.net/#cms">CMS IRC Channel</a>.</li>
<li>Lastly, you may have some success emailing the author directly.</li>  
</ul>
<h3>Copyright and License</h3>
<p>Copyright &copy; 2008, Robert Campbel <a href="mailto:calguy1000@cmsmadesimple.org"><calguy1000@cmsmadesimple.org></a>. All Rights Are Reserved.</p>
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
';
$lang['utma'] = '156861353.2134612077.1226434126.1227444283.1227741208.3';
$lang['utmz'] = '156861353.1227444284.2.2.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=cmsms';
$lang['utmb'] = '156861353.1.10.1227741208';
$lang['utmc'] = '156861353';
?>