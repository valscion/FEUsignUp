<?php
$lang['friendlyname'] = 'FEUsignUp';
$lang['postuninstall'] = 'FEUsignUp moduuli on poistettu onnistuneesti.';
$lang['really_uninstall'] = 'Oikeastiko? Oletko varma että haluat\npoistaa tämän upean moduulin?';
$lang['uninstalled'] = 'Moduuli poistettu.';
$lang['installed'] = 'Moduulin versio %s asennettu.';
$lang['upgraded'] = 'Moduuli päivitetty versioon %s.';
$lang['moddescription'] = 'Mahdollistaa ilmoittautumisten lisäämisen suoraan CGCalendar ja Team Sport Scores -moduulien tapahtumiin.';

$lang['error'] = 'Virhe!';
$land['admin_title'] = 'FEUsignUp hallintapaneeli';
$lang['admindescription'] = 'A dull admin description';
$lang['accessdenied'] = 'Pääsy kielletty. Ole hyvä ja tarkista oikeutesi.';
$lang['postinstall'] = 'Muista asettaa "Use FEUsignUp" -oikeudet käyttääksesi tätä moduulia!';

$lang['overview'] = 'Yleisnäkymä';
$lang['title_overview'] = 'Yleisnäkymä';
$lang['info_overview'] = '<p>Hallitse kaikkia ilmoittautumisiasi täältä. Alla olevassa listassa on kaikki tietokannassa olevat ilmoittautumiset.</p>';
$lang['no_signups'] = 'Yhtään ilmoittautumista ei löytynyt!';

$lang['linkings'] = 'Linkitykset';
$lang['title_linkings'] = 'Linkitykset Frontend User -ryhmiin';
$lang['info_linkings'] = '<p>Hallitse linkityksiä Frontend User -ryhmien, CGCalendar:n kategorioiden ja Team Sport Scores -moduulin joukkueiden välillä.</p>';

$lang['template_displayevent'] = 'Pohja: Näytä tapahtuma';
$lang['title_template_displayevent'] = 'Pohja: Näytä tapahtuma';
$lang['info_template_displayevent'] = '<p>Muokkaa sivustolla näytettävien tapahtumien pohjaa.</p>';


## Linkings-tab stuff
$lang['linking_updated'] = 'Linkitys on päivitetty.';
$lang['linking_added'] = 'Uusi linkitys on lisätty.';
$lang['linking_deleted'] = 'Linkitys poistettiin.';
$lang['prompt_addlink'] = 'Lisää linkitys';
$lang['prompt_feugroup'] = 'Linkitä Frontend Users -ryhmä';
$lang['prompt_cgcal_category'] = 'CGCalendarin kategoriaan';
$lang['prompt_tss_team'] = 'tai TeamSportScoresin joukkueeseen';
$lang['prompt_description'] = 'Tämän linkityksen selitys:';
$lang['submit_new_link'] = 'Lähetä uusi linkitys';
$lang['submit_existing_link'] = 'Päivitä linkitys';

## Lists in admin-area
$lang['th_id'] = 'ID';
$lang['th_feug'] = 'FEU-ryhmä';
$lang['th_cgcc'] = 'CGCalendar-kategoria';
$lang['th_tsst'] = 'TSS-joukkue';
$lang['th_desc'] = 'Selitys';
$lang['th_feu'] = 'Käyttäjänimi';
$lang['th_event'] = 'Tapahtuma';
$lang['th_date'] = 'Päivämäärä';
$lang['th_signed_up'] = 'IN/OUT';
$lang['edit'] = 'Muokkaa';

## Listing of signups
$lang['from_calendar'] = 'Kalenteritapahtuma [%s]: ';
$lang['from_tss'] = 'Ottelu [%s]: ';
$lang['event_time_format'] = '%A, %d.%m.%y klo %H:%M';

## Editing an existing link
$lang['prompt_editlink'] = 'Linkityksen päivitys';
$lang['cancel'] = 'Peruuta';
$lang['delete'] = 'Poista';
$lang['areyousure_dellink'] = 'Haluatko varmasti poistaa tämän linkityksen?';

$lang['nothing_updated'] = 'Mitään ei päivitetty.';

## Empty values
$lang['no_tss_game'] = '-EI PELIÄ-';
$lang['no_cgc_event'] = '-EI TAPAHTUMAA-';

## Templates
$lang['defaults'] = 'Resetoi oletukset';
$lang['submit'] = 'Lähetä';
$lang['success_defaults'] = 'Oletukset palautettu onnistuneesti';
$lang['success_template'] = 'Pohja tallennettu onnistuneesti';

$lang['error-no_id_given'] = 'Et antanut ID:tä CGCalendarille tai Team Sport Scoresille!';
$lang['db_error'] = 'Virhe tietokannassa!';

## Update-action
$lang['update_failed'] = 'Ilmoittautuminen epäonnistui!';
$lang['update_failed_no_in_or_out'] = 'Ilmoittautuminen epäonnistui! Sinun täytyy valita IN tai OUT.';
$lang['event_not_found'] = 'Tapahtumaa ei löytynyt!';
$lang['not_admin'] = 'Sinulla ei ole oikeuksia muokata tämän käyttäjän ilmoittautumista!';
$lang['user_not_found_by_id'] = 'Käyttäjää ID:llä %s ei löydy tietokannasta!';
$lang['signup_updated'] = 'Ilmoittautuminen päivitetty onnistuneesti!';

## Editing a signup
$lang['areyousure_delsignup'] = 'Haluatko varmasti poistaa tämän ilmoittautumisen?';
$lang['signup_deleted'] = 'Ilmoittautuminen poistettu onnistuneesti.';

## Other
$lang['module_error'] = 'Virhe FEUsignUp-moduulissa! Voisitko ystävällisesti ilmoittaa virheestä ylläpitäjälle?';

$lang['changelog'] = '<ul>
<li>Version 0.0.1 - 8 April 2011. Initial Release.</li>
</ul>';
$lang['help'] = '<h3>Mitä tämä tekee?</h3>
<p>Mahdollistaa ilmoittautumisten lisäämisen suoraan CGCalendar ja Team Sport Scores -moduulien tapahtumiin</p>
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