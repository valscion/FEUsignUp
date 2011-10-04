<?php
$lang['info_ignore_userid'] = 'Om valgt s&aring; vil importrutinen fors&oslash;ke &aring; legge til brukere uavhengig av brukerid kolonnen. Hvis en bruker eksisterer allerede med navnet som er angitt i importfilen, vil en feilmelding bli generert';
$lang['ignore_userid'] = 'Ignorer UserID kolonnen ved import';
$lang['export_passhash'] = 'Eksporter passord hash til filen';
$lang['info_export_passhash'] = 'Passordet hash er bare nyttig hvis passord salt p&aring; import-verten er identisk med eksport-verten';
$lang['error_adjustsalt'] = 'Passord salt kan ikke endres';
$lang['prompt_pwsalt'] = 'Passord salt';
$lang['info_pwsalt'] = 'FrontEndUsers salter alle passord med denne n&oslash;kkelen som er opprettet ved installasjon. N&aring;r brukerne har blitt lagt til databasen s&aring; kan salt ikke endres. Saltet kan v&aelig;re tomt for eldre installasjoner.';
$lang['advanced_settings'] = 'Avanserte innstillinger';
$lang['info_sessiontimeout'] = 'Angi antall sekunder f&oslash;r en inaktiv bruker automatisk blir logget ut av nettstedet';
$lang['prompt_expireusers_interval'] = 'Bruker utl&oslash;ps intervall';
$lang['info_expireusers_interval'] = 'Angi en verdi (i sekunder) som viser hvor ofte systemet skal tvinge brukere hvor sesjonen har utl&oslash;pt &aring; bli logget ut. Dette er en optimalisering for &aring; lagre databasesp&oslash;rringer. Dersom satt tomt eller satt til 0 - utl&oslash;p vil bli utf&oslash;rt p&aring; hver foresp&oslash;rsel.';
$lang['msg_settingschanged'] = 'Dine innstillinger ble vellykket lagret';
$lang['forcedlogouttask_desc'] = 'Tving brukere til &aring; logge ut p&aring; gitte intervaller';
$lang['prompt_forcelogout_times'] = 'Tider for tvunget utlogging';
$lang['info_forcelogout_times'] = 'Angi en kommaseparert liste med tider som HH:MM,HH:MM hvor brukerne vil bli tvangs utlogget. Merk, bruker dette psuedocron mekanismen s&aring; du m&aring; v&aelig;re sikker p&aring; at de tidene oppgitt her vil falle rimelig sammen med &quot;pseudocron granularitet&quot; og at nok foresp&oslash;rsler vil oppst&aring; til ditt nettsted for &aring; sikre at pseudocron utf&oslash;res.';
$lang['prompt_forcelogout_sessionage'] = 'Ekskludere brukere som har v&aelig;rt aktive i <em>(minutter)</em>';
$lang['info_forcelogout_sessionage'] = 'Hvis spesifisert, vil alle brukere som har v&aelig;rt aktive i dette antallet sekunder ikke bli tvangs utlogget';
$lang['areyousure_delete'] = 'Er du sikker p&aring; at du vil slette brukeren %s';
$lang['error_invalidfileextension'] = 'Den opplastede filen passer ikke til listen med tillatte filtyper';
$lang['postuninstall'] = 'Alle data assosiert med FrontEndUsers modulen har blitt slettet';
$lang['info_ecomm_paidregistration'] = 'Om sl&aring;tt p&aring;, s&aring; vil denne modulen lytte p&aring; handlinger fra Ecommerce suiten. De f&oslash;lgende innstillingene har kun effekt om denne innstillingen er p&aring;sl&aring;tt.';
$lang['prompt_ecomm_paidregistration'] = 'Lytt p&aring; Order handlinger';
$lang['info_paidreg_settings'] = 'De f&oslash;lgende innstillingene gjelder bare hvis du bruker Selvregistrering(Self Registration) og tillater Betalt p&aring;melding';
$lang['none'] = 'Ingen';
$lang['delete_user'] = 'Slett bruker';
$lang['expire_user'] = 'Tidsutl&oslash;p bruker';
$lang['prompt_action_ordercancelled'] = 'Handling &aring; utf&oslash;re n&aring;r en abonnementbestilling er kansellert';
$lang['prompt_action_orderdeleted'] = 'Handling &aring; utf&oslash;re n&aring;r en abonnementordre er slettet';
$lang['ecommerce_settings'] = 'Ecommerce innstillinger';
$lang['securefieldmarker'] = 'Sikkert felt mark&oslash;r';
$lang['securefieldcolor'] = 'Sikkert felt farge';
$lang['prompt_encrypt'] = 'Lagre disse data kryptert i databasen';
$lang['error_notsupported'] = 'Den valgte opsjonen er ikke st&oslash;ttet med din n&aring;v&aelig;rende konfigurasjon';
$lang['audit_user_created'] = 'Bruker automatisk opprettet';
$lang['info_auto_create_unknown'] = 'Om en bruker er identifisert av en ekstern identifikasjonsmodul, men ikke er kjent i FrontEndUsers modulen - skal da en FEU-konto opprettes automatisk?';
$lang['prompt_auto_create_unknown'] = 'Opprett automatisk ukjente brukere';
$lang['display_settings'] = 'Visningsinnstillinger';
$lang['info_std_auth_settings'] = 'Den f&oslash;lgende innstillingen er kun gyldig om &quot;Innebygd identifikasjon&quot; er benyttet.';
$lang['info_support_lostun'] = '&Aring; velge Nei vi sl&aring; av muligheten for en bruker til &aring; be om glemt innloggingsinformasjon, uavhengig av andre innstillinger';
$lang['info_support_lostpw'] = '&Aring; velge Nei vil sl&aring; av muligheten for en bruker til &aring; be om tilbakestilling av passord, uavhengig av andre innstillinger';
$lang['prompt_support_lostun'] = 'Tillat brukere &aring; be om sitt brukernavn';
$lang['prompt_support_lostpw'] = 'Tillat brukere &aring; be om passordendring';
$lang['auth_settings'] = 'Identifikasjonsinnstillinger';
$lang['authentication'] = 'Innebygd identifikasjon';
$lang['auth_builtin'] = 'FEU Standard identifikasjon';
$lang['auth_module'] = 'Identifikasjonsmodul/metode';
$lang['info_auth_module'] = 'FrontendUsers modulen st&oslash;tter st&oslash;tter bruk alternative metoder for identifikasjon, med varierende funksjoner. Noe funksjonalitet vil ikke fungere eller vil v&aelig;re deaktivert n&aring;r ikke den innebygde identifikasjonsmetode er i bruk';
$lang['error_user_nonunique_field_value'] = 'Verdien oppgitt for %s er allerede i bruk av en annen bruker';
$lang['unique'] = 'Unik';
$lang['error_nonunique_field_value'] = 'Verdien som er oppgitt for %s (%s) er ikke unik';
$lang['prompt_force_unique'] = 'Tving verdier for denne egenskapen til &aring; unik p&aring; tvers av alle kontoer';
$lang['help_returnlast'] = 'Om benyttet med innlogging- og utlogging-skjemaene vil denne parameter, om den er spesifisert, indikere at brukeren skal sendes tilbake til siden (etter url) som brukeren var p&aring; f&oslash;r handlingen hendte. Denne parameter vil overstyre omdirigering preferansene, og returnto parameteren.';
$lang['help_noinline'] = 'Benyttet med en av skjemaene, denne parameter spesifiserer at skjemaene ikke skal plasseres inline. Istedet skal de resulterende utdataene etter innsending av skjemaet erstatte standard innholdsblokken';
$lang['title_reset_session'] = 'Innloggings sessionstidsutl&oslash;psadvarsel';
$lang['msg_reset_session'] = 'Din innloggingsession er i ferd med &aring; utl&oslash;pe, vennligst klikk  OK  for &aring; bekrefte din tilstedev&aelig;relse p&aring; dette nettstedet.';
$lang['ok'] = 'OK';
$lang['resetsession_template'] = 'Tilbakestill sessionsmalen';
$lang['info_name'] = 'Dette er feltnavnet, som skal benyttes for adressering i smarty. Det m&aring; best&aring; av kun alfanummeriske bokstaver og understreker.';
$lang['visitors_tab'] = 'Bes&oslash;kere';
$lang['feu_groups_prompt'] = 'Velg en eller flere FEU-grupper som er tillatt &aring; se denne siden';
$lang['error_mustselect_group'] = 'En gruppe m&aring; velges';
$lang['selectone'] = 'Velg en';
$lang['start_year'] = 'Start&aring;r';
$lang['end_year'] = 'Slutt&aring;r';
$lang['date'] = 'Dato';
$lang['prompt_thumbnail_size'] = 'Miniatyrbildest&oslash;rrelse';
$lang['OnUpdateGroup'] = 'Ved endring av Brukergruppe(User Group)';
$lang['error_toomanyselected'] = 'For mange brukere ble valgt for masse-handlinger.... Vennligst reduser ned til 250 eller mindre';
$lang['confirm_delete_selected'] = 'Er du sikker p&aring; at du vil slette de valgte brukerne?';
$lang['delete_selected'] = 'Sletting valgt';
$lang['prompt_randomusername'] = 'Generer et tilfeldig brukenavn ved opprettelse av nye brukere';
$lang['months'] = 'm&aring;neder';
$lang['prompt_expireage'] = 'Standard bruker utl&oslash;pstid';
$lang['notification_settings'] = 'Varsling innstillinger';
$lang['property_settings'] = 'Egenskap innstillinger';
$lang['redirection_settings'] = 'Omdirigering innstillinger';
$lang['general_settings'] = 'Generelle innstillinger';
$lang['session_settings'] = 'Session og cookie innstillinger';
$lang['field_settings'] = 'Felt innstillinger';
$lang['error_lostun_nonrequired'] = 'Lostusername(Glemt Brukernavn) flagget kan kun benyttes p&aring;krevde felter';
$lang['prop_textarea_wysiwyg'] = 'Tillat bruk av wysiwyg p&aring; dette tekstomr&aring;det';
$lang['info_cookiestoremember'] = '<strong>Merk: </strong> Dette benytter mcrypt funksjonene for krypteringsform&aring;l, og disse ble ikke funnet p&aring; din installasjon. Vennligst kontakt din serveradministrator.';
$lang['editing_user'] = 'Rediger bruker';
$lang['noinline'] = 'Ikke bruk skjema som inline';
$lang['info_lostun'] = 'Klikk her om du ikke kan huske dine innloggingsdetaljer';
$lang['info_forgotpw'] = 'Klikk her om du ikke kan huske ditt passord';
$lang['info_logout'] = 'Klikk her for &aring; logge ut';
$lang['info_changesettings'] = 'Klikk her for &aring; endre ditt passord eller annen informasjon';
$lang['viewuser_template'] = 'Vis bruker mal';
$lang['event'] = 'Hendelse';
$lang['feu_event_notification'] = 'FEU Hendelse varsel';
$lang['prompt_notification_address'] = 'Varsel e-postadresse';
$lang['prompt_notification_template'] = 'Varsling E-postmal';
$lang['prompt_notification_subject'] = 'Varsling E-postemne';
$lang['prompt_notifications'] = 'E-postvarsling';
$lang['OnLogin'] = 'Ved innlogging';
$lang['OnLogout'] = 'Ved utlogging';
$lang['OnExpireUser'] = 'Ved utl&oslash;p av session';
$lang['OnCreateUser'] = 'Ved Bruker opprettet';
$lang['OnDeleteUser'] = 'Ved Bruker slettet';
$lang['OnUpdateUser'] = 'Ved endring av brukerinnstillinger';
$lang['OnCreateGroup'] = 'Ved opprettelse av brukergruppe';
$lang['OnDeleteGroup'] = 'Ved sletting av brukergruppe';
$lang['lostunconfirm_premsg'] = 'Funksjonen for mistet innloggingsdetaljer er fullf&oslash;rt. Vi har funnet et unikt brukernavn som passer til de detaljene du har oppgitt.';
$lang['your_username_is'] = 'Ditt brukernavn er';
$lang['lostunconfirm_postmsg'] = 'Vi anbefaler at du tar vare p&aring; denne informasjonen p&aring; en sikker, men tilgjengelig plass.';
$lang['prompt_after_change_settings'] = 'PageID/Alias &aring; hoppe til etter endring av innstillinger';
$lang['prompt_after_verify_code'] = 'PageID/Alias &aring; hoppe til etter kode bekreftelse *';
$lang['lostun_details_template'] = 'Glemt Brukernavn detaljmal';
$lang['lostun_confirm_template'] = 'Glemt Brukernavn bekreftelsesmal';
$lang['error_nonuniquematch'] = 'Feil: Mere enn en brukerkonto passer med de spesifiserte egenskaper';
$lang['error_cantfinduser'] = 'Feil: Kunne ikke finne en bruker som passer';
$lang['error_groupnotfound'] = 'Feil: Kunne ikke finne en gruppe med det navnet';
$lang['readonly'] = 'Skrivebeskyttet';
$lang['prompt_usermanipulator'] = 'Bruker Manipulator Klasse';
$lang['admin_logout'] = 'Logget ut av administrator';
$lang['prompt_loggedinonly'] = 'Vis kun de som er innlogget';
$lang['prompt_logout'] = 'Logg ut denne brukeren';
$lang['user_properties'] = 'Bruker egenskaper';
$lang['userhistory'] = 'Bruker historie';
$lang['export'] = 'Eksporter';
$lang['clear'] = 'T&oslash;m';
$lang['prompt_exportuserhistory'] = 'Eksporter Brukerhistorie til ASCII fil som er minst';
$lang['prompt_clearuserhistory'] = 'T&oslash;m Brukerhistorie oppf&oslash;ringer som er minst';
$lang['title_lostusername'] = 'Glemt dine innloggingsdetaljer?';
$lang['title_rssexport'] = 'Eksporter gruppedefinisjon (og egenskaper) til XML';
$lang['title_userhistorymaintenance'] = 'Behandle Brukerhistorie';
$lang['yes'] = 'Ja';
$lang['no'] = 'Nei';
$lang['prompt_of'] = 'av';
$lang['date_allrecords'] = '** Ingen grense **';
$lang['date_onehourold'] = 'En time gamle';
$lang['date_sixhourold'] = 'Seks timer gamle';
$lang['date_twelvehourold'] = 'Tolv timer gamle';
$lang['date_onedayold'] = 'En dag gamle';
$lang['date_oneweekold'] = 'En uke gamle';
$lang['date_twoweeksold'] = 'To uker gamle';
$lang['date_onemonthold'] = 'En m&aring;ned gamle';
$lang['date_threemonthsold'] = 'Tre m&aring;neder gamle';
$lang['date_sixmonthsold'] = 'Seks m&aring;neder gamle';
$lang['date_oneyearold'] = 'Ett &aring;r gamle';
$lang['title_groupsort'] = 'Gruppering og Sortering';
$lang['prompt_recordsfound'] = 'Oppf&oslash;ringer som passer kriteriet';
$lang['sortorder_username_desc'] = 'Synkende brukernavn';
$lang['sortorder_username_asc'] = 'Stigende brukernavn';
$lang['sortorder_date_desc'] = 'Synkende Dato';
$lang['sortorder_date_asc'] = 'Stigende Dato';
$lang['sortorder_action_desc'] = 'Synkende Hendelsestype';
$lang['sortorder_action_asc'] = 'Stigende Hendelsestype';
$lang['sortorder_ipaddress_desc'] = 'Synkende IP-adresse';
$lang['sortorder_ipaddress_asc'] = 'Stigende IP-adresse';
$lang['info_nohistorydetected'] = 'Ikke noe historisk funnet';
$lang['reset'] = 'Tilbakestill';
$lang['prompt_group_ip'] = 'Grupper etter IP-adresse';
$lang['prompt_filter_eventtype'] = 'Hendelsestype Filter';
$lang['prompt_filter_date'] = 'Vis kun hendelser som er mindre enn:';
$lang['prompt_pagelimit'] = 'Sidegrense';
$lang['for'] = 'for ';
$lang['title_userhistory'] = 'Brukerhistorie rapport';
$lang['unknown'] = 'Ukjent';
$lang['prompt_ipaddress'] = 'IP-adresse';
$lang['prompt_eventtype'] = 'Hendelsestype';
$lang['prompt_date'] = 'Dato';
$lang['prompt_return'] = 'Tilbake';
$lang['import_complete_msg'] = 'Import oppgaven er ferdig';
$lang['prompt_linesprocessed'] = 'Linjer prosessert';
$lang['prompt_errors'] = 'Det oppstod feil';
$lang['prompt_recordsadded'] = 'Poster lagt til';
$lang['error_nogroupproprelns'] = 'Kunne ikke finne egenskaper for gruppe %s';
$lang['error_noresponsefromserver'] = 'Fikk ingen respons fra SMTP serveren';
$lang['error_importfilenotfound'] = 'Spesifiserte filer (%s) ble ikke funnet';
$lang['error_importfieldvalue'] = 'Ugyldig verdi for nedtrekk eller flervalgsfelt %s';
$lang['error_importfieldlength'] = 'Felt %s overskrider maksimum lengde';
$lang['error_importusers'] = 'Import Feil (linje %s): %s';
$lang['error_propertydefns'] = 'Kunne ikke f&aring; tak i egenskap definisjonene (intern feil)';
$lang['error_problemsettinginfo'] = 'Problem med &aring; sette brukerinfo';
$lang['error_importrequiredfield'] = 'Kunne ikke finne en kolonne som samsvarte med det p&aring;krevde feltet %es';
$lang['error_nogroupproperties'] = 'Kunne ikke finne egenskaper for den spesifiserte gruppen';
$lang['error_importfileformat'] = 'Filen oppgitt for import er ikke i korrekt format';
$lang['error_couldnotopenfile'] = 'Kunne ikke &aring;pne filen';
$lang['info_importusersfileformat'] = '<h4>File Format Information</h4>
<p>The input file must be in ASCII format using comma separated values.  Each line in this input file (with the exception of the header line, discussed below) represents one user record.  The order of the fields in each line must be identical.</p>
<h5>Header line</h5>
<ul>
<li>The first line of the file must begin with two pound (\#) characters, and names each of the fields in the file.  The names of these fields is significant.  There are some required field names (see below), and other field names must match the property names associated with the group users are going to be added into.</li>
<li>The import process will fail if the fields in the input file does not match all of the required properties associated with the group that users are being added into</li>
<li>The input file may contain fields representing some of the optional properties in the specified group.</li>
<li>The import process will ignore any fields in the input file that are either not known, or map to properties that are <em>off</em> in the specified user group.</li>
</ul>
<h5>Columnar Data</h5>
<ul>
<li>The <strong>userid</strong> Field - The userid for the user. A value in this field will indicate you are doing an update.</li>
<li>The <strong>username</strong> Field - The desired username.
    <p>This field must exist in the headerline, and in each and every line of the input file. The record will fail if a user with that username already exists in the database.</p></li>
<li>The <strong>password</strong> Field - The password to set for the user</li>
<li>The <strong>createdate</strong> Field - todo</li>
<li>The <strong>expires</strong> Field - todo</li>
<li>The <strong>groupname</strong> Field - The groups that you want to have the user be a member of. If all required fields are not filled in the insert/update of the record will fail. See Multiselect Fields below for syntax.</li>
<li>Dropdown/Radio Fields
    <p>The value of dropdown properties in an import file is represented as the string that is shown in the dropdown control in the FrontEndUsers module.</p>
</li>
<li>Multiselect Fields
    <p>Multiselect fields are contained within the ASCII file as a : separated list of strings, where each string represents the text shown in the multiselect list</p>
</li>
<li>Date Fields
    <p>Must be in the format of MM-DD-YYYY</p>
</li>
<li>Image Fields
    <p>Image are fields who&#039;s column name matches a property of type Image.  If this field is a required part of the destination group, then the name specified in these columns must exist in the uploads disrectory of the CMS installation.  If the image does not exist, and the field is required, then the record will fail.</p></li>
</ul>
<h5>Notes</h5>
<p>The import process is subject to the limitations imposed by the host provider, such as memory limitations, processing time, file size upload, and safe mode restrictions.  Any one of these limitations may cause the import to fail. Therefore it is advisable to ensure that import files are smaller in size, and simpler in nature.</p>
<p>Though every effort has been made to ensure that database corruption will not occur, it is advisable to perform a database backup before doing a user import.</p>
<p>The Export data is in the same format as needed for import.</p>
<h5>Example</h5>
<pre>
##username,first_name,last_name,email,city,state,country,zip
user1,test,user,user1@somedomain.com,somewhere,TX,US,12345
</pre>';
$lang['prompt_importdestgroup'] = 'Importer Brukere til denne gruppen';
$lang['prompt_importfilename'] = 'Inndata CSV fil';
$lang['prompt_importxmlfile'] = 'Inndata XML fil';
$lang['prompt_exportusers'] = 'Eksporter Brukere';
$lang['prompt_importusers'] = 'Importer Brukere';
$lang['prompt_clear'] = 'T&oslash;m';
$lang['prompt_image_destination_path'] = 'Bilde m&aring;lsti';
$lang['error_missing_upload'] = 'Et problem har oppst&aring;tt med en manglende (men n&oslash;dvendig) opplasting';
$lang['error_bad_xml'] = 'Kunne ikke behandle den tilbudte XML filen';
$lang['error_notemptygroup'] = 'Kan ikke slette en gruppe som fortsatt har brukere';
$lang['error_norepeatedlogins'] = 'Denne brukeren er allerede innlogget';
$lang['error_captchamismatch'] = 'Teksten fra bildet ble ikke skrevet riktig';
$lang['prompt_allow_repeated_logins'] = 'Tillater brukere &aring; logge inn mer en en gang';
$lang['prompt_allowed_image_extensions'] = 'Bilde filendelser som brukere f&aring;r lov &aring; laste opp';
$lang['event_help_OnRefreshUser'] = '<h3>OnRefreshUser</h3>
<p>An event generated when the user session is refreshed.</p>
<h4>Parameters:</h4>
<ul>
  <li><em>id</em> - The User id</li>
</ul>
';
$lang['event_help_OnDeleteUser'] = '<h3>OnDeleteUser<h3>
<p>En hendelse/event generert n&aring;r en bruker slettes</p>
<h4>Parametere</h4>
<ul>
<li><em>username</em> - Brukernavnet</li>
<li><em>id</em> - Bruker IDen</li>
<li><em>props</em> - En hash fylt med egenskapene til brukeren</li>
</ul> 
';
$lang['event_help_OnCreateUser'] = '<h3>OnCreateUser<h3>
<p>En hendelse/event generert n&aring;r en bruker opprettes</p>
<h4>Parametere</h4>
<ul>
<li><em>name</em> - Brukernavnet</li>
<li><em>id</em> - Bruker IDen</li>
</ul> 
';
$lang['event_help_OnUpdateUser'] = '<h3>OnUpdateUser<h3>
<p>En hendelse generert n&aring;r en bruker er oppdatert (enten av brukeren selv eller av admin)</p>
<h4>Parametere</h4>
<ul>
<li><em>name</em> - Brukernavnet</li>
<li><em>id</em> - BrukerID&#039;en</li>
</ul> 
';
$lang['event_help_OnCreateGroup'] = '<h3>OnCreateGroup<h3>
<p>En hendelse/event generert n&aring;r en gruppe er opprettet</p>
<h4>Parametere</h4>
<ul>
<li><em>name</em> - Gruppenavnet</li>
<li><em>description</em> - Gruppebeskrivelsen</li>
<li><em>id</em> - Gruppe IDen</li>
</ul> 
';
$lang['event_help_OnDeleteGroup'] = '<h3>OnDeleteGroup<h3>
<p>En hendelse/event generert n&aring;r en gruppe er slettet</p>
<h4>Parametere</h4>
<ul>
<li><em>name</em> - Gruppenavnet</li>
<li><em>id</em> - Gruppe IDen</li>
</ul> 
';
$lang['event_help_OnLogin'] = '<h3>OnLogin<h3>
<p>En hendelse/event generert n&aring;r en bruker logger seg inn</p>
<h4>Parametere</h4>
<ul>
<li><em>id</em> - id&#039;en for den innloggede bruker</li>
<li><em>username</em> - Navnet p&aring; brukeren som er logget inn</li>
<li><em>ip</em> - Webklientens IP adresse </li>
</ul>
';
$lang['event_help_OnLogout'] = '<p>En hendelse/event generert n&aring;r en bruker logger ut</p>
<h4>Parametere</h4>
<ul>
<li><em>username</em> - Navnet p&aring; brukeren som er logget ut</li>
<li><em>id</em> - Bruker IDen</li>
</ul>
';
$lang['event_help_OnExpireUser'] = '<p>En hendelse/event generert n&aring;r en brukersession utl&oslash;per</p>
<h4>Parametereh4>
<ul>
<li><em>username</em> - Navnet p&aring; brukeren som utl&oslash;p</li>
<li><em>id</em> - Bruker IDen til brukeren som utl&oslash;p</li>
</ul>
';
$lang['event_info_OnLogin'] = 'En hendelse som genereres n&aring;r en bruker logger seg inn i systemet';
$lang['event_info_OnLogout'] = 'En hendelse som genereres n&aring;r en bruker logger seg ut av systemet';
$lang['event_info_OnExpireUser'] = 'En hendelse som genereres n&aring;r en bruker-session har utl&oslash;pt';
$lang['event_info_OnCreateUser'] = 'En hendelse generert n&aring;r en bruker er opprettet';
$lang['event_info_OnRefreshUser'] = 'En hendelse som genereres n&aring;r en bruker-session er oppfrisket';
$lang['event_info_OnUpdateUser'] = 'En hendelse generert n&aring;r en brukers info er oppdatert';
$lang['event_info_OnDeleteUser'] = 'En hendelse generert n&aring;r en brukerkonto er slettet';
$lang['event_info_OnCreateGroup'] = 'En hendelse generert n&aring;r en brukergruppe er opprettet';
$lang['event_info_OnUpdateGroup'] = 'En hendelse generert n&aring;r en brukergruppe er oppdatert';
$lang['event_info_OnDeleteGroup'] = 'En hendelse generert n&aring;r en brukergruppe er slettet';
$lang['backend_group'] = 'Backend gruppe';
$lang['info_star'] = '* F&oslash;lgende felt er fullstendige Smartymaler.<br/>Sammen med andre tidligere eksisterende smarty variabler og plugins, s&aring; er ($username) og ($ gruppe) variablene tilgjengelige. <em> (($group)-variablen kobler den f&oslash;rste gruppen til den som brukeren tilh&oslash;rer.)</ em>.';
$lang['info_admin_password'] = 'Rediger dette feltet for &aring; endre brukerens passord';
$lang['info_admin_repeatpassword'] = 'Rediger dette feltet for &aring; endre brukerens passord';
$lang['error_username_exists'] = 'En bruker med samme brukernavn finnes allerede';
$lang['nocsvresults'] = 'Ingen resultater fra csv eksporten';
$lang['prompt_unfldlen'] = 'Lengden p&aring; brukernavnfeltet';
$lang['prompt_pwfldlen'] = 'Lengden p&aring; passordfeltet';
$lang['error_invalidpasswordlengths'] = 'Min/Maks lengde p&aring; passordet er ugyldig';
$lang['error_invalidusernamelengths'] = 'Min/Maks lengde p&aring; brukernavn er ugyldig';
$lang['error_invalidemailaddress'] = 'Ugyldig e-postadresse';
$lang['error_noemailaddress'] = 'Vi kunne ikke finne en e-postadresse for denne kontoen';
$lang['error_problemseettinginfo'] = 'Kan ikke lagre brukerinformasjonen';
$lang['error_settingproperty'] = 'Kan ikke lagre egenskapen';
$lang['user_added'] = 'Bruker lagt til %s = %s';
$lang['user_deleted'] = 'Bruker slettet uid=%s';
$lang['propertyfilter'] = 'Egenskaper';
$lang['valueregex'] = 'Verdi (regular expression)';
$lang['warning_effectsfieldlength'] = 'Advarsel: Disse feltene p&aring;virker st&oslash;rrelsen p&aring; inndatafeltene i skjemaer. &Aring; minske disse verdiene p&aring; et eksisterende nettsted er ikke &aring; anbefale';
$lang['confirm_submitprefs'] = 'Er du sikker p&aring; at du vil endre denne modulens innstillinger?';
$lang['error_emailalreadyused'] = 'E-postadressen er allerede i bruk';
$lang['prompt_usecookiestoremember'] = 'Bruk informasjonskapsler(cookies) for &aring; huske innloggingsdetaljer';
$lang['prompt_cookiename'] = 'Navnet p&aring; informasjonskapselen(cookie)';
$lang['prompt_allow_duplicate_emails'] = 'Tillat identiske e-postadresser';
$lang['prompt_username_is_email'] = 'E-postadresse er brukernavn';
$lang['info_cookie_keepalive'] = 'Fors&oslash;k &aring; holde innloggingen ved live ved &aring; benytte en informasjonskapsel <em>informasjonskapselen vil bli tilbakesatt n&aring;r du er aktiv p&aring; nettstedet)</em>';
$lang['info_allow_duplicate_emails'] = '(tillat flere brukere med samme e-postadresse)';
$lang['info_username_is_email'] = '(brukers e-postadresse er deres brukernavn -- ikke sett dette sammen med &quot;Tillat identiske e-postadresser&quot;!)';
$lang['prompt_allow_duplicate_reminders'] = 'Tillat flere &quot;glemt passord&quot; p&aring;minnelser?';
$lang['info_allow_duplicate_reminders'] = '(tillat at en bruker ber om nullstilling av passordet, selv om de ikke har benyttet det forrige)';
$lang['prompt_feusers_specific_permissions'] = 'Benytt Front-end User spesifike tillatelser?';
$lang['info_feusers_specific_permissions'] = '(Normalt er, FEUser tillatelser de samme som tilsvarende Admin-omr&aring;de tillatelser - Legg til bruker, Legg til gruppe, osv. Om du haker av her, vil det v&aelig;re adskilte/egne tillatelser for FEUsers.)';
$lang['error_missingupload'] = 'Klarte ikke &aring; finne den opplastede fila (intern feil)';
$lang['error_problem_upload'] = 'Det er et problem med din opplastede fil. Vennligst fors&oslash;k p&aring; nytt';
$lang['error_missingusername'] = 'Du oppga ikke brukernavn';
$lang['error_missingemail'] = 'Du oppga ikke en e-postadresse';
$lang['error_missingpassword'] = 'Du oppga ikke passord';
$lang['frontenduser_logout'] = 'Frontend bruker utlogging';
$lang['frontenduser_loggedin'] = 'Frontend bruker innlogging';
$lang['editprop_infomsg'] = '<font color=&quot;red&quot;><b>V&AElig;R VARSOM</b> n&aring;r eksisterende egenskaper som er tilegnet grupper forandres, du kan komme i skade for &aring; &oslash;delegge noe og dermed nettstedet <i>(spesielt hvis du minsker feltlengder, etc)</i></font>';
$lang['info_smtpvalidate'] = 'Denne funksjonen virker ikke i Windows';
$lang['msg_dontcreateusername'] = 'Ikke opprett egenskaper for brukernavn eller passord da disse egenskapene er innebygget i selve FrontEndUser modulen.';
$lang['prompt_exportcsv'] = 'Eksporter brukere til CSV';
$lang['exportcsv'] = 'Eksporter';
$lang['importcsv'] = 'Importer';
$lang['admin'] = 'Admin ';
$lang['editprop'] = 'Rediger egenskap';
$lang['maxlength'] = 'Maks lengde';
$lang['created'] = 'Opprettet';
$lang['sortby'] = 'Sorter etter';
$lang['sort'] = 'Sorterer';
$lang['usersingroup'] = 'Brukere i valgt(e) gruppe(r)';
$lang['userlimit'] = 'Begrens resultatene til';
$lang['error_noemailfield'] = 'Kunne ikke finne et e-postfelt for denne brukeren. Du m&aring; kanskje kontakte systemadministratoren';
$lang['prompt_forgotpw_page'] = 'SideID/Alias for skjemaet Glemt passord';
$lang['prompt_changesettings_page'] = 'SideID/Alias for skjemaet Endre innstillinger';
$lang['prompt_login_page'] = 'SideID/Alias det skal hoppes til etter innlogging *';
$lang['prompt_logout_page'] = 'SideID/Alias det skal hoppes til etter utlogging *';
$lang['sortorder'] = 'Sorteringsrekkef&oslash;lge';
$lang['prompt_numresetrecord'] = 'Noen brukere holder p&aring; &aring; tilbakestille sine tapte passord. N&aring; er dette antallet: ';
$lang['remove1week'] = 'Fjern alle innlegg som er mer enn en uke gamle';
$lang['remove1month'] = 'Fjern alle innlegg som er mer enn en m&aring;ned gamle';
$lang['removeall'] = 'Fjern alle innlegg';
$lang['areyousure'] = 'Er du sikker?';
$lang['error_invalidcode'] = 'En ugyldig kode er lagt inn, vennligst pr&oslash;v igjen.';
$lang['error_tempcodenotfound'] = 'En midlertidig kode for din brukerID ble ikke funnet i databasen';
$lang['forgotpassword_verifytemplate'] = 'Mal som benyttes for &aring; vise verifikasjonsskjemaet';
$lang['forgotpassword_emailtemplate'] = 'Mal som benyttes p&aring; glemt passord epsoten';
$lang['error_resetalreadysent'] = 'Endring av passord for denne kontoen er allerede satt i gang av deg eller noen annen. Sjekk e-posten din, du kan ha mottatt videre instruksjoner om hvordan dette skal gjennomf&oslash;res. ';
$lang['error_dberror'] = 'Database feil';
$lang['message_forgotpwemail'] = 'Du f&aring;r denne meldingen fordi noen har fortalt v&aring;r nettside at du har mistet ditt passord.  Om dette er korrekt, les instruksjonene nedenfor.  Om du ikke skj&oslash;nner hva dette kan v&aelig;re, s&aring; kan du trygt slette denne meldingen, og vi takker for din oppmerksomhet.';
$lang['prompt_code'] = 'Kode';
$lang['message_code'] = 'Den f&oslash;lgende kode har blitt generert tilfeldig for &aring; gjenkjenne brukerkontoen.  n&aring;r du klikker linken nedenfor vil du f&aring; opp et felt for &aring; skrive inn denne koden.  Normal er feltet forh&aring;ndsutfylt for deg, men i tilfelle det ikke er - s&aring; er koden:';
$lang['prompt_link'] = 'Hvis du klikker p&aring; linken som f&oslash;lger vil du bli f&oslash;rt til en nettside hvor du kan legge inn vedlagte kode og legge inn nytt passord.';
$lang['lostpassword_emailsubject'] = 'Glemt passord';
$lang['error_nomailermodule'] = 'Kunne ikke finne CMSMailer modulen';
$lang['info_forgotpwmessagesent'] = 'En e-post er blitt sendt til %s med instruksjoner om hvordan passordet kan legges inn p&aring; ny. Takk.';
$lang['lostpw_message'] = 'S&aring; du har glemt eller mistet passordet ditt. Vel, legg inn brukernavnet ditt her, og om vi finner deg s&aring; vil vi sende deg en e-post om hvordan du kan tilbakestille det.';
$lang['forgotpassword_template'] = 'Mal for glemt passord';
$lang['lostusername_template'] = '&#039;Mistet brukernavn&#039; mal';
$lang['error_propnotfound'] = 'Egenskap %s ikke funnet';
$lang['propsfound'] = 'Egenskap funnet';
$lang['addprop'] = 'Legg til egenskap';
$lang['error_requiredfield'] = 'Et obligatorisk felt (%s) var tomt';
$lang['info_emptypasswordfield'] = 'Evt. nytt passord her for &aring; endre det eksisterende';
$lang['error_notloggedin'] = 'Det ser ikke ut til at du er innlogget';
$lang['user_settings'] = 'Innstillinger';
$lang['user_registration'] = 'Registrering';
$lang['error_accountexpired'] = 'Kontoen har utl&oslash;pt';
$lang['error_improperemailformat'] = 'Feil p&aring; e-postadressens formatering';
$lang['error_invalidexpirydate'] = 'Ugyldig utl&oslash;psdato. Dette kan v&aelig;re systemrelatert. Fors&oslash;k med &aring; sette et tidligere &aring;r.';
$lang['error_problemsettingproperty'] = 'Feil ved setting av egenskap %s for bruker $s';
$lang['error_invalidgroupid'] = 'Ugyldig gruppeID %s';
$lang['hiddenfieldmarker'] = 'Merke for skjult felt';
$lang['hiddenfieldcolor'] = 'Farge for skjult felt';
$lang['hidden'] = 'Skjult';
$lang['error_duplicatename'] = 'En egenskap med det navnet er allerede definert';
$lang['error_noproperties'] = 'Ingen egenskap definert';
$lang['error_norelations'] = 'Ingen egenskaper ble valgt for denne gruppen';
$lang['nogroups'] = 'Ingen grupper er definert';
$lang['groupsfound'] = 'Grupper funnet';
$lang['error_onegrouprequired'] = 'Det m&aring; tildeles medlemskap for minst en gruppe ';
$lang['prompt_requireonegroup'] = 'Krev medlemskap for minst en gruppe';
$lang['back'] = 'Tilbake';
$lang['error_missing_required_param'] = '%s feltet m&aring; fylles ut';
$lang['requiredfieldmarker'] = 'Merk obligatoriske felt med ';
$lang['requiredfieldcolor'] = 'Uthev obligatoriske felt med';
$lang['next'] = 'Neste';
$lang['error_groupexists'] = 'En gruppe med det navnet eksisterer allerede';
$lang['required'] = 'Obligatorisk';
$lang['optional'] = 'Valgfritt';
$lang['off'] = 'Av';
$lang['size'] = 'St&oslash;rrelse';
$lang['sizecomment'] = '<br/>(Maks st&oslash;rrelse i pixler for enhver dimensjon p&aring; bildet)';
$lang['length'] = 'Lengde';
$lang['lengthcomment'] = '<br>(bokstaver i tekstinnskrivingen)';
$lang['seloptions'] = 'Nedtrekksvalg, separert med linjeskift. Verdier kan separeres fra tekst med et = tegn. F.eks. Hunnkj&oslash;nn=f';
$lang['radiooptions'] = 'Radioknapp etiketter, separert med linjeskift. Verdier kan separeres fra tekst med et = tegn. F.eks: Hunnkj&oslash;nn=k';
$lang['prompt'] = 'Sp&oslash;r';
$lang['prompt_type'] = 'Type ';
$lang['type'] = 'Type ';
$lang['fieldstatus'] = 'Felt Status';
$lang['usedinlostun'] = 'Sp&oslash;r i Mistet<br/>brukernavn';
$lang['text'] = 'Tekst';
$lang['checkbox'] = 'Avkryssningsboks';
$lang['multiselect'] = 'Flervalgsliste';
$lang['radiobuttons'] = 'Radioknapper';
$lang['image'] = 'Bilde';
$lang['email'] = 'E-postadresse';
$lang['textarea'] = 'Tekstomr&aring;de';
$lang['dropdown'] = 'Nedtrekksmeny';
$lang['msg_currentlyloggedinas'] = 'Velkommen';
$lang['logout'] = 'Logg ut';
$lang['prompt_newgroupname'] = 'Benytt dette gruppenavnet';
$lang['prompt_changesettings'] = 'Forandre mine innstillinger';
$lang['error_loginfailed'] = 'Innlogging misslykket - ugyldig brukernavn eller passord?';
$lang['login'] = 'Logg inn';
$lang['prompt_signin_button'] = 'Logg inn knapp etikett';
$lang['prompt_username'] = 'Brukernavn';
$lang['prompt_email'] = 'E-postadresse';
$lang['prompt_password'] = 'Passord';
$lang['prompt_rememberme'] = 'Husk meg p&aring; denne datamaskinen';
$lang['register'] = 'Registrer';
$lang['forgotpw'] = 'Glemt passordet?';
$lang['lostusername'] = 'Har du glemt innloggingsdetaljene?';
$lang['defaults'] = 'Tilbakestill til standard';
$lang['template'] = 'Mal';
$lang['error_usernotfound'] = 'Kunne ikke finne informasjon om denne brukeren';
$lang['error_usernametaken'] = 'Det brukernavnet (%s) er allerede i bruk';
$lang['prompt_smtpvalidate'] = 'Bruk SMTP for &aring; kontrollere e-postadresser?';
$lang['prompt_minpwlen'] = 'Minimum lengde p&aring; passord';
$lang['prompt_maxpwlen'] = 'Maksimum lengde p&aring; passord';
$lang['prompt_minunlen'] = 'Minimum Lengde p&aring; brukernavn';
$lang['prompt_maxunlen'] = 'Maksimum lengde p&aring; brukernavn';
$lang['prompt_sessiontimeout'] = 'Session Timeout (sekunder)';
$lang['prompt_cookiekeepalive'] = 'Bruk cookies for &aring; holde innloggingen ved liv';
$lang['prompt_allowemailreg'] = 'Tillat e-post registrering';
$lang['prompt_dfltgroup'] = 'Standardgruppe for nye brukere';
$lang['changesettings_template'] = 'Mal for forandre brukerdata';
$lang['error_passwordmismatch'] = 'Passordene er ikke like';
$lang['error_invalidusername'] = 'Ugyldig brukernavn';
$lang['error_invalidpassword'] = 'Ugyldig passord';
$lang['edituser'] = 'Rediger bruker';
$lang['valid'] = 'Gyldig';
$lang['username'] = 'Brukernavn';
$lang['status'] = 'Status ';
$lang['error_membergroups'] = 'Denne brukeren er ikke medlem av noen gruppe';
$lang['error_properties'] = 'Ingen egenskaper';
$lang['error_dup_properties'] = 'Fors&oslash;k &aring; importere duplikate egenskaper';
$lang['value'] = 'Verdi';
$lang['groups'] = 'Grupper';
$lang['properties'] = 'Egenskaper';
$lang['propname'] = 'Egenskapens Navn ';
$lang['propvalue'] = 'Egenskapens verdi';
$lang['add'] = 'Legg til';
$lang['history'] = 'Historie';
$lang['edit'] = 'Rediger';
$lang['expires'] = 'Utl&oslash;per';
$lang['specify_date'] = 'Spesifiser dato';
$lang['12hrs'] = '12 timer';
$lang['24hrs'] = '24 timer';
$lang['48hrs'] = '48 timer';
$lang['1week'] = '1 uke';
$lang['2weeks'] = '2 Uker';
$lang['1month'] = '1 M&aring;ned';
$lang['3months'] = '3 M&aring;neder';
$lang['6months'] = '6 M&aring;neder';
$lang['1year'] = '1 &Aring;r';
$lang['never'] = 'Aldri';
$lang['postinstallmessage'] = 'Vellykket installasjon av modulen.<br/>Husk &aring; aktivisere  &quot;Modify FrontEndUser Properties permission.&quot;
I tillegg, anbefaler vi deg &aring; installere Captcha modulen.  Om denne er installert, en gyldighetstest av et captchabilde vil kreves i tillegg til brukernavn og passord for &aring; logge inn. Meningen med dette er &aring; hindre brute force angrep.  <strong>Merk:</strong> Parameteren nocaptcha kan benyttes for &aring; sl&aring; av denne funksjonen selv om Captcha modulen er installert.&quot;';
$lang['password'] = 'Nytt passord';
$lang['repeatpassword'] = 'Gjenta';
$lang['error_groupname_exists'] = 'En gruppe med det navnet eksisterer allerede';
$lang['editgroup'] = 'Rediger gruppe';
$lang['submit'] = 'Lagre';
$lang['cancel'] = 'Avbryt';
$lang['delete'] = 'Slett';
$lang['confirm_editgroup'] = 'Er du sikker p&aring; at dette er korrekte valg for denne gruppen?\n&Aring; sl&aring; en egenskap av/off vil ikke slette noen innlegg i egenskap-tabellen for denne gruppen/brukeren.  Egenskapen vil i stedet bli utilgjengelig.';
$lang['areyousure_deletegroup'] = 'Er du sikker p&aring; at du vil slette denne gruppen?';
$lang['confirm_delete_prop'] = 'Er du sikker p&aring; at du vil slette denne egenskapen helt?\n&Aring; gj&oslash;re dette vil ogs&aring; slette enhver brukers innlegg i denne egenskapen.';
$lang['error_insufficientparams'] = 'Ufullstendige parametre';
$lang['id'] = 'Id ';
$lang['name'] = 'Navn';
$lang['error_cantaddprop'] = 'Problem med &aring; legge til egenskap';
$lang['error_cantaddgroupreln'] = 'Problem med &aring; legge til gruppeegenskap';
$lang['error_cantaddgroup'] = 'Problem med &aring; legge til gruppe';
$lang['error_cantassignuser'] = 'Problem med &aring; legge en bruker til gruppen';
$lang['error_couldnotdeleteproperty'] = 'Problem med &aring; slette en egenskap';
$lang['error_couldnotfindemail'] = 'Kunne ikke finne en e-postadresse';
$lang['error_destinationnotwritable'] = 'Ingen skriverettighet i m&aring;lmappen';
$lang['error_invalidparams'] = 'Ugyldige parametere';
$lang['error_nogroups'] = 'Kunne ikke finne noen grupper';
$lang['applyfilter'] = 'Bruk';
$lang['filter'] = 'Filtrer';
$lang['userfilter'] = 'Brukernavn vanlig uttrykk';
$lang['description'] = 'Beskrivelse';
$lang['groupname'] = 'Gruppenavn';
$lang['accessdenied'] = 'Adgang nektet';
$lang['error'] = 'Feil';
$lang['addgroup'] = 'Legg til gruppe';
$lang['importgroup'] = 'Importer Gruppe';
$lang['adduser'] = 'Legg til bruker';
$lang['usersfound'] = 'Brukere som passer med kriteriene';
$lang['group'] = 'Gruppe';
$lang['selectgroup'] = 'Velg gruppe';
$lang['registration_template'] = 'Mal for registrering';
$lang['logout_template'] = 'Mal for utlogging';
$lang['login_template'] = 'Mal for innlogging';
$lang['preferences'] = 'Preferanser';
$lang['users'] = 'Brukere';
$lang['friendlyname'] = 'Frontend brukere';
$lang['moddescription'] = 'Administrer Frontend brukere';
$lang['defaultfrontpage'] = 'Standard forside';
$lang['lastaccessedpage'] = 'Siste viste side';
$lang['otherpage'] = 'Annen side: ';
$lang['captcha_title'] = 'Oppgi teksten fra bildet';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>This module allows management and administration of front end users <i>(users who have no admin accesss)</i>.  It allows creation of user groups, and user accounts and allows users to login and logout.  it can be used in conjunction with the CustomContent module to display different content to different users once they have logged in</p>
<h3>Features</h3>
<ul>
<li><p>User account expiration.  You can create temporary users</p></li>
<li><p>Group Properties.  You can ask for different information from members of different groups</p></li>
<li><p>Capable of handling hundreds of users</p></li>
<li><p>Forgot password, and forgot username functionality.... allows users to set a new password, and/or to recover their username if they completely forgot login details.</p></li>
<li><p>Has an extensive API for adding functionality</p></li>
</ul>
<h3>How do I use it</h3>
<ul>
<li><p>After installation you can access admin panel to the FrontEndUsers module under the &amp;quot;Users &amp; gGroups&amp;quot; menu.</p></li>
<li>
<p>Secondly, you need to define at least one property.  Properties are essentially field definitions, here you specify the type of information you want to gather, and limits. i.e:  Name, Age, City, State, Country, etc.</p>
<p><b>Note:</b> You do not need to define properties for username (or email address) and password, these will be provided for you</b>
<p><b>Note:</b> New installations of the FEU module specify that the users email address is their username (this option can be changed in the preferences tab).  So if using this option you will not need to create an email address property.</p>
</li>
<li><p>Next you must create one or more user groups.  When you create a group, you are asked for a group name, a description and to associate properties with that group, specify the properties sort order, and wether it is an optional, required, or hidden field <i>(off is also valid)</i></p></li>
<li><p><b>Note:</b> Before proceeding, you should ensure that the preferences are set correctly.</p></li>
<li><p>Thirdly you should create some users.  Adding users is a two step process.  When creating a user you are asked for the username/email and password, and an expiry date for that user.  You then must select the groups that that user is a member of, and click \&#039;Next\&#039;</p>
<p><em>Note: </em>This is a labour intensive and boring process, it is easier to let users register themselves <em>(See the SelfRegistration Module)</em>, and then you can edit their group information.  but for testing purposes, please create at lest one user</p></li>
<li><p>Lastly, after the system has determined all of the information fields to be presented for that user, you are presented with a form asking for all of the required user information.  Complete this form to complete the user addition</p></li>
<li><p>You are now ready to add the front end functionality to your site.  This is as simple as adding the {cms_module module=FrontEndUsers} tag to your page or template</p></li>
</ul>
<h3>Smarty Functions</h3>
<p>Some limited interaction with the FrontEndUsers module database is possible with smarty and the $feu_smarty object.</p>
<h4>Functions:</h4>
<ul>
<li><strong><code>{$feu_smarty-&amp;gt;get_users_by_groupname($groupname,$assign)}</code></strong>
<p>This function can be used to extract an array of usernames and userids for all users that belong to the specified group.  The output is assigned to a smarty variable specified in the &amp;quot;assign&amp;quot; parameter.</p>
<p>Example:<br/><code>{$feu_smarty-&amp;gt;get_users_by_groupname(&#039;members&#039;,&#039;mymembers&#039;)}<br/>{$mymembers|@print_r}</code></p>
</li>
<li><strong><code>{$feu_smarty-&amp;gt;get_user_properties($uid,$assign)}</code></strong>
<p>This function can be used to extract a list of properties for the specified user and assign them to a smarty variable with the specified name.</p>
<p>Example:<br/><code>{$feu_smarty-&amp;gt;get_user_properties(5,&#039;userprops&#039;)}<br/>{$userprops|@print_r}</code></p>
</li>

<li><strong><code>{$feu_smarty-&amp;gt;get_dropdown_text($propname,$propvalue[,$assign])}</code></strong>
<p>This smarty function returns the text specified for a particular option value for a specified dropdown property.</li>
<p>Example:<br/><code>{$feu_smarty-&amp;gt;get_dropdown_text(&#039;age_range&#039;,$onepropvalue)}</code></p>
</li>

<li><strong><code>{$feu_smarty-&amp;gt;get_multiselect_text($propname,$propvalue,$assign)}</code></strong>
<p>This smarty function returns an array of option texts corresponding to a comma separated list of option values.</li>
<p>Example:<br/><code>{$feu_smarty-&amp;gt;get_multiselect_text(&#039;favorite_foods&#039;,$onepropvalue,&#039;favorite_foods&#039;)}<br/>{$favorite_foods|@print_r}</code></p>
</li>

<li><strong>code>{$feu_smarty-&amp;gt;get_user_expiry($uid[,$assign])}</code></strong>
<p>This smarty method returns the unix timestamp that the specified uid account expires.  The function will return false if the uid cannot be found or some other error occurred.</p>
<p>Example:<br/><code>{$feu_smarty-&amp;gt;get_user_expiry(25,&#039;expiry&#039;)}<br/>{$expiry|cms_date_format}</code></p>
</li>

<li><strong>code>{$feu_smarty-&amp;gt;user_expired($uid[,$assign])}</code></strong>
<p>This smarty method returns a boolean indicating wether the specified user account has expired.  The method will also return false if the uid cannot be found or some other error occurred.</p>
<p>Example:<br/><code>{$feu_smarty-&amp;gt;user_expired(25,&#039;expired&#039;)}<br/>{if $expired}UID 25 can no longer login to the system{/if}</code></p>
</li>
</ul>

<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module, FAQs, or to file a Bug Report or buy commercial support, please visit calguy\&#039;s
module homepage at <a href="http://calguy1000.com">calguy1000.com</a>.</li>
<li>Additional discussion of this module may also be found in the <a href="http://forum.cmsmadesimple.org">CMS Made Simple Forums</a>.</li>
<li>The author, calguy1000, can often be found in the <a href="irc://irc.freenode.net/#cms">CMS IRC Channel</a>.</li>
<li>Lastly, you may have some success emailing the author directly.</li>  
</ul>
<h3>Parameters</h3>
<ul>
<li><em>(optional)</em> action=&quot;default&quot;<li>
<p>Actions:
<ul>
<li><em>default</em> - The default action, which enables the normal form= behaviour.</li>
<li><em>reset_session</em> - Provide a javascript controlled template to allow the manual, or automatic pinging of the user session.  This template can be used to remind the user that his login session is about to expire, and to trigger its reset.  Normally this method is not required as any page that displays the FrontEndUser controls would handle this, just requiring the user to view a page on a regular basis.  However, if there are pages with alot of content requiring extensive reading, this may be a useful solution.</li>
<li><em>viewuser</em> - Display a report for a single user, requires use of the uid parameter.</li>
</ul>
</p>
<li><em>(optional)</em> form=&quot;name&quot;</li>
<p>Forms:
<ul>
 <li><em>login</em> - Display the login form</li>
 <li><em>logout</em> - Display the logout form</li>
 <li><em>changesettings</em> - Display the change settings form</li>
 <li><em>forgotpw</em> - Display the forgot password form</li>
 <li><em>lostusername</em> - Display the lost username form.</li>
<li><em>silent</em> = Display nothing, but export properties and other smarty variables for the currently logged in user.  If no user is logged in, then no variables are exported.</li>
</ul>
</p>
<li><em>(optional)</em> returnto=&quot;page&quot;</li>
<p>Used with the login, logout, and changesettings forms, this parameter contains the page id or alias of a page to redirect to, when the form has been successfully completed</p>
<li><em>(optional)</em> only_groups=&quot;group1, group2, group3&quot;</li>
<p>Used with the login forms.  Basically only allows users to login if they belong to that particular group(s).</p>
<li><em>(optional)</em> lostun_group=&quot;group&quot;</li>
<p>Used with the lostusername form, this feature specifies the frontend user group to assume tht users are members of.</p>
<li><em>(optional)</em> nocaptcha=&quot;1&quot;</li>
<p>Used with the login forms. his will disnable captcha on the form. By default, if the Captcha module is installed, validation of a captcha image will be required for login.  This is a security measure intented to prevent brute force attacks.</p>
<li><em>(optional)</em> uid=null</li>
<p>Used with the viewuser action.  This parameter is required to specify which user to view the details of.</p>
</ul>
<p>As per the GPL, this software is provided as-is. Please read the text
of the license for the full disclaimer.</p>
<h3>Requirements</h3>
<p>In order to implement the forgotten password functionality, this module requires the CMSMailer module to be previously installed and properly configured.</p>
<h3>Copyright and License</h3>
<p>Copyright &amp;copy; 2008, Robert Campbel <a href="mailto:calguy1000@cmsmadesimple.org">&amp;lt;calguy1000@cmsmadesimple.org&amp;gt;</a>. All Rights Are Reserved.</p>
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
<h3>Sponsors</h3>
<p>There have been many sponsors for this module, some of these are listed below:</p>
<ul.>
 <li><a href="http://www.matterhornmarketing.com">Matterhorn Marketing</a></li>
 <li><a href="http://www.bpti.eu">Balkan Institute of Advanced Technology</a></li>
</ul>';
$lang['qca'] = 'P0-536849115-1307983495210';
$lang['utma'] = '156861353.1728621158.1311531024.1311531024.1311531024.1';
$lang['utmz'] = '156861353.1311531024.1.1.utmcsr=forum.cmsmadesimple.org|utmccn=(referral)|utmcmd=referral|utmcct=/';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353.4.10.1311531024';
?>