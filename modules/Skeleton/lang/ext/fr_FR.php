<?php
$lang['friendlyname'] = 'Pedantic Skeleton Module ';
$lang['postinstall'] = 'Message post-installation. conseil : soyez sur d&#039;attribuer les permissions &quot;Use Skeletons&quot; pour utiliser ce module !';
$lang['postuninstall'] = 'Message post-d&eacute;sinstallation, e.g., &quot;Curses! Foiled Again!&quot;';
$lang['really_uninstall'] = '\312tes-vous s\373r de vouloir d\351sinstaller ce super module ?';
$lang['uninstalled'] = 'Le module a &eacute;t&eacute; d&eacute;sinstall&eacute; avec succ&egrave;s.';
$lang['installed'] = 'Module install&eacute; en version %s.';
$lang['prefsupdated'] = 'Pr&eacute;ferences du module mise &agrave; jour.';
$lang['submit'] = 'Sauvegarder';
$lang['accessdenied'] = 'Acc&eacute;s Interdit. V&eacute;rifier vos permissions.';
$lang['error'] = 'Erreur !';
$lang['link_view'] = 'Voir l&#039;enregistrement';
$lang['edit'] = 'Editer l&#039;enregistrement';
$lang['title_num_records'] = '%s enregistrements trouv&eacute;s.';
$lang['add_record'] = 'Ajouter un enregistrement';
$lang['added_record'] = 'Enregistrement ajout&eacute;';
$lang['updated_record'] = 'Enregistrement mis &agrave; jour.';
$lang['upgraded'] = 'le module a &eacute;t&eacute; mis &agrave; jour &agrave; la %s.';
$lang['title_allow_add'] = 'Les utilisateurs peuvent ajouter des enregistrements ?';
$lang['title_allow_add_help'] = 'Cliquez ici pour permettre aux utilisateurs d&#039;ajouter des enregistrements.';
$lang['title_mod_prefs'] = 'Pr&eacute;ferences du module';
$lang['title_general'] = 'Information g&eacute;n&eacute;rales';
$lang['title_description'] = 'Description ';
$lang['title_explanation'] = 'Longue Description';
$lang['title_mod_admin'] = 'Panneau d&#039;administration du module';
$lang['dash_record_count'] = 'Ce module g&egrave;re %s enregistrements';
$lang['alert_no_records'] = 'Il n&#039;y a pas eu d&#039;enregistrements ajout&eacute;s dans le module Skeleton !';
$lang['help_skeleton_id'] = 'Identificateur interne de s&eacute;lection des enregistrements';
$lang['help_description'] = 'Param&egrave;tres internes utilis&eacute;s lors de la cr&eacute;ation d&#039;un nouvel enregistrement';
$lang['help_explanation'] = 'Param&egrave;tre interne utilis&eacute; pour passer des informations explicatives lorsque l&#039;on cr&eacute;&eacute; ou l&#039;on met &agrave; jour un enregistrement';
$lang['help_module_message'] = 'Param&egrave;tre interne utilis&eacute; pour la transmission des messages &agrave; l&#039;utilisateur';
$lang['event_info_OnSkeletonPreferenceChange'] = 'Un &eacute;v&eacute;nement g&eacute;n&eacute;r&eacute; lorsque les pr&eacute;f&eacute;rences du module Skeleton sont chang&eacute;es';
$lang['event_help_OnSkeletonPreferenceChange'] = '<p>An event generated when the preferences to the Skeleton Module get changed</p>
<h4>Parameters</h4>
<ul>
<li><em>allow_add</em> - The new setting of the &quot;Allow Add&quot; preference; boolean</li>
</ul> 
';
$lang['moddescription'] = 'Ce module est le module skeleton qui ne fait rien.';
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
<li>Version 1.0. 6 August 2005. Initial Release.</li></ul>';
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
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>

';
$lang['utma'] = '156861353.1949673112.1265210769.1285941058.1286179019.190';
$lang['utmz'] = '156861353.1286179019.190.38.utmccn=(referral)|utmcsr=cmsmadesimple.fr|utmcct=/index.php|utmcmd=referral';
$lang['qca'] = 'P0-1075820551-1265210768764';
$lang['utmb'] = '156861353';
$lang['utmc'] = '156861353';
?>