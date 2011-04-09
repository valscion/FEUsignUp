{* edit event template *}
{literal}
<script type="text/javascript">
function toggleDisplay(elem)
{
  var el = document.getElementById(elem);
  var txt = el.style.display;
  if( txt == 'none' )
    {
      txt = 'block';
    }
  else
    {
      txt = 'none';
    }
  el.style.display = txt;
}
</script>
{/literal}

{if isset($message)}
 {if isset($status)}
   <div class="error">{$message}</div>
 {else}
   <div class="message">{$message}</div>
 {/if}
{/if}

<div id="cgcalendar_addedit_event">
{if $event.event_id > 0 }
 <h4>{$mod->Lang('cal_edit_event',$event.event_id)}</h4>
{else}
 <h4>{$mod->Lang('cal_add_event')}</h4>
{/if}

{capture assign='use24'}{$mod->GetPreference('use_twelve_hour_clock')}{/capture}
{if $use24 == 1}{assign var='use24' value=0}
{else}{assign var='use24' value=1}{/if}
{$formstart}

<div class="row">
  <p class="row_prompt">{$mod->Lang('cal_fromdate')}:</p>
  <p class="row_input">
    {capture assign='tmp'}{$actionid}cal_startdate_{/capture}
    {html_select_date prefix=$tmp time=$event.event_date_start_ut start_year=$start_year end_year=$end_year}
    &nbsp;All Day: <input type="checkbox" name="{$actionid}cal_all_day_event" id="all_day_event" value="1"{if $event.all_day_event == 1} checked="checked"{/if} onclick="toggleDisplay('starttime'); toggleDisplay('endtime');"/>
    <span id="starttime"{if $event.all_day_event == 1} style="display: none;"{/if}> at {html_select_time use_24_hours=$use24 prefix=$tmp time=$event.event_date_start_ut minute_interval=15 display_seconds=false}</span>
  </p>
</div>

<div class="row">
  <p class="row_prompt">{$mod->Lang('cal_todate')}:</p>
  <p class="row_input">
    <input type="checkbox" name="{$actionid}cal_enddate_valid" value="1" {if $event.alt_end_date == 1}checked="checked"{/if} onclick="toggleDisplay('enddate');">{$mod->Lang('use_to_date')}<br/>
    {capture assign='tmp'}{$actionid}cal_enddate_{/capture}
    <span id="enddate" {if empty($event.event_date_end) || $event.event_date_end == '' || $event.alt_end_date == 0}style="display: none;"{/if}>    
    {html_select_date prefix=$tmp  time=$event.event_date_end_ut start_year=$start_year end_year=$end_year}
    <span id="endtime"{if $event.all_day_event == 1} style="display: none;"{/if}> at {html_select_time use_24_hours=$use24 time=$event.event_date_end_ut prefix=$tmp minute_interval=15 display_seconds=false}</span>
    </span>
  </p>
</div>

<div class="row">
  <p class="row_prompt">{$mod->Lang('cal_title')}:</p>
  <p class="row_input">
    <input type="text" name="{$actionid}cal_event_title" value="{$event.event_title}" size="80" maxlength="255"/>
  </p>
</div>

<div class="row">
  <p class="row_prompt">{$mod->Lang('cal_summary')}:</p>
  <p class="row_input">
    <input type="text" name="{$actionid}cal_event_summary" value="{$event.event_summary}" size="80" maxlength="255"/>
  </p>
</div>

<div class="row">
  <p class="row_prompt">{$mod->Lang('cal_details')}:</p>
  <p class="row_input">
    <textarea name="{$actionid}cal_event_details" rows="8">{$event.event_details}</textarea>
  </p>
</div>

{if isset($fields)}
{foreach from=$fields item='field'}
<div class="row">
  <p class="row_prompt">{$field->name}:</p>
  <p class="row_input">
    {if isset($field->value)}{$field->value}&nbsp;{/if}
    {$field->field}
  </p>
</div>
{/foreach}
{/if}

{if isset($categories)}
{foreach from=$categories item='category'}
<div class="row">
  <p class="row_prompt">{$category->name}:</p>
  <p class="row_input">
    {$category->field}
  </p>
</div>
{/foreach}
{/if}

<div class="row">
  <p class="row_prompt"></p>
  <p class="row_input">
    <input type="submit" name="{$actionid}cal_submit" value="{$mod->Lang('submit')}"/>
    <input type="submit" name="{$actionid}cal_cancel" value="{$mod->Lang('cancel')}"/>
  </p>
</div>

{$formend}
</div>{* cgcalendar_addedit_event *}