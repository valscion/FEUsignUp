<?php
$lang['friendlyname'] = 'Pedantic Skeleton Modul';
$lang['postinstall'] = 'Etter installereingsmelding, , Husk &aring; sette &quot;Use Skeletons&quot; rettigheter for &aring; bruke modulen!';
$lang['postuninstall'] = 'Etter installereingsmelding, , &quot;Curses! Foiled Again!&quot;';
$lang['really_uninstall'] = 'Virkelig? Du er sikker p&aring; at du vil avinstallere denne fine modulen?';
$lang['uninstalled'] = 'Modul avinstallert.';
$lang['installed'] = 'Modul versjon %s installert.';
$lang['prefsupdated'] = 'Modul innstillinger oppdaterte.';
$lang['submit'] = 'Lagre';
$lang['accessdenied'] = 'Adgang nektet. Vennligst sjekk dine rettigheter.';
$lang['error'] = 'Feil!';
$lang['link_view'] = 'Vis post';
$lang['edit'] = 'Rediger post';
$lang['title_num_records'] = '%s poster funnet.';
$lang['add_record'] = 'Legg til en post';
$lang['added_record'] = 'Post lagt til.';
$lang['updated_record'] = 'Post oppdatert.';
$lang['upgraded'] = 'Modul oppgradert til versjon %s.';
$lang['title_allow_add'] = 'Kan brukere legge til poster?';
$lang['title_allow_add_help'] = 'Klikk her for &aring; la brukere legge til psoter.';
$lang['title_mod_prefs'] = 'Modul innstillinger';
$lang['title_general'] = 'Generell info';
$lang['title_description'] = 'Beskrivelse';
$lang['title_explanation'] = 'Lang beskrivelse';
$lang['title_mod_admin'] = 'Modul Administrasjonpanel';
$lang['dash_record_count'] = 'Denne modulen h&aring;nterer %s poster';
$lang['alert_no_records'] = 'Det har ikke blitt lagt til noen poster i Skeleton modulen!';
$lang['help_skeleton_id'] = 'Intern identifier for &aring; velge poster';
$lang['help_description'] = 'Intern parameter benyttet n&aring;r ny post opprettes';
$lang['help_explanation'] = 'Intern parameter benyttet for &aring; sende forklaringsinfo n&aring;r en oppretter eller redigerer en post';
$lang['help_module_message'] = 'Intern parameter som benyttes for &aring; sende meldinger til brukeren';
$lang['event_info_OnSkeletonPreferenceChange'] = 'En hendelse generert n&aring;r  instillingene til Skeleton Modulen endres';
$lang['event_help_OnSkeletonPreferenceChange'] = '<p>En hendelse generert n&aring;r innstillingene til Skeleton Modulen endres</p>
<h4>Parametere</h4>
<ul>
<li><em>sing_loudly</em> - Den nye innstillingen til &quot;Sing Loudly&quot; innstillingen; boolean</li>
</ul> 
';
$lang['moddescription'] = 'Denne modul er en skjelett modul som gj&oslash;r ingenting.';
$lang['welcome_text'] = '<p>Welcome to the Pedantic Skeleton Module admin section. Something else would probably go here
if the module actually did something. Add it to your front-end pages with a {Skeleton}</p>';
$lang['changelog'] = '<ul>
<li>Version 1.8, Sep 2010 SjG
<ul>
<li>Added an additional field to database records to make it more interesting.</li>
<li>Implemented PrettyURLs</li>
<li>Updated for CMSMS 1.9 and for inclusion in <em>CMS Developer&#039;s Cookbook</em></li>
</ul></li>
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
<li>Version 1.0. 6 August 2005. Initial Release.</li></ul>se.</li></ul>';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>Nothing. It&#039;s designed to be a starting point for you to develop your own modules.</p>
<h3>How Do I Use It</h3>
<p>Well, you could actually install it by placing the module in a page or template using the
smarty tag &amp;#123;Skeleton}</p>
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
<p>Copyright &amp;copy; 2010, Samuel Goldstein <a href="mailto:sjg@cmsmodules.com">&amp;lt;sjg@cmsmodules.com&amp;gt;</a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>';
$lang['utmz'] = '156861353.1288991067.3364.78.utmccn=(referral)|utmcsr=cmsmadesimple.org|utmcct=/about-link/special-fans-listing/|utmcmd=referral';
$lang['utma'] = '156861353.179052623084110100.1210423577.1289518923.1289601433.3376';
$lang['qca'] = '1210971690-27308073-81952832';
$lang['utmb'] = '156861353.7.10.1289601433';
$lang['utmc'] = '156861353';
?>