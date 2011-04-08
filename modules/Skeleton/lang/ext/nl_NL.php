<?php
$lang['friendlyname'] = 'Pedantic Skeleton Module ';
$lang['postinstall'] = 'Vergeet niet uw &quot;Use Skeletons&quot; rechten in te stellen voor deze module!';
$lang['postuninstall'] = 'Post Uninstall Message, e.g., &quot;Curses! Foiled Again!&quot;';
$lang['really_uninstall'] = 'Echt? Weet u zeker dat u deze mooie module wilt verwijderen?';
$lang['uninstalled'] = 'Module gede&iuml;nstalleerd';
$lang['installed'] = 'Module versie %s geinstalleerd';
$lang['prefsupdated'] = 'Module instellingen bijgewerkt';
$lang['submit'] = 'Opslaan';
$lang['accessdenied'] = 'Toegang geweigerd. Bekijk uw bevoegdheden.';
$lang['error'] = 'Fout!';
$lang['link_view'] = 'Bekijk Record';
$lang['edit'] = 'Wijzig Record';
$lang['title_num_records'] = '%s records gevonden.';
$lang['add_record'] = 'Record Toevoegen';
$lang['added_record'] = 'Record Toegevoegd.';
$lang['updated_record'] = 'Record Bijgewerkt.';
$lang['upgraded'] = 'Module bijgewerkt naar versie %s.';
$lang['title_allow_add'] = 'Gebruikers mogen records toevoegen?';
$lang['title_allow_add_help'] = 'Klik hier om gebruikers toe te staan om records toe te voegen.';
$lang['title_mod_prefs'] = 'Moduleinstellingen';
$lang['title_general'] = 'Algemene Informatie';
$lang['title_description'] = 'Omschrijving';
$lang['title_explanation'] = 'Lange omschrijving';
$lang['title_mod_admin'] = 'Module Beheer Paneel ';
$lang['dash_record_count'] = 'Deze module verwerkt %s records';
$lang['alert_no_records'] = 'Er zijn geen records toegevoegd aan de Skeleton module!';
$lang['help_skeleton_id'] = 'Interne identificatie voor het selecteren van records';
$lang['help_description'] = 'Interne parameter gebruikt voor het aanmaken van een nieuwe record';
$lang['help_explanation'] = 'Interne parameter gebruikt om uitleg te versturen bij het maken of wijzigen van een record';
$lang['help_module_message'] = 'Intern gebruikte parameter om berichten uit te wisselen tussen gebruikers';
$lang['event_info_OnSkeletonPreferenceChange'] = 'Een gebeurtenis gegenereerd wanneer de instellingen van de Skeleton Module zijn gewijzigd';
$lang['event_help_OnSkeletonPreferenceChange'] = '<p>An event generated when the preferences to the Skeleton Module get changed</p>
<h4>Parameters </h4>
<ul>
<li><em>allow_add</em> - The new setting of the &quot;Allow Add&quot; preference; boolean</li>
</ul> 
';
$lang['moddescription'] = 'Deze module is een skeleton module die zelf niets doet.';
$lang['welcome_text'] = '<p>Welcome to the Pedantic Skeleton Module admin section. Something else would probably go here
if the module actually did something. Add it to your front-end pages with a {Skeleton}</p>';
$lang['changelog'] = '<ul>
<li>Version 1.7, Sep 2009 SjG, Cleaned up, and modernized a bit.</li>
<li>Version 1.6, Nov 2008 SjG, added parameter sanitizing for Nuno</li>
<li>Version 1.5, July 2007 SjG
<ul>
   <li>Added actual database app.</li>
   <li>Made Admin tabbed for interest.</li>
   <li>Updated Minimum and Maximum CMS versions.</li>
</ul>
</li>
<li>Version 1.4, June 2006 (calguy1000). 
  <ul>
    <li>Replaced DisplayAdminNav with a single tab</li>
    <li>Replaced call to DoAction with a Redirect</li>
    <li>Changed minimum cms version to 1.0-svn</li>
  </ul>
</li>
<li>Version 1.3. June 2006 (sjg). 
  <ul>
    <li>Split out install, upgrade, and uninstall methods</li>
    <li>Added Events</li>
    <li>Added references to pretty urls and route registration</li>
    <li>corrected language file directory structure</li>
    <li>added more comments</li>
  </ul>
</li>
<li>Version 1.2. 29 December 2005. Fixes to bugs pointed out by Patrick Loschmidt. Updates to be correct for CMS Made Simple versions 0.11.x.</li>
<li>Version 1.1. 11 September 2005. Cleaned up references that caused problems for PHP 4.4.x or 5.0.5.</li>
<li>Version 1.0. 6 August 2005. Initial Release.</li></ul>';
$lang['help'] = '<h3>What Does This Do? </h3>
<p>Nothing. It&#039;s designed to be a starting point for you to develop your own modules.</p>
<h3>How Do I Use It</h3>
<p>Well, you could actually install it by placing the module in a page or template using the
smarty tag {cms_module module=&#039;Skeleton&#039;}</p>
<p>You would be wiser, however, to use the module as a starting point, and editing the code to do
whatever it is you are wanting to do.</p>
<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module, FAQs, or to file a Bug Report, please visit the Module Forge
<a href="http://dev.cmsmadesimple.org/projects/skeleton/">Skeleton Page</a>.</li>
<li>Additional discussion of this module may also be found in the <a href="http://forum.cmsmadesimple.org">CMS Made Simple Forums</a>.</li>
<li>The author, SjG, can often be found in the <a href="irc://irc.freenode.net/#cms">CMS IRC Channel</a>.</li>
<li>Lastly, you may have some success emailing the author directly.</li>  
</ul>
<p>As per the GPL, this software is provided as-is. Please read the text
of the license for the full disclaimer.</p>

<h3>Copyright and License</h3>
<p>Copyright &copy; 2008, Samuel Goldstein <a href="mailto:sjg@cmsmodules.com"><sjg@cmsmodules.com></a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>
';
$lang['qca'] = 'P0-1530922099-1275938006999';
$lang['utma'] = '156861353.1240338921.1276019969.1285953846.1286048273.89';
$lang['utmz'] = '156861353.1285953846.88.65.utmcsr=forum.cmsmadesimple.org|utmccn=(referral)|utmcmd=referral|utmcct=/index.php';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353';
?>