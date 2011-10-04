<?php
$lang['param_nocache'] = 'Brukes hvis caching av modulkall er aktivert, da vil denne parameteren deaktivere mellomlagring av denne modulens kall. Denne parameteren er nyttig';
$lang['info_cache_modulecalls'] = 'EKSPERIMENTELL: Under visse omstendigheter, kan resultat av kall til moduler bufres. Aktivering av denne kan ha en betydelig ytelsesforbedring for webomr&aring;det ditt. Imidlertid kan det f&oslash;re til vanskeligheter med noen kall. Du kan deaktivere dette alternativet ved &aring; legge til parameteren nocache=1 i modulkallet';
$lang['cache_modulecalls'] = 'Mellomlagring av modul kall';
$lang['cache_halfhour'] = 'En halv time';
$lang['cache_1hr'] = 'En time';
$lang['cache_2hrs'] = 'To timer';
$lang['cache_6hrs'] = 'Seks timer';
$lang['cache_12hrs'] = 'Tolv timer';
$lang['cache_24hrs'] = 'En dag';
$lang['cache_noexpiry'] = 'Ikke tillat tidsutl&oslash;p (benytt med forsiktighet)';
$lang['cache_filelock'] = 'L&aring;s filer for &aring; unng&aring; problem med konkurerende tilgang';
$lang['cache_autoclean'] = 'Rens automatisk utl&oslash;pte mellomlagringsfiler';
$lang['cache_lifetime'] = 'Mellomlagring livstid (sekunder)';
$lang['cache_settings'] = 'Mellomlagringsinstillinger';
$lang['error_image_transform'] = 'Feil i omgj&oslash;ring av bildet';
$lang['prompt_delete_orig_image'] = 'Fjern det orginale bildet etter innledende skalering og vannmerking?';
$lang['info_imageextensions'] = 'Oppgi en kommaseparert liste med filendelser som angir bildefiler som er egnede for skalering, vannmerking, og &aring; lage miniatyrbilder av. <strong>Merk:</strong> Moduler som bruker CGExtensions opplastingsegenskap kan overstyre disse innstillingene.';
$lang['allowed_upload_filetypes'] = 'Filendelser for filer som f&aring;r lastes opp';
$lang['info_allowed_upload_filetypes'] = 'Oppgi en kommaseparert liste med filendelser som angir filer som f&aring;r lastes opp. <strong>Merk:</strong> Moduler som bruker CGExtensions opplastingsegenskap kan overstyre disse innstillingene';
$lang['resize_image_to'] = 'Maksimal st&oslash;rrelse p&aring; det skalerte bildet';
$lang['resizing'] = 'Bildeskalering';
$lang['prompt_allow_resizing'] = 'Skaler opplastede bilder?';
$lang['thumbnailing'] = 'Miniatyrbilde:';
$lang['prompt_allow_thumbnailing'] = 'Opprett miniatyrbilder fra opplastede bilder?';
$lang['info_graphicssettings'] = 'Denne fanen tillater konfigurering av standard oppf&oslash;rsel for moduler som benytter CGExtensions funksjonaliteten for opplasting av bilder. Funksjonaliteten inkluderer automatisk skalering av innkommende bilde, vannmerking og oppretting av miniatyrbilde';
$lang['prompt_allow_watermarking'] = 'Vannmerk opplastede bilder?';
$lang['info_sysdefault_templates'] = 'Denne malen definerer standard innhold for en mal n&aring;r du oppretter en ny mal av denne typen. &Aring; endre dette innholdet vil ikke ha umiddelbar effekt p&aring; ditt nettsted.';
$lang['available'] = 'Tilgjengelig';
$lang['selected'] = 'Valgt';
$lang['up'] = 'Opp';
$lang['down'] = 'Ned';
$lang['sortablelist_templates'] = 'Sorterbare Listeomr&aring;de maler';
$lang['default_templates'] = 'Standard maler';
$lang['sysdflt_sortablelist_template'] = 'System standard sorterbar listemal';
$lang['info_sysdefault_template'] = 'System standard maler blir benyttet n&aring;r det opprettes en ny malen en bestemt type. &Aring; endre verdiene her vil kun ha effekt n&aring;r n&aring;r du lager en ny mal i en annen fane';
$lang['watermarkerror_1000'] = 'Vannmerking er ikke tilstrekkelig konfigurert';
$lang['watermarkerror_1001'] = 'D&aring;rlig eller korrupt fil spesifisert for vannmerking';
$lang['watermarkerror_1002'] = 'Filtype st&oslash;ttes ikke';
$lang['watermarkerror_1003'] = 'Ingen fil spesifisert for vannmerking';
$lang['watermarkerror_1004'] = 'Problem med &aring; lage vannmerkebilde';
$lang['watermarkerror_1005'] = 'Problem med &aring; laste bilde for vannmerking';
$lang['watermarkerror_1006'] = 'Annen vannmerkefeil';
$lang['translucency'] = 'Gjennomskinnelighet';
$lang['watermark_alignment'] = 'Juster alle vannmerker til denne relative posisjonen';
$lang['align_ul'] = 'Topp venstre';
$lang['align_uc'] = 'Topp senter';
$lang['align_ur'] = 'Topp h&oslash;yre';
$lang['align_ml'] = 'Midten venstre';
$lang['align_mc'] = 'Senter';
$lang['align_mr'] = 'Midten h&oslash;yre';
$lang['align_ll'] = 'Bunn venstre';
$lang['align_lc'] = 'Bunn senter';
$lang['align_lr'] = 'Bunn h&oslash;yre';
$lang['use_transparency'] = 'Benytt Transparens';
$lang['background_color'] = 'Bakgrunnsfarge';
$lang['none'] = 'Ingen';
$lang['image'] = 'Bilde';
$lang['text_color'] = 'Tekstfarge';
$lang['rgb_colors'] = '#F0F8FF-AliceBlue,
#FAEBD7-AntiqueWhite,
#00FFFF-Aqua,
#7FFFD4-Aquamarine,
#F0FFFF-Azure,
#F5F5DC-Beige,
#FFE4C4-Bisque,
#FFEBCD-BlanchedAlmond,
#000000-Black,
#0000FF-Blue,
#8A2BE2-BlueViolet,
#A52A2A-Brown,
#DEB887-BurlyWood,
#5F9EA0-CadetBlue,
#7FFF00-Chartreuse,
#D2691E-Chocolate,
#FF7F50-Coral,
#6495ED-CornflowerBlue,
#FFF8DC-Cornsilk,
#DC143C-Crimson,
#00FFFF-Cyan,
#00008B-DarkBlue,
#008B8B-DarkCyan,
#B8860B-DarkGoldenRod,
#A9A9A9-DarkGray,
#006400-DarkGreen,
#BDB76B-DarkKhaki,
#8B008B-DarkMagenta,
#556B2F-DarkOliveGreen,
#FF8C00-Darkorange,
#9932CC-DarkOrchid,
#8B0000-DarkRed,
#E9967A-DarkSalmon,
#8FBC8F-DarkSeaGreen,
#483D8B-DarkSlateBlue,
#2F4F4F-DarkSlateGray,
#00CED1-DarkTurquoise,
#9400D3-DarkViolet,
#FF1493-DeepPink,
#00BFFF-DeepSkyBlue,
#696969-DimGray,
#1E90FF-DodgerBlue,
#D19275-Feldspar,
#B22222-FireBrick,
#FFFAF0-FloralWhite,
#228B22-ForestGreen,
#FF00FF-Fuchsia,
#DCDCDC-Gainsboro,
#F8F8FF-GhostWhite,
#FFD700-Gold,
#DAA520-GoldenRod,
#808080-Gray,
#008000-Green,
#ADFF2F-GreenYellow,
#F0FFF0-HoneyDew,
#FF69B4-HotPink,
#CD5C5C-IndianRed,
#4B0082-Indigo,
#FFFFF0-Ivory,
#F0E68C-Khaki,
#E6E6FA-Lavender,
#FFF0F5-LavenderBlush,
#7CFC00-LawnGreen,
#FFFACD-LemonChiffon,
#ADD8E6-LightBlue,
#F08080-LightCoral,
#E0FFFF-LightCyan,
#FAFAD2-LightGoldenRodYellow,
#D3D3D3-LightGrey,
#90EE90-LightGreen,
#FFB6C1-LightPink,
#FFA07A-LightSalmon,
#20B2AA-LightSeaGreen,
#87CEFA-LightSkyBlue,
#8470FF-LightSlateBlue,
#778899-LightSlateGray,
#B0C4DE-LightSteelBlue,
#FFFFE0-LightYellow,
#00FF00-Lime,
#32CD32-LimeGreen,
#FAF0E6-Linen,
#FF00FF-Magenta,
#800000-Maroon,
#66CDAA-MediumAquaMarine,
#0000CD-MediumBlue,
#BA55D3-MediumOrchid,
#9370D8-MediumPurple,
#3CB371-MediumSeaGreen,
#7B68EE-MediumSlateBlue,
#00FA9A-MediumSpringGreen,
#48D1CC-MediumTurquoise,
#C71585-MediumVioletRed,
#191970-MidnightBlue,
#F5FFFA-MintCream,
#FFE4E1-MistyRose,
#FFE4B5-Moccasin,
#FFDEAD-NavajoWhite,
#000080-Navy,
#FDF5E6-OldLace,
#808000-Olive,
#6B8E23-OliveDrab,
#FFA500-Orange,
#FF4500-OrangeRed,
#DA70D6-Orchid,
#EEE8AA-PaleGoldenRod,
#98FB98-PaleGreen,
#AFEEEE-PaleTurquoise,
#D87093-PaleVioletRed,
#FFEFD5-PapayaWhip,
#FFDAB9-PeachPuff,
#CD853F-Peru,
#FFC0CB-Pink,
#DDA0DD-Plum,
#B0E0E6-PowderBlue,
#800080-Purple,
#FF0000-Red,
#BC8F8F-RosyBrown,
#4169E1-RoyalBlue,
#8B4513-SaddleBrown,
#FA8072-Salmon,
#F4A460-SandyBrown,
#2E8B57-SeaGreen,
#FFF5EE-SeaShell,
#A0522D-Sienna,
#C0C0C0-Silver,
#87CEEB-SkyBlue,
#6A5ACD-SlateBlue,
#708090-SlateGray,
#FFFAFA-Snow,
#00FF7F-SpringGreen,
#4682B4-SteelBlue,
#D2B48C-Tan,
#008080-Teal,
#D8BFD8-Thistle,
#FF6347-Tomato,
#40E0D0-Turquoise,
#EE82EE-Violet,
#D02090-VioletRed,
#F5DEB3-Wheat,
#FFFFFF-White,
#F5F5F5-WhiteSmoke,
#FFFF00-Yellow,
#9ACD32-YellowGreen';
$lang['info_watermarks'] = 'Vannmerking er en metode for &aring; unng&aring; bildetyveri. Enten et bilde, eller en spesifisert tekst blir lagt p&aring; toppen av opplastet bilde. Hvis et grafisk vannmerke ikke er angitt, eller ikke kan finnes, og tekstinnstillingene er angitt, vil disse bli brukt for vannmerking av bilder';
$lang['text_watermarks'] = 'Tekstbaserte vannmerker';
$lang['graphic_watermarks'] = 'Grafiske vannmerker';
$lang['watermarking'] = 'Vannmerking';
$lang['watermark_text'] = 'Vannmerke tekst';
$lang['font'] = 'Font ';
$lang['font_size'] = 'Fontst&oslash;rrelse';
$lang['text_angle'] = 'Tekstvinkel';
$lang['general_settings'] = 'Generelle innstillinger';
$lang['graphics_settings'] = 'Grafikk innstillinger';
$lang['CGFILEUPLOAD_NOFILE'] = 'Ingen av de opplastede filene passer til kriteriene';
$lang['CGFILEUPLOAD_FILESIZE'] = 'St&oslash;rrelsen p&aring; den opplastede filen overstiger det som er tillatt';
$lang['CGFILEUPLOAD_FILETYPE'] = 'Filer av denne type kan ikke lastes opp';
$lang['CGFILEUPLOAD_FILEEXISTS'] = 'En fil med samme navn eksisterer allerede';
$lang['CGFILEUPLOAD_BADDESTDIR'] = 'Destinasjonskatalogen som er spesifisert for opplastede filer eksisterer ikke';
$lang['CGFILEUPLOAD_BADPERMS'] = 'Filtillatelsene tillater ikke &aring; lagre den opplastede fila p&aring; det oppgitte m&aring;let';
$lang['CGFILEUPLOAD_MOVEFAILED'] = 'Fors&oslash;ket p&aring; &aring; flytte den opplastede fila til sitt endelige m&aring;l mislyktes.';
$lang['CGFILEUPLOAD_PREPROCESSING_FAILED'] = 'Forprosessering av den opplastede filen feilet';
$lang['thumbnail_size'] = 'St&oslash;rrelse p&aring; miniatyrbilder';
$lang['image_extensions'] = 'Bilde filendelser';
$lang['group'] = 'Gruppe';
$lang['template'] = 'Mal';
$lang['select_one'] = 'Velg en';
$lang['priority_countries'] = 'Prioriterte land';
$lang['prompt_edittemplate'] = 'Rediger mal';
$lang['prompt_deletetemplate'] = 'Slett mal';
$lang['prompt_templatename'] = 'Mal navn';
$lang['prompt_template'] = 'Mal tekst';
$lang['prompt_name'] = 'Mal navn';
$lang['prompt_newtemplate'] = 'Ny mal';
$lang['prompt_default'] = 'Standard';
$lang['yes'] = 'Ja';
$lang['no'] = 'Nei';
$lang['submit'] = 'Lagre';
$lang['apply'] = 'Bruk';
$lang['cancel'] = 'Avbryt';
$lang['edit'] = 'Rediger';
$lang['areyousure'] = 'Er du sikker?';
$lang['resettofactory'] = 'Tilbakestill til standard';
$lang['error_template'] = 'Feilmal';
$lang['error_templatenameexists'] = 'En mal med det navnet eksisterer allerede';
$lang['friendlyname'] = 'Calguys Module Extensions ';
$lang['postinstall'] = 'Denne modulen er ferdig til bruk. Kod i vei!';
$lang['postuninstall'] = 'Ser deg igjen en annen dag';
$lang['uninstalled'] = 'Modul avinstallert';
$lang['installed'] = 'Modul versjon %s installert';
$lang['prefsupdated'] = 'Modul innstillinger oppdatert.';
$lang['accessdenied'] = 'Tilgang nektet. Vennligst sjekk dine rettigheter.';
$lang['error'] = 'Feil!';
$lang['upgraded'] = 'Modul oppgradert til versjon %s.';
$lang['moddescription'] = 'Denne modulen er et bibliotek av php klasser brukt til &aring; bygge avanserte skjemaer';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>This module merely provides convenience api&#039;s, re-usable forms, and smarty tags for use in other modules.  It is meant solely from which to build other modules. If you are not a programmer you probably won&#039;t need to do anything with this module besides adjust some preferences.</p>
<h3 style=\&quot;color: #f00;\&quot;>Notes</h3>
<p>Many modules take advantages of the forms that are provided by the CGExtensions module to assist in managing templates.  When they do, the CGExtensions module information is displayed prominently.  However when you submit, or cancel from these forms you will be returned to the original module.</p>
<h3>How Do I Use It</h3>
<p>Well, you start your own module (I suggest starting with the Skeleton module), and then when you need to use an advanced form object from this library, simply make your module dependant upon FormObjects, and then instantiate an object of the appropriate type.  See the code inside the FormObjects directory for usage instructions.</p>
<h3>Smarty Addons</h3>
<p>This module adds a few smarty conveniences for use with other modules. They are listed and described here:</p>
<ul>
<li><u>cgerror - <em>block</em> plugin</u>
<p>Description: This block plugin uses the error template (configurable from the CGExtensions admin interface) to display an error message.</p>
<p>optional parameters: &#039;errorclass&#039; = override the default class name in the template.</p>
<p>i.e: <code>{cgerror}This is error text{/cgerror}</code><br/>
    or: <code>{cgerror}{$errortextvar}{/cgerror}</br>
</p>
</li>
<li><u>{cge_isbot [assign=name]}</u> - <em>function</em> plugin
<p>Description: A plugin to detect wether the request is from a robot.<p>
<p>i.e: <code>{cg_isbot assign=&#039;isbot&#039;}{if $isbot}&amp;lt;h3&amp;gt;You are a bot&amp;lt;/h3&amp;gt;{/if}</code></p>
</li>
<li><u>{cge_is_smartphone [assign=name]}</u> - <em>function</em> plugin
<p>Description: A plugin to detect wether the request is from a smart phone such as an iphone or android.<p>
<p>i.e: <code>{cg_is_smartphone assign=&#039;isbot&#039;}{if $isbot}&amp;lt;h3&amp;gt;I should do some funky mobile styling here.&amp;lt;/h3&amp;gt;{/if}</code></p>
</li>
<li><u>cge_state_options - <em>function</em> plugin</u>
<p>Description: Output a set of &amp;lt;option&amp;gt; tags for states.  The values are US/Canada State/Province abbreviations, the labels are the full length names in english.  This method reads the defined state list as defined in the database.</p>
<p>i.e: <code>&amp;lt;select name=&quot;foo&quot;&amp;gt;{cge_state_options selected=&amp;quot;ab&amp;quot;}&amp;lt;/select&amp;gt;</code></p>
</li>
<li><u>cge_country_options - <em>block</em> plugin</u>
<p>Description: Output a set of &amp;lt;options&amp;gt; tags for countries.  The values are approved country codes, the labels are the full length names (in english).  This method reads the country list as defined in the database, and takes into account the priority countries as defined in the CGExtensions admin console.</p>
<p>i.e: <code>&amp;lt;select name=&amp;quot;foo&amp;quot;{cge_country_options selected=&amp;quot;us&amp;quot;}&amp;lt;/select&amp;gt;</code></p>
</li>
<li><u>get_current_url - <em>function</em> plugin</u>
<p>Description: Return the current page url.</p>
<p>Optional Parameters: &#039;assign&#039; = assign the output to the named smarty variable.</p>
<p>i.e: <code>{get_current_url assign=&amp;quot;cur_url&amp;quot;}{$cur_url}</code></p>
</li>
<li><u>cge_yesno_options - <em>function</em> plugin</u>
<p>Description: Output options for a dropdown list that allows selecting two options, &amp;quot;Yes&amp;quot; or &amp;quot;No&amp;quot;.  This plugin will output the &amp;lt;option&amp;gt tags using localized strings for the labels, and integers for the values.</p>
<p>Optional Parameters:
  <ul>
    <li>&amp;quot;prefix&amp;quot; - A prefix to place before the name attribute on the tag.  i.e: prefix=$actionid</li>
    <li>&amp;quot;name&amp;quot; - A name for the select list, if this parameter is specified the system will generate a complete &amp;lt;select&amp;gt; tag.  Otherwise, only &amp;lt;option&amp;gt; tags will be generated.</li>
    <li>&amp;quot;selected&amp;quot; - The value of the currently selected element (either 0 or 1)</li>
    <li>&amp;quot;assign&amp;quot; - Assign the output html code to a newly generated smarty variable.</li>
  </ul>
</p>
<br/>
<p>i.e: <code>{cge_yesno_options prefix=\$actionid name=&amp;quot;send_mail&amp;quot; selected=$send_mail}</code></p>
</li>
<li><u>cge_have_module - <em>function</em> plugin</u>
  <p>Description: Output a boolean (0 or 1) value if a module is installed and ready to use.</p>
  <p>Optional Parameters:
     <ul>
       <li>&amp;quot;m&amp;quot;|&amp;quot;mod&amp;quot;|&amp;quot;module&amp;quot; - Specify the module name</lI>
       <li>&amp;quot;assign&amp;quot; - Assign the output html code to a newly generated smarty variable.</li>
     </ul>
  </p>
<br/>
<p>i.e: <code>{cge_have_module module=&amp;quot;FrontEndUsers&amp;quot assign=&amp;quot;have_feu&amp;quot;}</code></p>
</li>
<li><u>cgimage - <em>function</em> plugin</u>
  <p>Description: Output an image tag, This plugin is typically used in admin templates, as it automatically searches in the admin theme, and in registered icon directories.</p>
  <p>Required Parameters:
    <ul>
      <li>&amp;quot;image&amp;quot; - The filename of the image.  You may specify a filename, or a path relative to the admin theme&amp;quot;s images directory.</li>
    </ul>
  </p>
  <br/>
  <p>Optional Parameters:
    <ul>
      <li>&amp;quot;alt&amp;quot; - Specify alt text for the image.  If not specified, the value of the image parameter will be used.</li>
      <li>&amp;quot;class&amp;quot; - Specify a class for the image tag.</li>
      <li>&amp;quot;width&amp;quot; - Specify an integer width for the image tag.</li>
      <li>&amp;quot;height&amp;quot; - Specify an integer height for the image tag.</li>
      <li>&amp;quot;assign&amp;quot; - Assign the output html code to a newly generated smarty variable.</li>
    </ul>
  </p>
  <br/>
  <p>See also:  CGExtensions->AddImageDir()</p>
  <p>i.e: <code>{cgimage image=&amp;quot;icons/system/newobject.gif&amp;quot;}</code></p>
</li>
<li><u>rfc_date - <em>modifier</em> plugin</u>
<p>Description: Format a supplied time in an RFC consistent manner.  This modifier is particularly useful when generating RSS feeds.</p>
<p>i.e: <code>{$smarty.now|rfc_date}</code></p>
</li>
<li><u>jsmin - <em>block</em> plugin</u>
  <p>Description: Pass content through the javascript minifier.</p>
  <p>Note: You must specify the approprate {literal},{/literal},{ldelim|, and {rdelim} inside the block to allow smarty to process or ignore the code.</p>
  <p>i.e:  <code>{jsmin}&amp;lt;script type=&quot;text/javascript&quot;&amp;gt;// alot of javascript code here&amp;lt;/script&amp;gt;{/jsmin}</code></p>
</li>
<li><u>cge_textarea - <em>block</em> plugin</u>
  <p>Description: Create a text area tag, with optional support for wysiwyg editor.  This tag is typically used in admin templates to create text areas.</p>
  <p>Required Parameters:
    <ul>
      <li>&amp;quot;prefix&amp;quot; - A string to prefix the textarea element name.  i.e: {$actionid}</li>
      <li>&amp;quot;name&amp;quot; - The element name.</li>
    </ul>
  </p>
  <br/>
  <p>Optional Parameters:
    <ul>
      <li>&amp;quot;wysiwyg&amp;quot; - An integer value to indicate wether a wysiwyg should be applied (the actual wysiwyg that is used depends on CMSMS site preferrences and user preferences.</li>
      <li>&amp;quot;content&amp;quot; - The content for the text area.</li>
      <li>&amp;quot;class&amp;quot; - An optional class to supply to the text area tag.</li>
      <li>&amp;quot;assign&amp;quot; - Assign the output html code to a newly generated smarty variable.</li>
    </ul>
  </p>
  <br/>
  <p>i.e: <code>{cge_textarea prefix=$actionid name=&amp;quot;description&amp;quot; content=$description wysiwyg=1}</code></p>
</li>
<li><u>cge_str_to_assoc - <em>function</em> plugin</u>
  <p>Description: Convert url parameter type string to an associative array.</p>
  <p>Required Parameters:
    <ul>
      <li>&amp;quot;input&amp;quot; - The input string</li>
    </ul>
  </p>
  <br/>
  <p>Optional Parameters:
    <ul>
      <li>&amp;quot;delim1&amp;quot; - Delimiter for separating the string into a list of variables.  Defaults to &amp;quot;,&amp;quot;</li>
      <li>&amp;quot;delim2&amp;quot; - Delimiter for separating variable into a variable name and value.  Defaults to &amp;quot;=&amp;quot;</li>
      <li>&amp;quot;assign&amp;quot; - Assign the output html code to a newly generated smarty variable.</li>
    </ul>
  </p>
  <br/>
  <p>i.e: <code>{cge_str_to_assoc input=&amp;quot;var1=val1,var2=val2,var3=val3&amp;quot; assign=&amp;quot;tmp&amp;quot;}</code></p>
</li>
<li><u>cge_cache - <em>block</em> plugin</u>
  <p>Description: Cache html outout between start and end blocks for performance. By default content between the start and end tags is cached to files in the tmp/cache directory for a period of five minutes.  Later versions of this plugin will allow extending the cache lifetime.</p>
  <p><strong>Note:</strong> This is not technically a block plugin, but does behave like one.</p>
  <p><strong>Note:</strong> This is an advanced plugin that can dramatically improve the average performance of your (primarily static) website, though it should be used with caution as using it incorrectly can cause strange behaviour on your site.  This functionality works best when wrapped around smarty tags that query the database and generate static html content.  This plugin should not be used around dynamic functionality or forms.</p>
  <p><strong>Note:</strong> This plugin utilizes file locking to prevent race conditions.  This may present problems on different platforms.  Use this plugin with caution.</p>
  <pp>i.e: <code>{cge_cache}{Products}{/cge_cache}</code></p>
</li>
</ul>
<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module, FAQs, or to file a Bug Report or buy commercial support, please visit the cms development forge at <a href=\"http://dev.cmsmadesimple.org\">dev.cmsmadesimple.org</a>.</li>
<li>Additional discussion of this module may also be found in the <a href=\"http://forum.cmsmadesimple.org\">CMS Made Simple Forums</a>.</li>
<li>The author(s), calguy et all can often be found in the <a href=\"irc://irc.freenode.net/#cms\">CMS IRC Channel</a>.</li>
<li>Lastly, you may have some success emailing the author(s) directly.</li>  
</ul>
<p>As per the GPL, this software is provided as-is. Please read the text
of the license for the full disclaimer.</p>

<h3>Copyright and License</h3>
<p>Copyright &amp;copy; 2008, Robert Campbel <a href=\"mailto:calguy1000@cmsmadesimple.org\">&amp;lt;calguy1000@cmsmadesimple.org&amp;gt;</a>. All Rights Are Reserved.</p>
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
Or read it <a href=\"http://www.gnu.org/licenses/licenses.html#GPL\">online</a></p>

<h3>What Does This Do?</h3> <p>This module merely provides convenience api&#039;s, re-usable forms, and smarty tags for use in other modules. It is meant solely from which to build other modules. If you are not a programmer you probably won&#039;t need to do anything with this module besides adjust some preferences.</p> <h3 style=\&quot;color: #f00;\&quot;>Notes</h3> <p>Many modules take advantages of the forms that are provided by the CGExtensions module to assist in managing templates. When they do, the CGExtensions module information is displayed prominently. However when you submit, or cancel from these forms you will be returned to the original module.</p> <h3>How Do I Use It</h3> <p>Well, you start your own module (I suggest starting with the Skeleton module), and then when you need to use an advanced form object from this library, simply make your module dependant upon FormObjects, and then instantiate an object of the appropriate type. See the code inside the FormObjects directory for usage instructions.</p> <h3>Smarty Addons</h3> <p>This module adds a few smarty conveniences for use with other modules. They are listed and described here:</p> <ul> <li><u>cgerror - <em>block</em> plugin</u> <p>Description: This block plugin uses the error template (configurable from the CGExtensions admin interface) to display an error message.</p> <p>optional parameters: &#039;errorclass&#039; = override the default class name in the template.</p> <p>i.e: <code>{cgerror}This is error text{/cgerror}</code><br/> or: <code>{cgerror}{$errortextvar}{/cgerror}</br> </p> <li><u>cge_state_options - <em>function</em> plugin</u> <p>Description: Output a set of &amp;lt;option&amp;gt; tags for states. The values are US/Canada State/Province abbreviations, the labels are the full length names in english. This method reads the defined state list as defined in the database.</p> <p>i.e: <code>&amp;lt;select name=&quot;foo&quot;&amp;gt;{cge_state_options selected=&amp;quot;ab&amp;quot;}&amp;lt;/select&amp;gt;</code></p> </li> <li><u>cge_country_options - <em>block</em> plugin</u> <p>Description: Output a set of &amp;lt;options&amp;gt; tags for countries. The values are approved country codes, the labels are the full length names (in english). This method reads the country list as defined in the database, and takes into account the priority countries as defined in the CGExtensions admin console.</p> <p>i.e: <code>&amp;lt;select name=&amp;quot;foo&amp;quot;{cge_country_options selected=&amp;quot;us&amp;quot;}&amp;lt;/select&amp;gt;</code></p> </li> <li><u>get_current_url - <em>function</em> plugin</u> <p>Description: Return the current page url.</p> <p>Optional Parameters: &#039;assign&#039; = assign the output to the named smarty variable.</p> <p>i.e: <code>{get_current_url assign=&amp;quot;cur_url&amp;quot;}{$cur_url}</code></p> </li> <li><u>cge_yesno_options - <em>function</em> plugin</u> <p>Description: Output options for a dropdown list that allows selecting two options, &amp;quot;Yes&amp;quot; or &amp;quot;No&amp;quot;. This plugin will output the &amp;lt;option&amp;gt tags using localized strings for the labels, and integers for the values.</p> <p>Optional Parameters: <ul> <li>&amp;quot;prefix&amp;quot; - A prefix to place before the name attribute on the tag. i.e: prefix=$actionid</li> <li>&amp;quot;name&amp;quot; - A name for the select list, if this parameter is specified the system will generate a complete &amp;lt;select&amp;gt; tag. Otherwise, only &amp;lt;option&amp;gt; tags will be generated.</li> <li>&amp;quot;selected&amp;quot; - The value of the currently selected element (either 0 or 1)</li> <li>&amp;quot;assign&amp;quot; - Assign the output html code to a newly generated smarty variable.</li> </ul> </p> <br/> <p>i.e: <code>{cge_yesno_options prefix=\$actionid name=&amp;quot;send_mail&amp;quot; selected=$send_mail}</code></p> </li> <li><u>cge_have_module - <em>function</em> plugin</u> <p>Description: Output a boolean (0 or 1) value if a module is installed and ready to use.</p> <p>Optional Parameters: <ul> <li>&amp;quot;m&amp;quot;|&amp;quot;mod&amp;quot;|&amp;quot;module&amp;quot; - Specify the module name</lI> <li>&amp;quot;assign&amp;quot; - Assign the output html code to a newly generated smarty variable.</li> </ul> </p> <br/> <p>i.e: <code>{cge_have_module module=&amp;quot;FrontEndUsers&amp;quot assign=&amp;quot;have_feu&amp;quot;}</code></p> </li> <li><u>cgimage - <em>function</em> plugin</u> <p>Description: Output an image tag, This plugin is typically used in admin templates, as it automatically searches in the admin theme, and in registered icon directories.</p> <p>Required Parameters: <ul> <li>&amp;quot;image&amp;quot; - The filename of the image. You may specify a filename, or a path relative to the admin theme&amp;quot;s images directory.</li> </ul> </p> <br/> <p>Optional Parameters: <ul> <li>&amp;quot;alt&amp;quot; - Specify alt text for the image. If not specified, the value of the image parameter will be used.</li> <li>&amp;quot;class&amp;quot; - Specify a class for the image tag.</li> <li>&amp;quot;width&amp;quot; - Specify an integer width for the image tag.</li> <li>&amp;quot;height&amp;quot; - Specify an integer height for the image tag.</li> <li>&amp;quot;assign&amp;quot; - Assign the output html code to a newly generated smarty variable.</li> </ul> </p> <br/> <p>See also: CGExtensions->AddImageDir()</p> <p>i.e: <code>{cgimage image=&amp;quot;icons/system/newobject.gif&amp;quot;}</code></p> </li> <li><u>rfc_date - <em>modifier</em> plugin</u> <p>Description: Format a supplied time in an RFC consistent manner. This modifier is particularly useful when generating RSS feeds.</p> <p>i.e: <code>{$smarty.now|rfc_date}</code></p> </li> <li><u>jsmin - <em>block</em> plugin</u> <p>Description: Pass content through the javascript minifier.</p> <p>Note: You must specify the approprate {literal},{/literal},{ldelim|, and {rdelim} inside the block to allow smarty to process or ignore the code.</p> <p>i.e: <code>{jsmin}&amp;lt;script type=&quot;text/javascript&quot;&amp;gt;// alot of javascript code here&amp;lt;/script&amp;gt;{/jsmin}</code></p> </li> <li><u>cge_textarea - <em>block</em> plugin</u> <p>Description: Create a text area tag, with optional support for wysiwyg editor. This tag is typically used in admin templates to create text areas.</p> <p>Required Parameters: <ul> <li>&amp;quot;prefix&amp;quot; - A string to prefix the textarea element name. i.e: {$actionid}</li> <li>&amp;quot;name&amp;quot; - The element name.</li> </ul> </p> <br/> <p>Optional Parameters: <ul> <li>&amp;quot;wysiwyg&amp;quot; - An integer value to indicate wether a wysiwyg should be applied (the actual wysiwyg that is used depends on CMSMS site preferrences and user preferences.</li> <li>&amp;quot;content&amp;quot; - The content for the text area.</li> <li>&amp;quot;class&amp;quot; - An optional class to supply to the text area tag.</li> <li>&amp;quot;assign&amp;quot; - Assign the output html code to a newly generated smarty variable.</li> </ul> </p> <br/> <p>i.e: <code>{cge_textarea prefix=$actionid name=&amp;quot;description&amp;quot; content=$description wysiwyg=1}</code></p> </li> <li><u>cge_str_to_assoc - <em>function</em> plugin</u> <p>Description: Convert url parameter type string to an associative array.</p> <p>Required Parameters: <ul> <li>&amp;quot;input&amp;quot; - The input string</li> </ul> </p> <br/> <p>Optional Parameters: <ul> <li>&amp;quot;delim1&amp;quot; - Delimiter for separating the string into a list of variables. Defaults to &amp;quot;,&amp;quot;</li> <li>&amp;quot;delim2&amp;quot; - Delimiter for separating variable into a variable name and value. Defaults to &amp;quot;=&amp;quot;</li> <li>&amp;quot;assign&amp;quot; - Assign the output html code to a newly generated smarty variable.</li> </ul> </p> <br/> <p>i.e: <code>{cge_str_to_assoc input=&amp;quot;var1=val1,var2=val2,var3=val3&amp;quot; assign=&amp;quot;tmp&amp;quot;}</code></p> </li> <li><u>cge_cache - <em>block</em> plugin</u> <p>Description: Cache html outout between start and end blocks for performance. By default content between the start and end tags is cached to files in the tmp/cache directory for a period of five minutes. Later versions of this plugin will allow extending the cache lifetime.</p> <p><strong>Note:</strong> This is not technically a block plugin, but does behave like one.</p> <p><strong>Note:</strong> This is an advanced plugin that can dramatically improve the average performance of your (primarily static) website, though it should be used with caution as using it incorrectly can cause strange behaviour on your site. This functionality works best when wrapped around smarty tags that query the database and generate static html content. This plugin should not be used around dynamic functionality or forms.</p> <p><strong>Note:</strong> This plugin utilizes file locking to prevent race conditions. This may present problems on different platforms. Use this plugin with caution.</p> <pp>i.e: <code>{cge_cache}{Products}{/cge_cache}</code></p> </li> </ul> <h3>Support</h3> <p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p> <ul> <li>For the latest version of this module, FAQs, or to file a Bug Report or buy commercial support, please visit the cms development forge at <a href=\"http://dev.cmsmadesimple.org\">dev.cmsmadesimple.org</a>.</li> <li>Additional discussion of this module may also be found in the <a href=\"http://forum.cmsmadesimple.org\">CMS Made Simple Forums</a>.</li> <li>The author(s), calguy et all can often be found in the <a href=\"irc://irc.freenode.net/#cms\">CMS IRC Channel</a>.</li> <li>Lastly, you may have some success emailing the author(s) directly.</li> </ul> <p>As per the GPL, this software is provided as-is. Please read the text of the license for the full disclaimer.</p> <h3>Copyright and License</h3> <p>Copyright &amp;copy; 2008, Robert Campbel <a href=\"mailto:calguy1000@cmsmadesimple.org\">&amp;lt;calguy1000@cmsmadesimple.org&amp;gt;</a>. All Rights Are Reserved.</p> <p>This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.</p> <p>However, as a special exception to the GPL, this software is distributed as an addon module to CMS Made Simple. You may not use this software in any Non GPL version of CMS Made simple, or in any version of CMS Made simple that does not indicate clearly and obviously in its admin section that the site was built with CMS Made simple.</p> <p>This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA Or read it <a href=\"http://www.gnu.org/licenses/licenses.html#GPL\">online</a></p>
﻿';
$lang['qca'] = 'P0-536849115-1307983495210';
$lang['utma'] = '156861353.1728621158.1311531024.1311531024.1311531024.1';
$lang['utmz'] = '156861353.1311531024.1.1.utmcsr=forum.cmsmadesimple.org|utmccn=(referral)|utmcmd=referral|utmcct=/';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353.9.10.1311531024';
?>