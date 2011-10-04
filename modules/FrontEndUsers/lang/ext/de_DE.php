<?php
$lang['info_sessiontimeout'] = 'Geben Sier hier die Anzahl von Sekunden an, nach deren Ablauf inaktive Benutzer automatisch von der Webseite abgemeldet werden';
$lang['prompt_expireusers_interval'] = 'Benutzerablauf-Intervall';
$lang['info_expireusers_interval'] = 'Specify a value (in seconds) that indicates how often the system should force users whos session has expired to be logged out.  T&quot;his is an optimization to save database queries.  If left empty or set to 0 expiry will be performed on every request.';
$lang['msg_settingschanged'] = 'Ihre Einstellungen wurden aktualisiert';
$lang['forcedlogouttask_desc'] = 'Benutzer in regelm&auml;&szlig;igen Zeitabst&auml;nden abmelden';
$lang['prompt_forcelogout_times'] = 'Zeiten, zu denen der Benutzer automatisch abgemeldet wird';
$lang['info_forcelogout_times'] = 'Geben Sie hier eine durch Kommata getrennte Liste von Zeiten wie zum Beispiel HH:MM,HH:MM an, in denen die Benutzer automatisch abgemeldet werden. Hinweis: Note, this uses the psuedocron mechanism so you must be sure that the times entered here will coincide reasonably with your &quot;pseudocron granularity&quot; and that sufficient requests will occur to your website to ensure that pseudocron is executed.';
$lang['prompt_forcelogout_sessionage'] = 'Benutzer ausschlie&szlig;en, die aktiv waren in <em>(Minuten)</em>';
$lang['info_forcelogout_sessionage'] = 'Wird dieser Wert angegeben, wird jeder Benutzer, der in diesem Zeitraum aktiv war, nicht automatisch abgemeldet';
$lang['areyousure_delete'] = 'Wollen Sie wirklich den Benutzer %s l&ouml;schen';
$lang['error_invalidfileextension'] = 'Die hochgeladene Datei entspricht nicht der erlaubten Dateitypen';
$lang['postuninstall'] = 'Alle dem FrontEndUsers-Modul zugeordneten Daten wurden gel&ouml;scht';
$lang['info_ecomm_paidregistration'] = 'Wird dies aktiviert, wird das Modul auf Ereignisse achten, die durch die Ecommerce Suite ausgel&ouml;st werden. Die folgenden Einstellungen haben nur dann eine Auswirkung, wenn diese Einstellung aktiviert wird.';
$lang['prompt_ecomm_paidregistration'] = 'Auf Bestellungen achten';
$lang['info_paidreg_settings'] = 'Die folgenden Einstellungen werden nur dann angewendet, wenn sich Benutzer selbst registrieren k&ouml;nnen und bezahlte Registrierungen erlaubt sind.';
$lang['none'] = 'Kein(er)';
$lang['delete_user'] = 'Benutzer l&ouml;schen';
$lang['expire_user'] = 'Abgelaufene Benutzer';
$lang['prompt_action_ordercancelled'] = 'Aktion, die ausgef&uuml;hrt wird, wenn die Bestellung eines Abonnements abgebrochen wird';
$lang['prompt_action_orderdeleted'] = 'Aktion, die ausgef&uuml;hrt wird, wenn die Bestellung eines Abonnements gel&ouml;scht wird';
$lang['ecommerce_settings'] = 'eCommerce-Einstellungen';
$lang['securefieldmarker'] = 'Kennzeichnung f&uuml;r sichere Felder';
$lang['securefieldcolor'] = 'Farbe f&uuml;r sichere Felder';
$lang['prompt_encrypt'] = 'Diese Daten in der Datenbank verschl&uuml;sselt speichern';
$lang['error_notsupported'] = 'Die gew&auml;hlte Option wird von Ihrer aktuellen Konfiguration nicht unterst&uuml;tzt';
$lang['audit_user_created'] = 'Benutzer wurde automatisch erstellt';
$lang['info_auto_create_unknown'] = 'Soll f&uuml;r einen Benutzer, der &uuml;ber ein externes Authentifizierungs-Modul angemeldet wurde, aber dem FrontEndUsers-Modul nicht bekannt ist, automatisch ein FEU-Konto erstellt werden?';
$lang['prompt_auto_create_unknown'] = 'Automatisch unbekannten Benutzer erstellen';
$lang['display_settings'] = 'Anzeige-Einstellungen';
$lang['info_std_auth_settings'] = 'Die folgenden Einstellungen werden nur verwendet, wenn Sie die &quot;Interne Authentifizierung&quot; verwenden.';
$lang['info_support_lostun'] = 'Die Einstellung &quot;Nein&quot; deaktiviert die M&ouml;glichkeit f&uuml;r die Benutzer, ein Anfrage nach Zusendung der Anmeldedaten zu stellen (unabh&auml;ngig von anderen Einstellungen)';
$lang['info_support_lostpw'] = 'Die Einstellung &quot;Nein&quot; deaktiviert die M&ouml;glichkeit f&uuml;r die Benutzer, ein Zur&uuml;cksetzen des Passworts anzufordern (unabh&auml;ngig von anderen Einstellungen)';
$lang['prompt_support_lostun'] = 'Benutzern eine Anfrage nach Ihren Benutzernamen erlauben';
$lang['prompt_support_lostpw'] = 'Benutzern eine Anfrage zur &Auml;nderungen des Passworts erlauben';
$lang['auth_settings'] = 'Authentifizierungs-Einstellungen';
$lang['authentication'] = 'Interne Authentifizierung';
$lang['auth_builtin'] = 'FEU-Standard-Authentifizierung';
$lang['auth_module'] = 'Authentifizierungs-Modul/Methode';
$lang['info_auth_module'] = 'Das FrontendUsers-Modul unterst&uuml;tzt die Anmeldung &uuml;ber alternative Authentifizierungs-Methoden, mit unterschiedlichen M&ouml;glichkeiten. Jedoch stehen dann einige Funktionen nicht zur Verf&uuml;gung oder werden deaktiviert, wenn nicht die eingebaute Authentifizierungs-Methode verwendet wird';
$lang['error_user_nonunique_field_value'] = 'Der f&uuml;r %s festgelegte Wert wird bereits von einem anderen Benutzer verwendet';
$lang['unique'] = 'Eindeutig';
$lang['error_nonunique_field_value'] = 'Der f&uuml;r %s festgelegte Wert (%s) ist nicht eindeutig';
$lang['prompt_force_unique'] = 'Werte f&uuml;r diese Eigenschaft sollen in allen Benutzerkonten eindeutig sein';
$lang['help_returnlast'] = 'Wird mit An- und Abmelde-Formularen verwendet. Mit diesem Parameter kann festgelegt werden, dass der Webseitenbesucher nach der Anmeldung auf die Seite (URL) weitergeleitet werden, die sie vor dieser Aktion angesehen haben. Dieser Parameter &uuml;berschreibt s&auml;mliche Weiterleitungseinstellungen und -Parameter.';
$lang['help_noinline'] = 'Wird mit einem der Formulare verwendet. Dieser Parameter legt fest, ob die Formulare inline angezeigt werden sollen, anstatt dass die Ergebnisausgabe nach &Uuml;bermittlung des Formulars den Standard-Inhaltsblock ersetzt.';
$lang['title_reset_session'] = 'Warnung vor dem Ablauf der Anmelde-Session';
$lang['msg_reset_session'] = 'Die Zeit f&uuml;r Ihre aktuelle Anmeldung auf dieser Webseite ist abgelaufen. Bitte klicken Sie auf &quot;Ok&quot;, um zu best&auml;tigen, dass Sie noch auf dieser Webseite aktiv sind.';
$lang['ok'] = 'OK';
$lang['resetsession_template'] = 'Session-Template zur&uuml;cksetzen';
$lang['info_name'] = 'Dies ist der Feldname, der in Smarty f&uuml;r die Adressierung verwendet wird. Er darf nur alphanumerische Zeichen und Unterstriche (_) enthalten.';
$lang['visitors_tab'] = 'Besucher';
$lang['feu_groups_prompt'] = 'W&auml;hlen sie eine oder mehrere FEU-Benutzergruppen, denen es erlaubt ist, diese Seite anzusehen';
$lang['error_mustselect_group'] = 'Es muss eine Gruppe ausgew&auml;hlt werden';
$lang['selectone'] = 'Ihre Auswahl';
$lang['start_year'] = 'Startjahr';
$lang['end_year'] = 'Endjahr';
$lang['date'] = 'Datum';
$lang['prompt_thumbnail_size'] = 'Gr&ouml;&szlig;e des Vorschaubild';
$lang['OnUpdateGroup'] = 'Ausf&uuml;hren, wenn die Benutzergruppe ge&auml;ndert wurde';
$lang['error_toomanyselected'] = 'F&uuml;r diese Aktion wurden zu viele Benutzer ausgew&auml;hlt. Bitte beschr&auml;nken Sie sich auf 250 (oder weniger).';
$lang['confirm_delete_selected'] = 'Wollen Sie wirklich die ausgew&auml;hlten Benutzer l&ouml;schen?';
$lang['delete_selected'] = 'Ausgew&auml;hlte Benutzer l&ouml;schen';
$lang['prompt_randomusername'] = 'Einen zuf&auml;lligen Benutzernamen erzeugen, wenn ein neuer Benutzer hinzugef&uuml;gt wird';
$lang['months'] = 'Monate';
$lang['prompt_expireage'] = 'Voreingestellte Zeit bis zum Verfall des Benutzerkontos';
$lang['notification_settings'] = 'Benachrichtigungs-Einstellungen';
$lang['property_settings'] = 'Eigenschafts-Einstellungen';
$lang['redirection_settings'] = 'Weiterleitungs-Einstellungen';
$lang['general_settings'] = 'Allgemeine Einstellungen';
$lang['session_settings'] = 'Einstellungen f&uuml;r Sessions und Cookies';
$lang['field_settings'] = 'Feld-Einstellungen';
$lang['error_lostun_nonrequired'] = 'Die Kennzeichnung f&uuml;r vergessene Benutzernamen kann nur bei Pflichtfeldern verwendet werden.';
$lang['prop_textarea_wysiwyg'] = 'In diesem Textbereich die Verwendung eines WYSIWYG-Editors erlauben';
$lang['info_cookiestoremember'] = '<strong>Hinweis:</strong> F&uuml;r die Verschl&uuml;sselung werden die mcrypt-Funktionen verwendet. Auf Ihrem Host scheint diese jedoch nicht vorhanden zu sein. Kontaktieren Sie daher Ihren Server-Administrator.';
$lang['editing_user'] = 'Benutzer-Bearbeitung';
$lang['noinline'] = 'Keine Inline-Formulare verwenden';
$lang['info_lostun'] = 'Klicken Sie hier, wenn Sie sich nicht mehr an die Details Ihrer Anmeldung erinnern k&ouml;nnen';
$lang['info_forgotpw'] = 'Klicken Sie hier, wenn Sie sich nicht mehr an Ihr Passwort erinnern k&ouml;nnen';
$lang['info_logout'] = 'Zum Abmelden hier klicken';
$lang['info_changesettings'] = 'Klicken Sie hier, um Ihr Passwort oder andere Informationen zu &auml;ndern.';
$lang['viewuser_template'] = 'Template f&uuml;r die Benutzer-Anzeige';
$lang['event'] = 'Ereignis';
$lang['feu_event_notification'] = 'FEU-Ereignis-Benachrichtigungen';
$lang['prompt_notification_address'] = 'Email-Adresse f&uuml;r Benachrichtigungen';
$lang['prompt_notification_template'] = 'Template f&uuml;r Email-Benachrichtigungen';
$lang['prompt_notification_subject'] = 'Betreff der Email-Benachrichtigung';
$lang['prompt_notifications'] = 'Email-Benachrichtigungen';
$lang['OnLogin'] = 'Ausf&uuml;hren, wenn sich ein Benutzer anmeldet';
$lang['OnLogout'] = 'Ausf&uuml;hren, wenn sich ein Benutzer abmeldet';
$lang['OnExpireUser'] = 'Ausf&uuml;hren, wenn eine Benutzer-Session abl&auml;uft';
$lang['OnCreateUser'] = 'Ausf&uuml;hren, wenn ein Benutzerkonto neu erstellt wurde';
$lang['OnDeleteUser'] = 'Ausf&uuml;hren, wenn ein Benutzerkonto gel&ouml;scht wurde';
$lang['OnUpdateUser'] = 'Ausf&uuml;hren, wenn Benutzerdaten aktualisiert wurden';
$lang['OnCreateGroup'] = 'Ausf&uuml;hren, wenn eine Benutzergruppe neu erstellt wurde';
$lang['OnDeleteGroup'] = 'Ausf&uuml;hren, wenn eine Benutzergruppe gel&ouml;scht wurde';
$lang['lostunconfirm_premsg'] = 'Die Daten zum Auffinden verlorener Passw&ouml;rter wurden vollst&auml;ndig eingegeben. Wir haben einen Benutzernamen gefunden, der den von Ihnen eingegebenen Details entspricht.';
$lang['your_username_is'] = 'Ihr Benutzername ist';
$lang['lostunconfirm_postmsg'] = 'Wir empfehlen Ihnen, diese Information an sicherer Stelle aufzubewahren.';
$lang['prompt_after_change_settings'] = 'Seiten-ID/-Alias der Seite, auf die nach dem &Auml;ndern der Einstellungen gesprungen werden soll';
$lang['prompt_after_verify_code'] = 'Seiten-ID/-Alias der Seite, auf die nach der Code-Pr&uuml;fung gesprungen werden soll *';
$lang['lostun_details_template'] = 'Details-Template bei vergessenem Benutzernamen';
$lang['lostun_confirm_template'] = 'Best&auml;tigungs-Template bei vergessenem Benutzernamen';
$lang['error_nonuniquematch'] = 'FEHLER: Mehr als ein Benutzer-Konto entspricht den gesuchten Eigenschaften';
$lang['error_cantfinduser'] = 'FEHLER: Konnte den gesuchten Benutzer nicht finden';
$lang['error_groupnotfound'] = 'FEHLER: Konnte keine Gruppe mit diesem Namen finden';
$lang['readonly'] = 'Nur lesen';
$lang['prompt_usermanipulator'] = 'Klasse zur Bearbeitung von Benutzern';
$lang['admin_logout'] = 'Durch den Administrator abgemeldet';
$lang['prompt_loggedinonly'] = 'Nur die angemeldeten Benutzer anzeigen';
$lang['prompt_logout'] = 'Diesen Benutzer abmelden';
$lang['user_properties'] = 'Benutzer-Eigenschaften';
$lang['userhistory'] = 'Benutzer-Geschichte';
$lang['export'] = 'Exportieren';
$lang['clear'] = 'L&ouml;schen';
$lang['prompt_exportuserhistory'] = 'Benutzergeschichte in eine ASCII-Datei exportieren';
$lang['prompt_clearuserhistory'] = 'Datens&auml;tze der Benutzergeschichte l&ouml;schen, die mindestens';
$lang['title_lostusername'] = 'Haben Sie Ihre Zugangsdaten vergessen?';
$lang['title_rssexport'] = 'Gruppen-Definition (und Eigenschaften) als XML-Datei exportieren';
$lang['title_userhistorymaintenance'] = 'Verwaltung der Benutzergeschichten';
$lang['yes'] = 'Ja';
$lang['no'] = 'Nein';
$lang['prompt_of'] = 'von';
$lang['date_allrecords'] = '** Keine Beschr&auml;nkung **';
$lang['date_onehourold'] = 'Eine Stunde alt';
$lang['date_sixhourold'] = 'Sechs Stunden alt';
$lang['date_twelvehourold'] = 'Zw&ouml;lf Stunden alt';
$lang['date_onedayold'] = 'Einen Tag alt';
$lang['date_oneweekold'] = 'Eine Woche alt';
$lang['date_twoweeksold'] = 'Zwei Wochen alt';
$lang['date_onemonthold'] = 'Einen Monat alt';
$lang['date_threemonthsold'] = 'Drei Monate alt';
$lang['date_sixmonthsold'] = 'Sechs Monate alt';
$lang['date_oneyearold'] = 'Ein Jahr alt';
$lang['title_groupsort'] = 'Gruppierung und Sortierung';
$lang['prompt_recordsfound'] = 'Mit den vorgegebenen Kriterien &uuml;bereinstimmende Datens&auml;tze';
$lang['sortorder_username_desc'] = 'Nach Benutzernamen absteigend ';
$lang['sortorder_username_asc'] = 'Nach Benutzernamen aufsteigend';
$lang['sortorder_date_desc'] = 'Nach Datum absteigend';
$lang['sortorder_date_asc'] = 'Nach Datum aufsteigend';
$lang['sortorder_action_desc'] = 'Nach Ereignistyp absteigend';
$lang['sortorder_action_asc'] = 'Nach Ereignistyp aufsteigend';
$lang['sortorder_ipaddress_desc'] = 'Nach IP-Adresse absteigend';
$lang['sortorder_ipaddress_asc'] = 'Nach IP-Adresse aufsteigend';
$lang['info_nohistorydetected'] = 'Keine Geschichte vorhanden';
$lang['reset'] = 'Zur&uuml;cksetzen';
$lang['prompt_group_ip'] = 'Gruppen nach IP-Adresse';
$lang['prompt_filter_eventtype'] = 'Ereignistypen-Filter';
$lang['prompt_filter_date'] = 'Zeigt nur Ereignisse an, die geringer sind als:';
$lang['prompt_pagelimit'] = 'Seitenlimit';
$lang['for'] = 'f&uuml;r';
$lang['title_userhistory'] = 'Bericht zur Benutzergeschichte';
$lang['unknown'] = 'Unbekannt';
$lang['prompt_ipaddress'] = 'IP-Adresse';
$lang['prompt_eventtype'] = 'Ereignis-Typ';
$lang['prompt_date'] = 'Datum';
$lang['prompt_return'] = 'Zur&uuml;ck';
$lang['import_complete_msg'] = 'Datenimport komplett';
$lang['prompt_linesprocessed'] = 'Zeilen verarbeitet';
$lang['prompt_errors'] = 'Fehler aufgetreten';
$lang['prompt_recordsadded'] = 'Datens&auml;tze hinzugef&uuml;gt';
$lang['error_nogroupproprelns'] = 'Keine Eigenschaften f&uuml;r die Gruppe %s gefunden';
$lang['error_noresponsefromserver'] = 'Keine Antwort vom SMTP-Server erhalten';
$lang['error_importfilenotfound'] = 'Die Datei (%s) konnte nicht gefunden werden';
$lang['error_importfieldvalue'] = 'Ung&uuml;ltiger Wert f&uuml;r das Listenfeld oder das Feld zur Mehrfachauswahl %s';
$lang['error_importfieldlength'] = 'Das Feld %s &uuml;berschreitet die maximal m&ouml;gliche L&auml;nge';
$lang['error_importusers'] = 'Import-Fehler (Zeile %s): %s';
$lang['error_propertydefns'] = 'Konnte die Eigenschaftsdefinition nicht abrufen (interner Fehler)';
$lang['error_problemsettinginfo'] = 'Problem beim Setzen der Benutzerinformation';
$lang['error_importrequiredfield'] = 'Konnte keine Spalte finden, die mit dem erforderlichen Feld %s &uuml;bereinstimmt';
$lang['error_nogroupproperties'] = 'Konnte f&uuml;r die festgelegte Gruppe keine Eigenschaften finden';
$lang['error_importfileformat'] = 'Die zu importierenden Datei hat das falsche Format';
$lang['error_couldnotopenfile'] = 'Konnte die Datei nicht &ouml;ffnen';
$lang['info_importusersfileformat'] = '<h4>Infomationen zum Format der zu importierenden Datei</h4>
<p>Die zu importierende Datei muss im ASCII-Format vorliegen. Die einzelnen Werte m&uuml;ssen durch Kommata getrennt sein. Jede Zeile in dieser Datei entspricht dem Datensatz eines Benutzers (mit Ausnahme der Kopfzeile, mehr dazu weiter unten). Jede Zeile MUSS die gleiche Anzahl an Feldern enthalten. Auch die Reihenfolge der Felder MUSS in jeder Zeile gleich sein.</p>
<h5>Die Kopfzeile</h5>
<ul>
<li>Die erste Zeile der Datei muss mit zwei Rauten (\#) beginnen. In dieser Zeile werden die verwendeten Felder in der Datei definiert. Die Namen dieser Felder sind besonders wichtig. Ein paar der Felder sind Pflichtfelder (im folgenden beschrieben). Die anderen Feldnamen m&uuml;ssen mit den Namen der zugeordneten Eigenschaften der jeweiligen Benutzergruppe &uuml;bereinstimmen, der die Benutzer hinzugef&uuml;gt werden sollen.</li>
<li>Stimmen die Felder nicht mit allen, der Benutzergruppe (der die Benutzer hinzugef&uuml;gt werden sollen) zugeordneten Pflichtfeldern &uuml;berein, wird der Import fehlschlagen.</li>
<li>Die zu importierende Datei kann Felder enthalten, in denen optionale Eigenschaften der festgelegten Benutzergruppe enthalten sind.</li>
<li>Beim Import werden Felder ignoriert, die entweder unbekannt sind oder auf Eigenschaften verweisen, die f&uuml;r die festgelegte Benutzergruppe nicht aktiviert sind.</li>
</ul>
<h5>Die Daten in den Spalten</h5>
<ul>
<li>Das Feld <strong>userid</strong> - Die Benutzer-ID f&uuml;r den Benutzer. Enth&auml;lt dieses Feld einen Wert, wird davon ausgegangen, dass Sie dieses aktualisieren m&ouml;chten.</li>
<li>Das Feld <strong>username</strong> - der gew&uuml;nschte Benutzername.
    <p>Dieses Feld muss in der Kopfzeile sowie in jeder Zeile der zu importierenden Datei enthalten sein. Existiert der Benutzername bereits in der Datenbank, wird dieser Datensatz nicht importiert.</p></li>
<li>Das Feld <strong>password</strong> - das Passwort, welches f&uuml;r diesen Benutzer gesetzt werden soll</li>
<li>Das Feld <strong>createdate</strong> - noch zu erledigen</li>
<li>Das Feld <strong>expires</strong> - noch zu erledigen</li>
<li>Das Feld <strong>groupname</strong> - die Benutzergruppen, in denen der Benutzer Mitglied sein soll. Falls Pflichtfelder ohne Eintrag sind, wird der Import fehlschlagen. Den Syntax f&uuml;r Listenfelder mit Mehrfachauswahl finden Sie weiter unten.</li>
<li>Listenfelder
    <p>Der Wert des Listenfeldes in der zu importierenden Datei muss einen der Textstrings enthalten, der in der Listenfeldauswahl des FrontendUser-Moduls angezeigt wird.</p>
</li>
<li>Listenfelder mit Mehrfachauswahl
    <p>Ein Listenfeld mit Mehfachauswahl muss in der zu importierenden Datei einen oder mehrere der Textstrings enthalten, die im Listenfeld mit Mehrfachauswahl des FrontendUser-Moduls angezeigt werden. Die Werte dieses Feldes sind durch Doppelpunkt voneinander zu trennen.</p>
</li>
<li>Datumsfelder
    <p>Muss im Format MM-TT-JJJJ angegeben werden</p>
</li>
<li>Bildfelder
    <p>Bildfelder sind Felder, deren Spaltenname mit einer Eigenschaft vom Typ Bild &uuml;bereinstimmt. Wenn dieses Feld ein Pflichtfeld derjenigen Gruppe ist, der die Benutzer hinzugef&uuml;gt werden sollen, dann muss ein Bild mit dem, in dieser Spalte angegebenen Namen im /uploads-Verzeichnis von CMS made simple vorhanden sein. Wenn das Bild nicht existiert und das Feld als Pflichtfeld festgelegt wurde, wird der Datensatz nicht importiert.</p>
</ul>
<h5>Hinweise</h5>
<p>Der Erfolg des Importprozesses kann von verschiedenen Beschr&auml;nkungen Ihres Providers (wie etwa Speicherbeschr&auml;nkungen, Verarbeitungszeiten, Gr&ouml;&szlig;e der hochzuladenden Datei und safe mode-Beschr&auml;nkungen) beeintr&auml;chtigt werden. Jeder dieser Beschr&auml;nkungen kann den erfolgreichen Import verhindern. Aufgrund dessen ist es empfehlenswert, jeweils nur kleinere Dateien mit einfacher Struktur zu importieren.</p>
<p>Um den Verlust der Datenbank durch eine Besch&auml;digung zu vermeiden, ist es desweiteren empfehlenswert, VOR dem Import eine Sicherungskopie der Datenbank zu erstellen.</p>
<p>Die exportierten Daten sind im selben Format, wie sie f&uuml;r den Import ben&ouml;tigt werden.</p>
<h5>Ein Beispiel f&uuml;r eine Importdatei</h5>
<pre>
##username,Vorname,Nachname,Email,Stadt,Bundesland,Staat,PLZ
Benutzer1,Test,Benutzer,benutzer1@meinedomain.de,irgendwo,SN,DE,01234
</pre>';
$lang['prompt_importdestgroup'] = 'Benutzer in diese Gruppe importieren';
$lang['prompt_importfilename'] = 'CSV-Datei ausw&auml;hlen';
$lang['prompt_importxmlfile'] = 'XML-Datei ausw&auml;hlen';
$lang['prompt_exportusers'] = 'Benutzer exportieren';
$lang['prompt_importusers'] = 'Benutzer importieren';
$lang['prompt_clear'] = 'L&ouml;schen';
$lang['prompt_image_destination_path'] = 'Zielpfad f&uuml;r das Bild';
$lang['error_missing_upload'] = 'Es ist ein Problem mit einer fehlenden, aber erforderlichen (hochzuladenden) Datei aufgetreten';
$lang['error_bad_xml'] = 'Konnte die angegebene XML-Datei nicht verarbeiten';
$lang['error_notemptygroup'] = 'Die Gruppe konnte nicht gel&ouml;scht werden, da sie noch Benutzer enth&auml;lt.';
$lang['error_norepeatedlogins'] = 'Dieser Benutzer ist bereits angemeldet';
$lang['error_captchamismatch'] = 'Der Text aus dem Bild wurde nicht richtig eingegeben';
$lang['prompt_allow_repeated_logins'] = 'Den Benutzern erlauben, sich mehr als einmal anzumelden';
$lang['prompt_allowed_image_extensions'] = 'Namenserweiterungen f&uuml;r Bilder, die der Benutzer hochladen darf';
$lang['event_help_OnRefreshUser'] = '<h3>OnRefreshUser</h3>
<p>An event generated when the user session is refreshed.</p>
<h4>Parameters:</h4>
<ul>
  <li><em>id</em> - The User id</li>
</ul>
';
$lang['event_help_OnDeleteUser'] = '<h3>OnDeleteUser<h3>
<p>Ausf&uuml;hren, wenn ein Benutzerkonto gel&ouml;scht wurde</p>
<h4>Parameter</h4>
<ul>
<li><em>username</em> - der Benutzername</li>
<li><em>id</em> - die Benutzer-ID</li>
<li><em>props</em> - Ein Hash, der mit den Eigenschaften des Benutzers gef&uuml;llt wurde</li>
</ul> 
';
$lang['event_help_OnCreateUser'] = '<h3>OnCreateUser<h3>
<p>Ausf&uuml;hren, wenn ein Benutzerkonto neu erstellt wurde</p>
<h4>Parameter</h4>
<ul>
<li><em>username</em> - der Benutzername</li>
<li><em>id</em> - die Benutzer-ID</li>
</ul> 
';
$lang['event_help_OnUpdateUser'] = '<h3>OnUpdateUser<h3>
<p>Ausf&uuml;hren, wenn Benutzerdaten aktualisiert wurden (entweder durch ihn selbst oder durch den Administrator)</p>
<h4>Parameter</h4>
<ul>
<li><em>name</em> - der Benutzername</li>
<li><em>id</em> - die Benutzer-ID</li>
</ul> 
';
$lang['event_help_OnCreateGroup'] = '<h3>OnCreateGroup<h3>
<p>Ausf&uuml;hren, wenn eine Benutzergruppe neu erstellt wurde</p>
<h4>Parameter</h4>
<ul>
<li><em>name</em> - der Benutzergruppename</li>
<li><em>description</em> - die Beschreibung der Benutzergruppe</li>
<li><em>id</em> - die Benutzergruppen-ID</li>
</ul> 
';
$lang['event_help_OnDeleteGroup'] = '<h3>OnDeleteGroup<h3>
<p>Ausf&uuml;hren, wenn eine Benutzergruppe gel&ouml;scht wurde</p>
<h4>Parameter</h4>
<ul>
<li><em>name</em> - der Benutzergruppenname</li>
<li><em>id</em> - die Benutzergruppen-ID</li>
</ul> 
';
$lang['event_help_OnLogin'] = '<h3>OnLogin<h3>
<p>Ausf&uuml;hren, wenn sich ein Benutzer anmeldet</p>
<h4>Parameter</h4>
<ul>
<li><em>id</em> - die ID des angemeldeten Benutzers</li>
<li><em>username</em> - der Name des angemeldeten Benutzers</li>
<li><em>ip</em> - die IP-Adresse des Clients</li>
</ul>
';
$lang['event_help_OnLogout'] = '<h3>OnLogout<h3>
<p>Ausf&uuml;hren, wenn sich ein Benutzer abmeldet</p>
<h4>Parameter</h4>
<ul>
<li><em>username</em> - der Name des abgemeldeten Benutzers</li>
<li><em>id</em> - die Benutzer-ID</li>
</ul>
';
$lang['event_help_OnExpireUser'] = '<h3>OnSessionExpiry</h3>
<p>Ausf&uuml;hren, wenn eine Benutzer-Session abl&auml;uft</p>
<h4>Parameter</h4>
<ul>
<li><em>username</em> - der Name des Benutzers der abgelaufenen Sitzung</li>
<li><em>id</em> - die Benutzer-ID der abgelaufenen Sitzung</li>
</ul>
';
$lang['event_info_OnLogin'] = 'Ausf&uuml;hren, wenn sich ein Benutzer im System anmeldet';
$lang['event_info_OnLogout'] = 'Ausf&uuml;hren, wenn sich ein Benutzer im System abmeldet';
$lang['event_info_OnExpireUser'] = 'Ausf&uuml;hren, wenn eine Benutzer-Sitzung abl&auml;uft';
$lang['event_info_OnCreateUser'] = 'Ausf&uuml;hren, wenn ein neuer Benutzer erstellt wurde';
$lang['event_info_OnRefreshUser'] = 'An event generated when the user session is refreshed';
$lang['event_info_OnUpdateUser'] = 'Ausf&uuml;hren, wenn die Informationen zu einem Benutzer aktualisiert wurden';
$lang['event_info_OnDeleteUser'] = 'Ausf&uuml;hren, wenn ein Benutzerkonto gel&ouml;scht wurde';
$lang['event_info_OnCreateGroup'] = 'Ausf&uuml;hren, wenn eine Benutzergruppe erstellt wurde';
$lang['event_info_OnUpdateGroup'] = 'Ausf&uuml;hren, wenn eine Benutzergruppe aktualisiert wurde';
$lang['event_info_OnDeleteGroup'] = 'Ausf&uuml;hren, wenn eine Benutzergruppe gel&ouml;scht wurde';
$lang['backend_group'] = 'Administrations-Gruppe';
$lang['info_star'] = '* Die folgenden Felder sind komplette Smarty-Templates.<br />Neben den anderen, bereits existierenden Smarty-Variablen stehen Ihnen jetzt die Variablen {$username} und {$group} zur Verf&uuml;gung. <em>(Die Variable {$group} enth&auml;lt die erste Benutzergruppe, der der Benutzer angeh&ouml;rt.)</em>.';
$lang['info_admin_password'] = 'Bearbeiten Sie dieses Feld, um das Passwort des Benutzers zur&uuml;ckzusetzen.';
$lang['info_admin_repeatpassword'] = 'Bearbeiten Sie dieses Feld, um das Passwort des Benutzers zur&uuml;ckzusetzen.';
$lang['error_username_exists'] = 'Ein Benutzer mit diesem Benutzernamen existiert bereits.';
$lang['nocsvresults'] = 'Vom CSV-Export wurden keine Daten zur&uuml;ckgegeben.';
$lang['prompt_unfldlen'] = 'L&auml;nge des Benutzernamen-Feldes';
$lang['prompt_pwfldlen'] = 'L&auml;nge des Passwort-Feldes';
$lang['error_invalidpasswordlengths'] = 'Beim Unter-/&Uuml;berschreiten dieser L&auml;nge ist das Passwort ung&uuml;ltig.';
$lang['error_invalidusernamelengths'] = 'Beim Unter-/&Uuml;berschreiten dieser L&auml;nge ist der Benutzername ung&uuml;ltig.';
$lang['error_invalidemailaddress'] = 'Ung&uuml;ltige Email-Adresse';
$lang['error_noemailaddress'] = 'F&uuml;r dieses Benutzerkonto wurde keine Emailadresse gefunden.';
$lang['error_problemseettinginfo'] = 'Problem beim Setzen der Benutzerinformationen';
$lang['error_settingproperty'] = 'Problem beim Setzen der Eigenschaften';
$lang['user_added'] = 'Benutzer %s = %s wurde hinzugef&uuml;gt';
$lang['user_deleted'] = 'Benutzer mit der uid=%s wurde gel&ouml;scht';
$lang['propertyfilter'] = 'Eigenschaft';
$lang['valueregex'] = 'Wert (regul&auml;rer Ausdruck)';
$lang['warning_effectsfieldlength'] = 'Warnung: Diese Felder beeinflussen die Gr&ouml;&szlig;e der Eingabefelder in Formularen. Die Verringerung dieser Zahl ist daher auf einer bereits existierenden Seite nicht ratsam.';
$lang['confirm_submitprefs'] = 'Wollen Sie wirklich die Moduleinstellungen &auml;ndern?';
$lang['error_emailalreadyused'] = 'Diese Emailadresse ist bereits in Verwendung.';
$lang['prompt_usecookiestoremember'] = 'Cookies f&uuml;r die Speicherung der Anmelde-Details verwenden';
$lang['prompt_cookiename'] = 'Der Name des Cookies';
$lang['prompt_allow_duplicate_emails'] = 'Email-Adressduplikate erlauben';
$lang['prompt_username_is_email'] = 'Die Email-Adresse soll der Benutzername sein';
$lang['info_cookie_keepalive'] = 'Es wird versucht, die erfolgreiche Anmeldung &uuml;ber einen Cookie auf dem Rechner zu speichern <em>(der Cookie wird bei entsprechenden Aktivit&auml;ten auf der Webseite zur&uuml;ck gesetzt)</em>';
$lang['info_allow_duplicate_emails'] = '(erlaubt mehreren Benutzern die Nutzung der gleichen Emailadresse)';
$lang['info_username_is_email'] = '(die Email-Adresse des Benutzers ist sein Benutzername -- verwenden Sie diese Einstellung NIEMALS zusammen mit &quot;Email-Adressduplikate erlauben&quot;!)';
$lang['prompt_allow_duplicate_reminders'] = 'Erneute Anfrage &quot;Passwort vergessen&quot; erlauben?';
$lang['info_allow_duplicate_reminders'] = '(erlaubt einem Benutzer die erneute Anfrage auf das Zur&uuml;cksetzen des Passwortes, auch wenn er auf eine vorangegangene Zur&uuml;cksetzung nicht reagiert hat)';
$lang['prompt_feusers_specific_permissions'] = 'FrontendUser-spezifische Berechtigungen verwenden?';
$lang['info_feusers_specific_permissions'] = '(Normalerweise entsprechen die FEUsers Berechtigungen denen aus der Administration wie etwa Benutzer hinzuf&uuml;gen, Gruppe hinzuf&uuml;gen usw. Wenn Sie jedoch diese Option ausw&auml;hlen, werden f&uuml;r die FrontendUsers-Benutzerkonten separate Berechtigungen gesetzt.)';
$lang['error_missingupload'] = 'Konnte die hochgeladene Datei nicht finden (interner Fehler)';
$lang['error_problem_upload'] = 'Mit der hochgeladenen Datei ist ein Problem aufgetreten. Bitte versuchen Sie es noch einmal.';
$lang['error_missingusername'] = 'Sie haben keinen Benutzernamen eingegeben.';
$lang['error_missingemail'] = 'Sie haben Ihre Email-Adresse nicht eingegeben!';
$lang['error_missingpassword'] = 'Sie haben kein Passwort eingegeben.';
$lang['frontenduser_logout'] = 'FrontendUser - Abmeldung';
$lang['frontenduser_loggedin'] = 'FrontendUser - Anmeldung';
$lang['editprop_infomsg'] = '<span style=&quot;color: red&quot;><b>ACHTUNG</b> Wenn Sie bereits existierende Eigenschaften &auml;ndern, die schon Gruppen zugeordnet sind, kann Ihre Seite m&ouml;glicherweise zerst&ouml;rt werden<i>(besonders, wenn Sie die L&auml;nge der Felder reduzieren, etc).</i></span>';
$lang['info_smtpvalidate'] = 'Dies funktioniert NICHT unter Windows.';
$lang['msg_dontcreateusername'] = 'Erstellen Sie NIEMALS eine Eigenschaft f&uuml;r einen Benutzernamen oder Passwort. Dies ist im FrontEndUsers-Modul bereits eingebaut.';
$lang['prompt_exportcsv'] = 'Benutzer in eine CSV-Datei exportieren';
$lang['exportcsv'] = 'Exportieren';
$lang['importcsv'] = 'Importieren';
$lang['admin'] = 'Administrator';
$lang['editprop'] = 'Eigenschaft <em>%s</em> bearbeiten';
$lang['maxlength'] = 'Maximale L&auml;nge';
$lang['created'] = 'Erstellt';
$lang['sortby'] = 'Sortieren nach';
$lang['sort'] = 'Sortierung';
$lang['usersingroup'] = 'Benutzer in der/den ausgew&auml;hlten Gruppe(n)';
$lang['userlimit'] = 'Ergebnisse beschr&auml;nken auf';
$lang['error_noemailfield'] = 'F&uuml;r diesen Benutzer konnte das Email-Feld nicht gefunden werden. Bitte kontaktieren Sie den Systemadministrator.';
$lang['prompt_forgotpw_page'] = 'Seiten-ID/-Alias f&uuml;r das Formular &quot;Passwort vergessen&quot;';
$lang['prompt_changesettings_page'] = 'Seiten-ID/-Alias f&uuml;r das Formular &quot;Einstellungen &auml;ndern&quot;';
$lang['prompt_login_page'] = 'Seiten-ID/-Alias der Seite, auf die nach der Anmeldung gesprungen werden soll *';
$lang['prompt_logout_page'] = 'Seiten-ID/-Alias der Seite, auf die nach der Abmeldung gesprungen werden soll *';
$lang['sortorder'] = 'Sortierreihenfolge';
$lang['prompt_numresetrecord'] = 'Anzahl der Benutzern, die ihr verlorenes Passwort zur&uuml;ckzusetzen m&ouml;chten. Aktuell steht der Z&auml;hler auf:';
$lang['remove1week'] = 'Alle Eintr&auml;ge entfernen, die &auml;lter als eine Woche sind';
$lang['remove1month'] = 'Alle Eintr&auml;ge entfernen, die &auml;lter als ein Monat sind';
$lang['removeall'] = 'Alle Eintr&auml;ge entfernen';
$lang['areyousure'] = 'Wollen Sie das wirklich?';
$lang['error_invalidcode'] = 'Sie haben einen ung&uuml;ltigen Code eingegeben; bitte versuchen Sie es noch einmal.';
$lang['error_tempcodenotfound'] = 'F&uuml;r Ihre Benutzer-ID wurde kein tempor&auml;rer Code in der Datenbank gefunden.';
$lang['forgotpassword_verifytemplate'] = 'Template f&uuml;r die Anzeige des &Uuml;berpr&uuml;fungs-Formulars';
$lang['forgotpassword_emailtemplate'] = 'Template f&uuml;r die Email bei vergessenem Passwort';
$lang['error_resetalreadysent'] = 'Entweder Sie selbst oder jemand anderes hat bereits das Zur&uuml;cksetzen des Passworts f&uuml;r diese Konto ausgel&ouml;st. Pr&uuml;fen Sie Ihren Email-Eingang. Sie finden dort weitere Anweisungen zum Zur&uuml;cksetzen Ihres Passwortes.';
$lang['error_dberror'] = 'Datenbankfehler';
$lang['message_forgotpwemail'] = 'Sie erhalten diese Nachricht, da jemand auf unserer Seite angegeben hat, dass Sie Ihr Passwort verloren haben. Falls dies zutrifft, lesen Sie bitte die weiteren Anweisungen.  Wenn Sie keine Ahnung haben, um was es geht, dann l&ouml;schen Sie sicherheitshalber diese Nachricht. Wir bedanken uns, dass Sie sich die Zeit genommen haben.';
$lang['prompt_code'] = 'Code ';
$lang['message_code'] = 'Der folgende Code wurde zuf&auml;llig generiert, um das Benutzer-Konto zu &uuml;berpr&uuml;fen. Wenn Sie auf den folgenden Link klicken, gelangen Sie auf eine Seite, wo Sie diesen Code eingeben m&uuml;ssen. Normalerweise enth&auml;lt das Feld bereits Ihren Code. Falls aber nicht, lautet der Code:';
$lang['prompt_link'] = 'Ein Klick auf den folgenden Link bringt Sie auf die Webseite, wo Sie den untenstehenden Code eingeben und damit Ihr Passwort zur&uuml;cksetzen k&ouml;nnen:';
$lang['lostpassword_emailsubject'] = 'Passwort verloren';
$lang['error_nomailermodule'] = 'Das CMSMailer-Modul wurde nicht gefunden.';
$lang['info_forgotpwmessagesent'] = 'Eine Email mit Informationen zum Zur&uuml;cksetzen des Passworts wurde an %s versandt. Vielen Dank!';
$lang['lostpw_message'] = 'Sie haben Ihr Passwort vergessen oder verloren. Geben Sie hier Ihren Benutzernamen ein. Wenn wir Sie im System finden, erhalten Sie eine Email mit weiteren Anweisungen zum Zur&uuml;cksetzen des Passworts.';
$lang['forgotpassword_template'] = 'Template f&uuml;r vergessene Passw&ouml;rter';
$lang['lostusername_template'] = 'Template f&uuml;r vergessene Benutzernamen';
$lang['error_propnotfound'] = 'Eigenschaft %s nicht gefunden';
$lang['propsfound'] = 'Eigenschaften gefunden';
$lang['addprop'] = 'Eigenschaft hinzuf&uuml;gen';
$lang['error_requiredfield'] = 'Ein erforderliches Feld (%s) war leer.';
$lang['info_emptypasswordfield'] = 'Um Ihr Passwort zu &auml;ndern, geben Sie bitte hier ein neues Passwort ein.';
$lang['error_notloggedin'] = 'Es scheint so, als ob Sie nicht angemeldet sind.';
$lang['user_settings'] = 'Einstellungen';
$lang['user_registration'] = 'Registrierung';
$lang['error_accountexpired'] = 'Dieses Konto ist abgelaufen';
$lang['error_improperemailformat'] = 'Ungenaue Formatierung der Email-Adresse';
$lang['error_invalidexpirydate'] = 'Ung&uuml;ltiges Ablaufdatum';
$lang['error_problemsettingproperty'] = 'Fehler beim Setzen der Eigenschaft %s f&uuml;r den Benutzer $s';
$lang['error_invalidgroupid'] = 'Ung&uuml;ltige Gruppen-ID %s';
$lang['hiddenfieldmarker'] = 'Kennzeichnung f&uuml;r verborgene Felder';
$lang['hiddenfieldcolor'] = 'Farbe f&uuml;r verborgene Felder';
$lang['hidden'] = 'Verborgen';
$lang['error_duplicatename'] = 'Eine Eigenschaft mit diesem Namen existiert bereits.';
$lang['error_noproperties'] = 'Es wurden noch keine Eigenschaften definiert.';
$lang['error_norelations'] = 'F&uuml;r diese Benutzergruppe wurden keine Eigenschaften ausgew&auml;hlt.';
$lang['nogroups'] = 'Es wurden noch keine Gruppen definiert.';
$lang['groupsfound'] = 'Benutzergruppen gefunden';
$lang['error_onegrouprequired'] = 'Die Mitgliedschaft in mindestens einer Gruppe ist erforderlich.';
$lang['prompt_requireonegroup'] = 'Erfordert die Mitgliedschaft in mindestens einer Gruppe';
$lang['back'] = 'Zur&uuml;ck';
$lang['error_missing_required_param'] = '%s ist ein Pflichtfeld.';
$lang['requiredfieldmarker'] = 'Pflichtfelder kennzeichnen mit';
$lang['requiredfieldcolor'] = 'Pflichtfelder einf&auml;rben mit';
$lang['next'] = 'Weiter';
$lang['error_groupexists'] = 'Eine Gruppe mit diesem Namen existiert bereits.';
$lang['required'] = 'Pflichtfeld';
$lang['optional'] = 'optional';
$lang['off'] = 'Aus';
$lang['size'] = 'Gr&ouml;&szlig;e';
$lang['sizecomment'] = '<br/>(Maximale Gr&ouml;&szlig;e irgend einer Bilddimension in Pixel)';
$lang['length'] = 'L&auml;nge';
$lang['lengthcomment'] = '<br>(Zeichen in der Texteingabe)';
$lang['seloptions'] = 'Listenfeld-Optionen, getrennt durch Zeilenumbr&uuml;che. Die Werte k&ouml;nnen mit a = Zeichen vom Text getrennt werden, z.Bsp.: Weiblich=w';
$lang['radiooptions'] = 'Beschriftung des Optionsfeldes, getrennt durch Zeilenumbr&uuml;che. Die Werte k&ouml;nnen mit a = Zeichen vom Text getrennt werden, z.Bsp.: Weiblich=w';
$lang['prompt'] = 'Eingabeaufforderung';
$lang['prompt_type'] = 'Typ';
$lang['type'] = 'Typ';
$lang['fieldstatus'] = 'Feldstatus';
$lang['usedinlostun'] = 'Frage bei vergessenem<br/>Benutzernamen';
$lang['text'] = 'Text ';
$lang['checkbox'] = 'Kontrollk&auml;stchen';
$lang['multiselect'] = 'Mehrfachlistenauswahl';
$lang['radiobuttons'] = 'Optionsfelder';
$lang['image'] = 'Bild';
$lang['email'] = 'Email-Adresse';
$lang['textarea'] = 'Textfeld';
$lang['dropdown'] = 'Listenfeld';
$lang['msg_currentlyloggedinas'] = 'Willkommen';
$lang['logout'] = 'Abmelden';
$lang['prompt_newgroupname'] = 'Diesen Gruppennamen verwenden';
$lang['prompt_changesettings'] = 'Meine Einstellungen &auml;ndern';
$lang['error_loginfailed'] = 'Ihre Anmeldung ist fehlgeschlagen - ung&uuml;ltiger Benutzername oder ung&uuml;ltiges Passwort?';
$lang['login'] = 'Anmelden';
$lang['prompt_signin_button'] = 'Beschriftung des Anmelde-Buttons';
$lang['prompt_username'] = 'Benutzername';
$lang['prompt_email'] = 'Email-Adresse';
$lang['prompt_password'] = 'Passwort';
$lang['prompt_rememberme'] = 'Anmeldung auf diesem Computer merken';
$lang['register'] = 'Registrieren';
$lang['forgotpw'] = 'Haben Sie Ihr Passwort vergessen?';
$lang['lostusername'] = 'Haben Sie Ihre Benutzerdaten vergessen?';
$lang['defaults'] = 'Standard';
$lang['template'] = 'Template ';
$lang['error_usernotfound'] = 'Konnte keine Informationen f&uuml;r diesen Benutzer finden';
$lang['error_usernametaken'] = 'Dieser Benutzername (%s) wird bereits verwendet.';
$lang['prompt_smtpvalidate'] = 'Soll SMTP verwendet werden, um Email-Adressen auf G&uuml;ltigkeit zu pr&uuml;fen?';
$lang['prompt_minpwlen'] = 'Minimale L&auml;nge des Passworts';
$lang['prompt_maxpwlen'] = 'Maximale L&auml;nge des Passworts';
$lang['prompt_minunlen'] = 'Minimale L&auml;nge des Benutzernamens';
$lang['prompt_maxunlen'] = 'Maximale L&auml;nge des Benutzernamens';
$lang['prompt_sessiontimeout'] = 'Auszeit f&uuml;r Sessions (in Sekunden)';
$lang['prompt_cookiekeepalive'] = 'Cookies f&uuml;r die Anmeldung verwenden';
$lang['prompt_allowemailreg'] = 'Email-Registrierung erlauben';
$lang['prompt_dfltgroup'] = 'Standard-Benutzergruppe f&uuml;r neue Benutzer';
$lang['changesettings_template'] = 'Template f&uuml;r Einstellungen &auml;ndern';
$lang['error_passwordmismatch'] = 'Die Passw&ouml;rter stimmen nicht &uuml;berein.';
$lang['error_invalidusername'] = 'Ung&uuml;ltiger Benutzername';
$lang['error_invalidpassword'] = 'Ung&uuml;ltiges Passwort';
$lang['edituser'] = 'Benutzer bearbeiten';
$lang['valid'] = 'G&uuml;ltig';
$lang['username'] = 'Benutzername';
$lang['status'] = 'Status ';
$lang['error_membergroups'] = 'Dieser Benutzer ist noch kein Mitglied einer Benutzergruppe.';
$lang['error_properties'] = 'Keine Eigenschaften';
$lang['error_dup_properties'] = 'Sie haben versucht, Eigenschaften doppelt zu importieren';
$lang['value'] = 'Wert';
$lang['groups'] = 'Benutzergruppen';
$lang['properties'] = 'Eigenschaften';
$lang['propname'] = 'Name der Eigenschaft';
$lang['propvalue'] = 'Wert der Eigenschaft';
$lang['add'] = 'Hinzuf&uuml;gen';
$lang['history'] = 'Geschichte';
$lang['edit'] = 'Bearbeiten';
$lang['expires'] = 'Ablauf';
$lang['specify_date'] = 'Datum festlegen';
$lang['12hrs'] = '12 Stunden';
$lang['24hrs'] = '24 Stunden';
$lang['48hrs'] = '48 Stunden';
$lang['1week'] = '1 Woche';
$lang['2weeks'] = '2 Wochen';
$lang['1month'] = '1 Monat';
$lang['3months'] = '3 Monate';
$lang['6months'] = '6 Monate';
$lang['1year'] = '1 Jahr';
$lang['never'] = 'Niemals';
$lang['postinstallmessage'] = 'Das Modul wurde installiert.<br/>Stellen Sie sicher, dass die Berechtigung &quot;Modify FrontEndUser Properties&quot; gesetzt wurde. Zus&auml;tzlich wird die Installation des Captcha-Moduls empfohlen. Nach dessen Installation wird bei der Anmeldung erg&auml;nzend zu Benutzernamen und Passwort der Inhalt eines Captcha-Bildes abgefragt. Dies soll helfen, Brute-force-Attacken zu verhindern. <strong>Hinweis:</strong> Diese Funktionalit&auml;t kann mit dem Parameter nocaptcha deaktiviert werden, auch wenn das Captcha-Modul installiert ist.';
$lang['password'] = 'Passwort';
$lang['repeatpassword'] = 'Wiederholung Passwort';
$lang['error_groupname_exists'] = 'Eine Benutzergruppe mit diesem Namen existiert bereits.';
$lang['editgroup'] = 'Benutzergruppe bearbeiten';
$lang['submit'] = 'Absenden';
$lang['cancel'] = 'Abbrechen';
$lang['delete'] = 'L&ouml;schen';
$lang['confirm_editgroup'] = 'Sind das wirklich die richtigen Einstellungen f&uuml;r diese Benutzergruppe?\nDas Deaktivieren einer Eigenschaft l&ouml;scht keine Eintr&auml;ge in der Eigenschaftentabelle f&uuml;r diese Benutzergruppe/diesen Benutzer. Sie sind lediglich nicht mehr verf&uuml;gbar.';
$lang['areyousure_deletegroup'] = 'Wollen Sie diese Benutzergruppe wirklich l&ouml;schen?';
$lang['confirm_delete_prop'] = 'Wollen Sie diese Eigenschaft wirklich komplett l&ouml;schen?\nFalls ja, wird auch jeder Benutzereintrag f&uuml;r diese Eigenschaft gel&ouml;scht.';
$lang['error_insufficientparams'] = 'Unzureichende Parameter';
$lang['id'] = 'ID';
$lang['name'] = 'Name ';
$lang['error_cantaddprop'] = 'Problem beim Hinzuf&uuml;gen einer Eigenschaft';
$lang['error_cantaddgroupreln'] = 'Problem beim Hinzuf&uuml;gen einer Gruppenbeziehung';
$lang['error_cantaddgroup'] = 'Problem beim Hinzuf&uuml;gen einer Benutzergruppe';
$lang['error_cantassignuser'] = 'Problem beim Hinzuf&uuml;gen eines Benutzers zu einer Benutzergruppe';
$lang['error_couldnotdeleteproperty'] = 'Problem beim L&ouml;schen einer Eigenschaft';
$lang['error_couldnotfindemail'] = 'Konnte keine Email-Adresse finden';
$lang['error_destinationnotwritable'] = 'Sie haben keine Schreibberechtigung f&uuml;r das Zielverzeichnis.';
$lang['error_invalidparams'] = 'Ung&uuml;ltige Parameter';
$lang['error_nogroups'] = 'Konnte keine Benutzergruppen finden';
$lang['applyfilter'] = 'Anwenden';
$lang['filter'] = 'Filter ';
$lang['userfilter'] = 'Benutzername (regul&auml;rer Ausdruck)';
$lang['description'] = 'Beschreibung';
$lang['groupname'] = 'Name der Benutzergruppe ';
$lang['accessdenied'] = 'Zugriff verweigert';
$lang['error'] = 'Fehler';
$lang['addgroup'] = 'Eine Benutzergruppe hinzuf&uuml;gen';
$lang['importgroup'] = 'Gruppe importieren';
$lang['adduser'] = 'Einen Benutzer hinzuf&uuml;gen';
$lang['usersfound'] = 'Benutzer gefunden, die den Kriterien entsprechen';
$lang['group'] = 'Benutzergruppe ';
$lang['selectgroup'] = 'Benutzergruppe ausw&auml;hlen';
$lang['registration_template'] = 'Registrierungs-Template';
$lang['logout_template'] = 'Abmeldungs-Template';
$lang['login_template'] = 'Anmeldungs-Template';
$lang['preferences'] = 'Einstellungen';
$lang['users'] = 'Benutzer';
$lang['friendlyname'] = 'FrontendUser-Verwaltung';
$lang['moddescription'] = 'Erlaubt den Benutzern, sich auf Ihrer Webseite anzumelden';
$lang['defaultfrontpage'] = 'Standard-Startseite';
$lang['lastaccessedpage'] = 'Letzte Seite, auf die zugegriffen wurde';
$lang['otherpage'] = 'Andere Seite: ';
$lang['captcha_title'] = 'Geben Sie den Text aus dem Bild ein';
$lang['help'] = '<h3>Was macht dieses Modul?</h3>
<p>Dieses Modul erlaubt die Verwaltung und Administration von FrontEnd-Benutzern <i>(=Benutzer, die keinen Zugriff auf die Administration haben)</i>. Es erm&ouml;glicht zum einen das Erstellen von Benutzergruppen und Benutzerkonten und zum anderen das An- und Abmelden von Benutzern. In Verbindung mit dem CustomContent-Modul k&ouml;nnen unterschiedlichen Benutzern unterschiedliche Inhalte angezeigt werden, jeweils in Abh&auml;ngigkeit davon, ob der Benutzer angemeldet ist oder nicht.</p>
<h3>Features</h3>
<ul>
<li><p>Ablauf der Benutzerkonten. Hiermit k&ouml;nnen Sie f&uuml;r eine bestimmte Zeitdauer einen Benutzer erstellen.</p></li>
<li><p>Benutzergruppen-Eigenschaften. Sie k&ouml;nnen von den Mitgliedern unterschiedliche Gruppen und unterschiedliche Informationen abfragen.</p></li>
<li><p>Es ist die Verwaltung von Hunderten Benutzern m&ouml;glich.</p></li>
<li><p>Funktionalit&auml;t f&uuml;r vergessene Benutzernamen und Passw&ouml;rter. Benutzer k&ouml;nnen ein neues Passwort festlegen, und/oder ihr Benutzerkonto wiederherstellen, falls sie die Anmeldedaten komplett vergessen haben.</p></li>
<li><p>hat eine umfangreiche API f&uuml;r das Hinzuf&uuml;gen von Funktionen</p></li>
</ul>
<h3>Wie wird es eingesetzt ?</h3>
<ul>
<li><p>Nach der Installation k&ouml;nnen Sie unter dem Men&uuml; &quot;Benutzerverwaltung&quot; auf die Administration des FrontEndUsers-Moduls zugreifen.</p></li>
<li>
<p>Zun&auml;chst m&uuml;ssen Sie Eigenschaften f&uuml;r die Benutzer definieren (mindestens eine!). Eigenschaften sind Felddefinitionen, mit denen Sie den Typ der zu erfassenden Informationen und deren Beschr&auml;nkungen festlegen k&ouml;nnen wie zum Beispiel: Name, Alter, Stadt, Bundesland, Staat, Emailadresse usw.</p>
<p><b>Hinweis:</b> F&uuml;r den Benutzernamen (oder Email-Adresse) und das Passwort m&uuml;ssen Sie keine Eigenschaften festlegen; dies wird bereits vom Modul erledigt.</p>
<p><b>Hinweis:</b> Bei neuen Installationen des FEU-Moduls ist voreingestellt, dass die Email-Adresse des Benutzers sein Benutzername ist. Dies kann in der Moduladministration ge&auml;ndert werden. Wenn Sie diese Option verwenden, m&uuml;ssen Sie keine Eigenschaft &quot;Email-Adresse&quot; erstellen.</p>
</li>
<li><p>Als N&auml;chstes sollten Sie eine oder mehrere Benutzergruppen erstellen. Wenn Sie eine Gruppe erstellen, werden Sie nach dem Benutzergruppennamen, einer Beschreibung sowie den der Benutzergruppe zuzuordnenden Eigenschaften und dessen Sortierung gefragt. Optional sind auch Pflicht- oder verborgene Felder m&ouml;glich <i>(auch off ist g&uuml;ltig)</i></p></li>
<li><p><b>Hinweis:</b> Bevor Sie weiter machen, sollten Sie pr&uuml;fen, ob die Einstellungen korrekt gesetzt sind.</p></li>
<li><p>Anschlie&szlig;end sollten Sie ein paar Benutzer erstellen. Benutzer werden in zwei Schritten hinzugef&uuml;gt. Wenn Sie einen Benutzer erstellen, werden Sie nach dem Benutzernamen und dem Passwort sowie nach einem Ablaufdatum f&uuml;r diesen Benutzer gefragt. Dann m&uuml;ssen Sie noch die Gruppen ausw&auml;hlen, in welchen der Benutzer Mitglied sein soll. Klicken Sie dann auf &quot;Weiter&quot;</p>
<p><em>Hinweis: </em>Das ist ein sehr arbeitsintensiver und langweiliger Prozess. Es ist daher einfacher, wenn Sie sich die Benutzer selbst registrieren lassen (zum Beispiel mit dem SelfRegistration-Modul). Sie m&uuml;ssen die Benutzer dann nur noch einer oder mehreren Benutzergruppen zuordnen. Aber erstellen Sie bitte f&uuml;r Testzwecke mindestens einen Benutzer.</p></li>
<li><p>Nachdem das System alle f&uuml;r diesen Benutzer notwendigen Felder bestimmt hat, wird Ihnen ein Formular mit den erforderlichen Informationen &uuml;ber den Benutzer angezeigt. Mit der Komplettierung dieses Formulars wird das Hinzuf&uuml;gen eines Benutzers abgeschlossen. </p></li>
<li><p>Jetzt k&ouml;nnen Sie das FrontEndUsers-Modul auf Ihrer Webseite nutzen. Hierzu m&uuml;ssen Sie einfach nur {cms_module module=&quot;FrontEndUsers&quot;} in Ihre Seite oder Template einf&uuml;gen.</p></li>
</ul>
<h3>Smarty-Funktionen</h3>
<p>&Uuml;ber Smarty und das $feu_smarty-Objekt kann auf die Datenbank des FrontEndUsers-Modul zugegriffen werden.</p>
<h4>Funktionen:</h4>
<ul>
<li><strong><code>{$feu_smarty->get_users_by_groupname($groupname,$assign)}</code></strong>
<p>Diese Funktion kann verwendet werden, um ein Array mit allen Benutzernamen und Benutzer-IDs einer vorgegebenen Gruppe zu erhalten. Das Ergebnis wird der im Parameter &quot;assign&quot; vorgegebenen Smarty-Variablen zugewiesen.</p>
<p>Beispiel:<br/><code>{$feu_smarty->get_users_by_groupname(&#039;members&#039;,&#039;mymembers&#039;)}<br/>{$mymembers|print_r}</code></p>
</li>
<li><strong><code>{$feu_smarty->get_user_properties($uid,$assign)}</code></strong>
<p>Diese Funktion kann verwendet werden, um auf eine Liste aller Eigenschaften eines bestimmten Benutzers zuzugreifen. Das Ergebnis wird der im Parameter &quot;assign&quot; vorgegebenen Smarty-Variablen zugewiesen.</p>
<p>Beispiel:<br/><code>{$feu_smarty->get_user_properties(5,&#039;userprops&#039;)}<br/>{$userprops|print_r}</code></p>
</li>

<li><strong><code>{$feu_smarty->get_dropdown_text($propname,$propvalue[,$assign])}</code></strong>
<p>Diese Funktion gibt den vorgegebenen Text zur&uuml;ck, die der ausgew&auml;hlten Option der Listenfeldauswahl entspricht.</li>
<p>Beispiel:<br/><code>{$feu_smarty->get_dropdown_text(&#039;age_range&#039;,$onepropvalue)}</code></p>
</li>

<li><strong><code>{$feu_smarty->get_multiselect_text($propname,$propvalue,$assign)}</code>
</strong>
<p>Diese Funktion gibt ein Array mit den Texten zur&uuml;ck, die den mit Kommata getrennten Liste der Optionswerte entspricht.</li>
<p>Beispiel:<br/><code>{$feu_smarty->get_multiselect_text(&#039;favorite_foods&#039;,$onepropvalue,&#039;favorite_foods&#039;)}<br/>{$favorite_foods|@print_r}</code></p>
</li>

<li><strong>code>{$feu_smarty->get_user_expiry($uid[,$assign])}</code></strong>
<p>Diese Funktion gibt einen Unix-Zeitstempel zur&uuml;ck, an dem das angegebene uid-Konto abl&auml;uft. Es wird false zur&uuml;ckgegeben, wenn die uid nicht gefunden werden kann oder ein anderer Fehler auftritt.</p>
<p>Example:<br/><code>{$feu_smarty->get_user_expiry(25,&#039;expiry&#039;)}<br/>{$expiry|cms_date_format}</code></p>
</li>

<li><strong>code>{$feu_smarty->user_expired($uid[,$assign])}</code></strong>
<p>Diese Funktion gibt eine Ganzzahl zur&uuml;ck, die anzeigt, ob das vorgegebene Konto abgelaufen ist. Es wird false zur&uuml;ckgegeben, wenn die uid nicht gefunden werden kann oder ein anderer Fehler auftritt.</p>
<p>Example:<br/><code>{$feu_smarty->user_expired(25,&#039;expired&#039;)}<br/>{if $expired}UID 25 kann sich nicht mehr auf der Webseite anmelden{/if}</code></p>
</li>
</ul>
<h3>Eintr&auml;ge zur Privatsph&auml;re:</h3>
<p>Dieses Modul erfasst die IP-Adresse der Benutzer und speichert diese Daten in der Benutzerhistorie. Au&szlig;erdem kann der Administrator festlegen, ob Cookies verwendet werden sollen. Es werden jedoch keine pers&ouml;nlichen Informationen in den Cookies gespeichert, sondern lediglich ein eindeutiger Benutzer- und ein Session-Identifikator.</p>
<h3>Support</h3>
<p>Dieses Modul beinhaltet keinen kommerziellen Support. Sie k&ouml;nnen jedoch &uuml;ber folgende M&ouml;glichkeiten Hilfe zu dem Modul erhalten:</p>
<ul>
<li>F&uuml;r die letzte Version dieses Moduls, FAQs, dem Versand eines Fehlerreports oder dem Kauf kommerziellen Support besuchen sie bitte calguys Homepage unter <a href="http://calguy1000.com">calguy1000.com</a>.</li>
<li>Eine weitere Diskussion zu diesem Modul ist auch in den Foren von <a href="http://forum.cmsmadesimple.org">CMS Made Simple</a> zu finden.</li>
<li>Der Autor calguy1000, ist h&auml;ufig im <a href="irc://irc.freenode.net/#cms">CMS IRC Channel</a> zu finden.</li>
<li>Letztlich erreichen sie den Autor auch &uuml;ber eine direkte Email.</li>  
</ul>
<h3>Parameter</h3>
<ul>
<li><em>(optional)</em> action=&quot;default&quot;<li>
<p>Aktionen:
<ul>
<li><em>default</em> - die voreingestellte Aktion, die die normalen Formulareigenschaften aktiviert.</li>
<li><em>reset_session</em> - gibt ein Javascript-kontrolliertes Template aus, &uuml;ber das die Benutzer-Session manuell oder automatisch kontrolliert werden kann. Dieses Template kann verwendet, um den Benutzer an den Ablauf der Session zu erinnern und auf dessen Voreinstellungen zur&uuml;ckzusetzen. Normalerweise ist diese Methode nicht erforderlich, da jede Seite, die angezeigt wird, dies bereits erledigt. Wenn Sie jedoch Seiten haben, auf der es sehr viel zu lesen gibt, ist dies eine sehr n&uuml;tzliche L&ouml;sung.</li>
<li><em>viewuser</em> - zeigt einen Bericht f&uuml;r einen einzelnen Benutzer an, erg&auml;nzend muss der uid-Parameter verwendet werden.</li>
</ul>
</p>
<li><em>(optional)</em> form=&quot;name&quot;</li>
<p>Formulare:
<ul>
 <li><em>login</em> - Zeigt das Anmelde-Formular an</li>
 <li><em>logout</em> - Zeigt das Abmelde-Formular an</li>
 <li><em>changesettings</em> - Zeigt das Formular zum &Auml;ndern der Einstellungen an</li>
 <li><em>forgotpw</em> - Zeigt das Formular f&uuml;r vergessene Passw&ouml;rter an</li>
<li><em>lostusername</em> - Zeigt das Formular f&uuml;r vergessene Benutzernamen an</li>
<li><em>silent</em> = Zeigt nichts an, aber die Eigenschaften und andere Smarty-Variablen der aktuell angemeldeten Benutzer werden exportiert. Ist kein Benutzer angemeldet, werden auch keine Variablen exportiert.</li>
</ul>
</p>
<li><em>(optional)</em> returnto=&quot;page&quot;</li>
<p>Wird mit den Formularen zur An- und Abmelde- sowie zur &Auml;nderung von Einstellungen verwendet. Dieser Parameter enth&auml;lt die ID oder den Alias einer Seite, auf die der Benutzer weitergeleitet wird, wenn das Formular erfolgreich ausgef&uuml;llt wurde.</p>
<li><em>(optional)</em> only_groups=&quot;Gruppe1, Gruppe2, Gruppe3&quot;</li>
<p>Wird mit den Anmelde-Formularen verwendet. Es k&ouml;nnen sich nur die Benutzer anmelden, die Mitglieder der festgelegten Gruppe(n) sind.</p>
<li><em>(optional)</em> lostun_group=&quot;Gruppe&quot;</li>
<p>Bei Verwendung in Verbindung mit dem Formular f&uuml;r vergessene Benutzernamen kann mit diesem Parameter eine Gruppe festgelegt werden, der diese Benutzer zugeordnet werden sollen.</p>
<li><em>(optional)</em> nocaptcha=&quot;1&quot;</li>
<p>Wird mit den Anmelde-Formularen verwendet. Damit werden die Captchas in den Formularen deaktiviert. Wurde das Captcha-Modul installiert, ist f&uuml;r eine erfolgreiche Anmeldung standardm&auml;&szlig;ig die Eingabe des Inhaltes eines Captcha-Bildes erforderlich. Dies ist eine Sicherheitsma&szlig;nahme, um Brute-force-Attacken vorzubeugen.</p>
<li><em>(optional)</em> uid=null</li>
<p>Ist in Verbindung mit der Aktion viewuser zu verwenden. Mit diesem Parameter kann festgelegt werden, welcher Benutzer die Details angezeigt bekommt.</p>
</ul>
<p>Nach der GPL wird diese Software so ver&ouml;ffentlicht, wie sie ist. Bitte lesen Sie den Lizenztext f&uuml;r den vollen Haftungsausschluss.</p>
<h3>Anforderungen</h3>
<p>Um die Funktionalit&auml;t f&uuml;r die vergessenen Passw&ouml;rter nutzen zu k&ouml;nnen, muss zuvor das CMSMailer-Modul installiert und konfiguriert werden.</p>
<h3>Copyright und Lizenz</h3>
<p>Copyright &copy; 2008, Robert Campbell <a href="mailto:calguy1000@hotmail.com">calguy1000@hotmail.com</a>. Alle Rechte vorbehalten.</p>
<p>Dieses Modul wurde unter der <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a> ver&ouml;ffentlicht. Sie m&uuml;ssen dieser Lizenz zustimmen, bevor Sie das Modul verwenden.</p>
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
$lang['utma'] = '156861353.72018012.1309112017.1309112017.1309112017.1';
$lang['utmz'] = '156861353.1309112017.1.1.utmccn=(direct)|utmcsr=(direct)|utmcmd=(none)';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353';
?>