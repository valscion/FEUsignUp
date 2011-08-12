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
$lang['th_cgc_event'] = 'CGCalendar event';
$lang['th_tss_game'] = 'TSS game';
$lang['th_signed_up'] = 'IN/OUT';
$lang['edit'] = 'Edit';

## Editing an existing link
$lang['prompt_editlink'] = 'Update linking';
$lang['cancel'] = 'Cancel';
$lang['delete'] = 'Delete';
$lang['areyousure'] = 'Are you sure you want to delete this linking?';

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
$lang['update_failed'] = '<p class="error">Signing up failed!</p>';
$lang['update_failed_no_in_or_out'] = '<p class="error">Signing up failed! One needs to be either IN or OUT.</p>';
$lang['event_not_found'] = '<p class="error">No event found!</p>';
$lang['not_admin'] = '<p class="error">You have no rights to modify this!</p>';
$lang['user_not_found_by_id'] = '<p class="error">Username with ID %s was not found from the database!</p>';

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