<?php
$lang['friendlyname'] = 'Skeleton-Modul';
$lang['postinstall'] = 'Anzeige nach Installation, z. Bsp. &quot;Stellen sie sicher, dass zur Verwendung dieses Moduls die Berechtigung &quot;Use Skeletons&quot; gesetzt wurde!';
$lang['postuninstall'] = 'Anzeige nach Deinstallation, z.Bsp. &quot;So ein Mist! Wieder nichts!&quot;';
$lang['really_uninstall'] = 'Wirklich? Sie wollen dieses wunderbare Modul deinstallieren?';
$lang['uninstalled'] = 'Modul deinstalliert.';
$lang['installed'] = 'Modulversion %s installiert.';
$lang['prefsupdated'] = 'Moduleinstellungen aktualisiert.';
$lang['submit'] = 'Speichern';
$lang['accessdenied'] = 'Zugriff verweigert. Bitte pr&uuml;fen Sie Ihre Berechtigungen.';
$lang['error'] = 'Fehler!';
$lang['link_view'] = 'Datensatz anzeigen ';
$lang['edit'] = 'Datensatz bearbeiten';
$lang['title_num_records'] = '%s Datens&auml;tze gefunden';
$lang['add_record'] = 'Einen Datensatz hinzuf&uuml;gen';
$lang['added_record'] = 'Datensatz hinzugef&uuml;gt';
$lang['updated_record'] = 'Datensatz aktualisiert';
$lang['upgraded'] = 'Modul auf Version %s aktualisiert.';
$lang['title_allow_add'] = 'Sollen Anwender Datens&auml;tze hinzuf&uuml;gen k&ouml;nnen?';
$lang['title_allow_add_help'] = 'Klicken Sie hier, um Anwendern das Hinzuf&uuml;gen von Datens&auml;tzen zu erlauben.';
$lang['title_mod_prefs'] = 'Moduleinstellungen';
$lang['title_general'] = 'Allgemeine Information';
$lang['title_description'] = 'Beschreibung';
$lang['title_explanation'] = 'Detaillierte Beschreibung';
$lang['title_mod_admin'] = 'Modul-Administration';
$lang['dash_record_count'] = 'This module handles %s records';
$lang['alert_no_records'] = 'There have not been any records added in the Skeleton module!';
$lang['help_skeleton_id'] = 'Internally identifier for selecting records';
$lang['help_description'] = 'Internal parameter used when creating a new record';
$lang['help_explanation'] = 'Internal parameter used to pass explanation info when creating or editing a record';
$lang['help_module_message'] = 'Internally used parameter for passing messages to user';
$lang['event_info_OnSkeletonPreferenceChange'] = 'Ausf&uuml;hren, wenn die Einstellungen des Skeleton-Moduls ge&auml;ndert wurden';
$lang['event_help_OnSkeletonPreferenceChange'] = '<p>Ausf&uuml;hren, wenn die Einstellungen des Skeleton-Moduls ge&auml;ndert wurden</p>
<h4>Parameter</h4>
<ul>
<li><em>allow_add</em> - The new setting of the &quot;Allow Add&quot; preference; boolean</li>
</ul> 
';
$lang['moddescription'] = 'Dieses Modul ist ein Vorlagemodul und macht nichts.';
$lang['welcome_text'] = '<p>Willkommen in der Administration des Skeleton-Moduls. Weitere Dinge w&uuml;rden hier stehen, wenn das Modul wirklich etwas tun w&uuml;rde.</p>';
$lang['changelog'] = '<ul>
<li>Version 1.7, Sep 2009 SjG, Cleaned up, and modernized a bit.</li>
<li>Version 1.6, Nov 2008 SjG, added parameter sanitizing for Nuno</li><li>Version 1.5, July 2007 SjG
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
$lang['help'] = '<h3>What Does This Do?</h3>
<p>Nothing. It&#039;s designed to be a starting point for you to develop your own modules.</p>
<h3>How Do I Use It</h3>
<p>Well, you could actually install it by placing the module in a page or template using the smarty tag {cms_module module=&#039;Skeleton&#039;}</p>
<p>You would be wiser, however, to use the module as a starting point, and editing the code to do whatever it is you are wanting to do.</p>
<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module, FAQs, or to file a Bug Report or buy commercial support, please visit SjG&#039;s
module homepage at <a href=&amp;amp;quot;http://www.cmsmodules.com&amp;amp;quot;>CMSModules.com</a>.</li>
<li>Additional discussion of this module may also be found in the <a href=&amp;amp;quot;http://forum.cmsmadesimple.org&amp;amp;quot;>CMS Made Simple Forums</a>.</li>
<li>The author, SjG, can often be found in the <a href=&amp;amp;quot;irc://irc.freenode.net/#cms&amp;amp;quot;>CMS IRC Channel</a>.</li>
<li>Lastly, you may have some success emailing the author directly.</li>  
</ul>
<p>As per the GPL, this software is provided as-is. Please read the text
of the license for the full disclaimer.</p>

<h3>Copyright and License</h3>
<p>Copyright &copy; 2006, Samuel Goldstein <a href=&amp;amp;quot;mailto:sjg@cmsmodules.com&amp;amp;quot;><sjg@cmsmodules.com></a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href=&amp;amp;quot;http://www.gnu.org/licenses/licenses.html#GPL&amp;amp;quot;>GNU Public License</a>. You must agree to this license before using the module.</p>
';
$lang['utma'] = '156861353.879842947.1296663469.1296663469.1296663469.1';
$lang['utmb'] = '156861353';
$lang['utmc'] = '156861353';
$lang['utmz'] = '156861353.1296663469.1.1.utmccn=(direct)|utmcsr=(direct)|utmcmd=(none)';
?>