<?php
$lang['friendlyname'] = 'Trin for trin basismodul';
$lang['postinstall'] = 'Husk at du skal s&aelig;tte flueben ved &quot;Use Skeletons&quot; under tilladelser f&oslash;r du kan anvende dette modul!';
$lang['postuninstall'] = '&Oslash;v udraderet igen!';
$lang['really_uninstall'] = 'Hvad? Er du helt sikker p&aring;, at du vil afinstallere dette modul?';
$lang['uninstalled'] = 'Modul afinstalleret.';
$lang['installed'] = 'Version %s af modulet installeret.';
$lang['prefsupdated'] = 'Indstillinger for modulet opdateret.';
$lang['submit'] = 'Gem';
$lang['accessdenied'] = 'Adgang n&aelig;gtet. Check venligst dine tilladelser.';
$lang['error'] = 'Fejl!';
$lang['link_view'] = 'Vis post';
$lang['edit'] = 'Rediger post';
$lang['title_num_records'] = '%s poster fundet.';
$lang['add_record'] = 'Tilf&oslash;j en ny post';
$lang['added_record'] = 'Post tilf&oslash;jet.';
$lang['updated_record'] = 'Post opdateret.';
$lang['upgraded'] = 'Modul opgraderet til version %s.';
$lang['title_allow_add'] = 'Brugere m&aring; tilf&oslash;je poster?';
$lang['title_allow_add_help'] = 'Klik her for at tillade brugere at tilf&oslash;je poster.';
$lang['title_mod_prefs'] = 'Indstillinger for modul';
$lang['title_general'] = 'Generel info';
$lang['title_description'] = 'Beskrivelse';
$lang['title_mod_admin'] = 'Administration af modul';
$lang['event_info_OnSkeletonPreferenceChange'] = 'En h&aelig;ndelse som udf&oslash;res n&aring;r indstillingerne for Skeleton modulet &aelig;ndres';
$lang['event_help_OnSkeletonPreferenceChange'] = '<p>En h&aelig;ndelse som udf&oslash;res n&aring;r indstillingerne for Skeleton modulet &aelig;ndres</p>
<h4>Parametre</h4>
<ul>
<li><em>allow_add</em> - Den nye indstilling for &quot;Tillad tilf&oslash;jelse&quot;; boolean</li>
</ul> 
';
$lang['moddescription'] = 'Dette modul g&oslash;r ikke noget i sig selv. Det danner blot fundamentet til et nyt modul.';
$lang['welcome_text'] = '<p>Velkommen til administrationsdelen af dette trin for trin baismodul. Der ville sikkert have v&aelig;ret noget andet her, hvis modulet rent faktisk gjorde noget. F&oslash;j det til de sider, som de bes&oslash;gende ser med koden {cms_module module=&#039;Skeleton&#039;}</p>';
$lang['changelog'] = '<ul>
<li>Version 1.5, juli 2007 SjG
<ul>
   <li>En rigtig databaseapplikation tilf&oslash;jet.</li>
   <li>Faneinddeling af administrationen.</li>
   <li>Opdateret minimum og maximum CMS versioner.</li>
</ul>
</li>
<li>Version 1.4, juni 2006 (calguy1000). 
  <ul>
    <li>DisplayAdminNav udskiftet med en enkelt fane</li>
    <li>Erstattet kald til DoAction med en viderestilling</li>
    <li>Skiftet minimum cms version til 1.0-svn</li>
  </ul>
</li>
<li>Version 1.3. juni 2006 (sjg). 
  <ul>
    <li>Metoder til installation, opgradering og afininstallation skilt fra hinanden</li>
    <li>Events tilf&oslash;jet</li>
    <li>Referencer til p&aelig;ne urls og omdirigering ved registrering</li>
    <li>Korrektion af strukturen i mappen med sprogfiler</li>
    <li>Flere kommentarer tilf&oslash;jet</li>
  </ul>
</li>
<li>Version 1.2. 29. december 2005. Rettet fejl som Patrick Loschmidt har gjort opm&aelig;rksom p&aring;. Updateringer gjort kompatible med CMS Made Simple version 0.11.x.</li>
<li>Version 1.1. 11. september 2005. Luet ud i referencer, som voldte problemer med PHP 4.4.x or 5.0.5.</li>
<li>Version 1.0. 6. august 2005. F&oslash;rste udgivelse.</li></ul>';
$lang['help'] = '<h3>Hvad kan dette modul?</h3>
<p>Ingenting. Det er t&aelig;nkt som et sted at starte, hvis du vil udvikle dine egne moduler.</p>
<h3>Hvordan bruger jeg det?</h3>
<p>Tjah, faktisk s&aring; kan du installere det ved at placere modulet p&aring; en side eller i en skabelon ved hj&aelig;lp af smarty tag&#039;en {cms_module module=&#039;Skeleton&#039;}</p>
<p>Det er imidlertid mere hensigtsm&aelig;ssigt at bruge modulet som et udgangspunkt og derp&aring; skrive den kode, som f&aring;r modulet til at g&oslash;re det, du vil have det til at g&oslash;re.</p>
<h3>Support</h3>
<p>Der f&oslash;lger ikke kommerciel support med dette modul. Dog findes der en r&aelig;kke ressourcer, som st&aring;r til r&aring;dighed med hj&aelig;lp:</p>
<ul>
<li>For nyeste version af dette modul, ofte stillede sp&oslash;rgsm&aring;l og rapportering af fejl bedes du bes&oslash;ge Module Forge
<a href="http://dev.cmsmadesimple.org/projects/skeleton/">Skeleton Page</a>.</li>
<li>Yderligere dr&oslash;ftelser vedr&oslash;rende dette modul forefindes i <a href="http://forum.cmsmadesimple.org">CMS Made Simples fora</a>.</li>
<li>Udvikleren, SjG, er ofte at finde p&aring; <a href="irc://irc.freenode.net/#cms">CMS IRC Channel</a>.</li>
<li>Endelig s&aring; kan du m&aring;ske have held med at kontakte udvikleren direkte per email.</li>  
</ul>
<p>Som det fremg&aring;r af GPL, s&aring; stilles denne software til r&aring;dighed i den stand, som det forefindes. L&aelig;s venligst licensteksten i sin helhed for at f&aring; alle betingelserne med.</p>

<h3>Copyright og licens</h3>
<p>Copyright &copy; 2008, Samuel Goldstein <a href="mailto:sjg@cmsmodules.com"><sjg@cmsmodules.com></a>. Alle rettigheder forbeholdes.</p>
<p>Dette modul er udgivet i henhold til <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. Du skal acceptere denne licens, f&oslash;r du bruger modulet.</p>
';
$lang['utma'] = '156861353.1094114404.1206635603.1216819460.1216822787.38';
$lang['utmz'] = '156861353.1216819460.37.30.utmccn=(referral)|utmcsr=dev.cmsmadesimple.org|utmcct=/users/azilgaard/|utmcmd=referral';
$lang['utmc'] = '156861353';
?>