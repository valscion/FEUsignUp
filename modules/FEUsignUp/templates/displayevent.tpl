<script type="text/javascript">

var signup_event_id = {$event->id};
{literal}
$("a.jslink").click( function(clickEvent) {
    clickEvent.preventDefault();
    var userId = $(this).parent().parent().find('input[name="user_id"]').val();
    var href = $(this).attr("href");
    $.fancybox.showActivity();
    var msgObj = $("#displayevent_info");
    // Let's fade out the text there already is.
    msgObj.fadeOut( 100, function() {
        msgObj.load( href,{ 
          event_id: signup_event_id,
          user_id: userId, 
          username: $('#username_'+userId).text(),
          signup: $('input[name="radio_'+userId+'"]:checked').val(),
          description: $('input[name="desc_'+userId+'"]').val()
          }, function() {
            $.fancybox.hideActivity();
            // And now flash the text by fading it in, out and in again.
            msgObj.fadeIn( 400, function() { 
                msgObj.fadeOut( 400, function() { 
                    msgObj.fadeIn( 400 );
                });
            });
        });
    });
});
</script>

<style type="text/css">

div.displayevent_test {
  background-color: #fff;
  padding: 10px;
  width: 400px;
  font-size: 13.333px;
}
div.displayevent_test table {
  border-collapse: collapse;
  width: 100%;
}
div.displayevent_test td, div.displayevent_test th {
  border: 0;
}
div.displayevent_test td {
    border-top: 1px solid black;
  padding: 4px;
}
div.displayevent_test td input[type=text] {
  background-color: #fff;
  border:1px solid #bbb;
  width: 100%;
}
div.displayevent_test td input[type=text]:focus {
  border:1px solid #666;
}
div.displayevent_test td.feusu_in, div.displayevent_test td.feusu_out {
  padding: 0 10px;
  text-align: center;
  vertical-align: middle;
}

div.displayevent_test .feusu_in {
  background-color: green;
}
div.displayevent_test .feusu_out {
  background-color: red;
}

div.displayevent_test td.feusu_submit {
  vertical-align: middle;
}


div#displayevent_info {
  display: none;
  font-size: 13.333px;
  margin-bottom: 6px;
}

</style>
{/literal}
<div class="displayevent_test">
<div id="displayevent_info"></div>
{if !$ccuser->loggedin()}
  {* Ei sisäänkirjautunut *}
  <p>Sinun täytyy olla kirjautunut sisään nähdäksesi ilmoittautuneet pelaajat</p>
{elseif $ccuser->memberof('pending')}
  {* Ei vahvistettu tunnusta *}
  <p>Tunnustasi ei ole vielä vahvistettu, joten et ikävä kyllä voi katsella ilmoittautuneita pelaajia.</p>
{else}
<p style="margin-bottom: 1em; text-align: center;"><strong>{$event->info.event_title}</strong><br />
{$event->info.event_date_start|date_format:"%A, %d.%m. klo %H:%M"}<br />{$event->info.fields.Paikka}</p>
<table>

  <thead>
    <tr>
      <th>Nimi</th>
      <th>IN</th>
      <th>OUT</th>
      <th>Lisätietoa</th>
      <th style="width: 1px;">&nbsp;</th>
    </tr>
  </thead>

  <tbody>
{foreach from=$users item=user}
  {if $ccuser->loggedin() == $user->id || $ccuser->memberof('admin')}
    {assign var=allow_edit value=1}
  {else}
    {assign var=allow_edit value=0}
  {/if}
    <tr>
      <input type="hidden" name="user_id" value="{$user->id}" />
      <td id="username_{$user->id}">{$user->username}</td>
      <td class="feusu_in"><input type="radio" value="in" name="radio_{$user->id}"{if $user->exists && $user->signed_up}checked="checked" {/if}{if !$allow_edit} disabled="disabled"{/if} /></td>
      <td class="feusu_out"><input type="radio" value="out" name="radio_{$user->id}"{if $user->exists && !$user->signed_up}checked="checked" {/if}{if !$allow_edit} disabled="disabled"{/if} /></td>
      <td>
      {if $allow_edit}
        <input type="text" name="desc_{$user->id}" id="desc_{$user->id}" value="{if $user->exists}{$user->description}{/if}" />
      {else}
        {if $user->exists}{$user->description}{/if}
      {/if}
      </td>
      <td class="feusu_submit">{if $allow_edit}<a class="jslink" href="{$user->submit_href}" id="user_{$user->id}"><img src="/images/famfamfam_mini/action_forward.gif" alt="-&gt;" title="Tallenna osallistumisesi" /></a>{else}&nbsp;{/if}</td>
    </tr>
{/foreach}
  </tbody>
</table>

{/if}
</div>