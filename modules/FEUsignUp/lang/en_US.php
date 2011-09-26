<?php
$lang['friendlyname'] = 'FEUsignUp';
$lang['postuninstall'] = 'FEUsignUp module uninstalled successfully.';
$lang['really_uninstall'] = 'Really? Are you sure you want to \nuninstall this fine module?';
$lang['uninstalled'] = 'Module Uninstalled.';
$lang['installed'] = 'Module version %s installed.';
$lang['upgraded'] = 'Module upgraded to version %s.';
$lang['moddescription'] = 'Gives the ability to put together a sign-up for events to CGCalendar and Team Sport Scores';

$lang['error'] = 'Error!';
$land['admin_title'] = 'FEUsignUp Admin Panel';
$lang['admindescription'] = 'A dull admin description';
$lang['accessdenied'] = 'Access Denied. Please check your permissions.';
$lang['postinstall'] = 'Be sure to set "Use FEUsignUp" permissions to use this module!';

$lang['overview'] = 'Overview';
$lang['title_overview'] = 'Overview';
$lang['info_overview'] = '<p>Manage all your sign-up events from here. The list below shows only those events where someone has already signed up for.</p>';
$lang['no_signups'] = 'There are no signups!';

$lang['linkings'] = 'Linkings';
$lang['title_linkings'] = 'Linkings to Frontend User -groups';
$lang['info_linkings'] = '<p>Manage linkings between Frontend User -groups, CGCalendar categories and TeamSportScores teams.</p>';

$lang['template_displayevent'] = 'Template: Display events';
$lang['title_template_displayevent'] = 'Template: Display events';
$lang['info_template_displayevent'] = '<p>Manage the template used to display your events on the front end.</p>';


## Linkings-tab stuff
$lang['linking_updated'] = 'Linking has been updated.';
$lang['linking_added'] = 'A new linking has been added.';
$lang['linking_deleted'] = 'The linking was deleted.';
$lang['prompt_addlink'] = 'Add a new link';
$lang['prompt_feugroup'] = 'Link Frontend Users -group';
$lang['prompt_cgcal_category'] = 'to CGCalendar category';
$lang['prompt_tss_team'] = 'or TeamSportScores team';
$lang['prompt_description'] = 'Description for this linking:';
$lang['submit_new_link'] = 'Submit a new link';
$lang['submit_existing_link'] = 'Update the link';

## Lists in admin-area
$lang['th_id'] = 'ID';
$lang['th_feug'] = 'FEU-group';
$lang['th_cgcc'] = 'CGCalendar category';
$lang['th_tsst'] = 'TSS-team';
$lang['th_desc'] = 'Description';
$lang['th_feu'] = 'Username';
$lang['th_event'] = 'Event';
$lang['th_date'] = 'Date';
$lang['th_signed_up'] = 'IN/OUT';
$lang['edit'] = 'Edit';

## Sorting of signups
$lang['filter_and_sort'] = 'Filter or sort events';
$lang['filter_by_from'] = 'Show events from';
$lang['input_from'] = 'cgcal/tss-input';
$lang['show_both'] = 'Show both';
$lang['filter_by_event_id'] = 'Show only signups, which have an <em>event with ID</em> (leave empty for all)';
$lang['input_event_id'] = 'id-input';
$lang['filter_by_in_or_out'] = 'Show only IN/OUT';
$lang['input_in_or_out'] = 'in/out-input';
#$lang['show_both']
$lang['sort_by'] = 'Sort the list by this';
$lang['input_sort_by'] = 'sortby-input';
$lang['sort_by_id'] = 'ID';
$lang['sort_by_username'] = 'Username';
$lang['sort_by_event'] = 'Event ID';
$lang['sort_by_date'] = 'Date';
$lang['input_sort_order'] = 'asc/desc-input';
$lang['in_ascending_order'] = 'in Ascending order';
$lang['in_descending_order'] = 'in Descending order';
$lang['submit_filter_and_sort'] = 'Filter and sort';
$lang['reset_sorting'] = 'Show all';

## Listing of signups
$lang['select_page'] = 'Select page';
$lang['from_calendar'] = 'Calendar event [%s]: ';
$lang['from_tss'] = 'Match [%s]: ';
$lang['event_time_format'] = '%A, %m/%d/%y — %H:%M';

## Editing an existing link
$lang['prompt_editlink'] = 'Update linking';
$lang['cancel'] = 'Cancel';
$lang['delete'] = 'Delete';
$lang['areyousure_dellink'] = 'Are you sure you want to delete this linking?';

$lang['nothing_updated'] = 'Nothing was updated.';

## Empty values
$lang['no_tss_game'] = '-NO GAME-';
$lang['no_cgc_event'] = '-NO EVENT-';

## Templates
$lang['defaults'] = 'Reset defaults';
$lang['submit'] = 'Submit';
$lang['success_defaults'] = 'Defaults reset successfully';
$lang['success_template'] = 'Template saved successfully';

$lang['error-no_id_given'] = 'You didn\'t give an id for CGCalendar or Team Sport Scores!';
$lang['db_error'] = 'Database error!';

## Update-action
$lang['update_failed'] = 'Signing up failed!';
$lang['update_failed_no_in_or_out'] = 'Signing up failed! One needs to be either IN or OUT.';
$lang['event_not_found'] = 'No event found!';
$lang['not_admin'] = 'You have no rights to modify this!';
$lang['user_not_found_by_id'] = 'Username with ID %s was not found from the database!';
$lang['signup_updated'] = 'Signup updated!';

## Editing a signup
$lang['areyousure_delsignup'] = 'Are you sure you want to delete this signup?';
$lang['signup_deleted'] = 'Signup deleted successfully.';

## Other
$lang['module_error'] = 'Error in FEUsignUp module! Please report this incident to the webmaster.';

$lang['copyright'] = '<p>Copyright &copy; 2011, VesQ <a href="mailto:laakso.vesa@gmail.com">&lt;laakso.vesa@gmail.com&gt;</a>. All Rights Are Reserved.</p>';

$lang['changelog'] = '<ul>
<li>Version 0.0.1 - 8 April 2011. Initial Release.</li>
</ul>';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>Gives the ability to put together a sign-up for events to CGCalendar and Team Sport Scores</p>
<h3>How Do I Use It</h3>
<p>[FIX-ME!]</p>
<h3>What Parameters Does It Take</h3>
<p>[FIX-ME!]</p>
<h3>Support</h3>
<p>As per the GPL, this software is provided as-is. Please read the text of the license for the full disclaimer.</p>
<h3>Copyright and License</h3>
<p>Copyright &copy; 2011, VesQ <a href="mailto:laakso.vesa@gmail.com">&lt;laakso.vesa@gmail.com&gt;</a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>';


## EOF