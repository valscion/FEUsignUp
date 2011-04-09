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

function handleDropdown()
{
  var labels = new Array();
  labels["daily"] = "{/literal}{$mod->Lang('plural_daily')}{literal}";
  labels["weekly"] = "{/literal}{$mod->Lang('plural_weekly')}{literal}";
  labels["monthly"] = "{/literal}{$mod->Lang('plural_monthly')}{literal}";
  labels["yearly"] = "{/literal}{$mod->Lang('plural_yearly')}{literal}";

  var el  = document.getElementById('recurdetails');
  var el2 = document.getElementById('recurperiod');
  var weekly = document.getElementById('recur_weekly');
  var el4 = document.getElementById('intervallabel');
  var monthly = document.getElementById('recur_monthly');
  var idx = el2.selectedIndex;
  var val = el2[idx].value;
  var txt = 'inline';
  var txt_weekly = 'none';
  var txt_monthly = 'none';

  if( val == 'none' )
  {
    txt = 'none';
    txt_weekly = 'none';
    txt_monthly = 'none';
  }

  else if( val == 'weekly' )
  {
    txt = 'inline';
    txt_weekly = 'block';
    txt_monthly = 'none';
  }

  else if( val == 'monthly' )
  {
    txt = 'inline';
    txt_weekly = 'none';
    txt_monthly = 'block';
  }

  el.style.display = txt;
  weekly.style.display = txt_weekly;
  monthly.style.display = txt_monthly;

  el4.innerHTML = labels[val];
}
</script>
{/literal}

<h4>{$mod->Lang('cal_event')}</h4>
{$formstart}
{if isset($event.owner_name)}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('owner')}:</p>
  <p class="pageinput">{$event.owner_name}</p>
</div>
{/if}

{if $event.event_id > 0 && $event.event_recur_period != 'none' && $event.event_parent_id == -1}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('update_children')}:</p>
  <p class="pageinput">
    {capture assign='tmp'}{$actionid}update_children{/capture}
    <input type="checkbox" name="{$tmp}" value="1" onclick="toggleDisplay('recur_all');" />
  </p>
</div>
{/if}

{capture assign='use24'}{$mod->GetPreference('use_twelve_hour_clock')}{/capture}
{if $use24 == 1}{assign var='use24' value=0}
{else}{assign var='use24' value=1}{/if}

<div>{$hidden}</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('cal_fromdate')}:</p>
  <p class="pageinput">
    {capture assign='tmp'}{$actionid}startdate_{/capture}
    {html_select_date prefix=$tmp time=$event.event_date_start_ut start_year=$start_year end_year=$end_year}
    &nbsp;All Day: <input type="checkbox" name="{$actionid}all_day_event" id="all_day_event" value="1" {if $event.all_day_event} checked="checked"{/if} onclick="toggleDisplay('starttime'); toggleDisplay('endtime');"/><br/>
    <span id="starttime"{if $event.all_day_event == -1} style="display: none;"{/if}> @ {html_select_time use_24_hours=$use24 prefix=$tmp time=$event.event_date_start_ut minute_interval=15 display_seconds=false}</span>
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('cal_todate')}:</p>
  <p class="pageinput">
    <input type="checkbox" name="{$actionid}enddate_valid" value="1" {if !empty($event.event_date_end) && $event.event_date_end != ''}checked="checked"{/if} onclick="toggleDisplay('enddate');"/>{$mod->Lang('use_to_date')}<br/>
    {capture assign='tmp'}{$actionid}enddate_{/capture}
    <span id="enddate" {if empty($event.event_date_end) || $event.event_date_end == ''}style="display: none;"{/if}>
    {html_select_date prefix=$tmp  time=$event.event_date_end_ut start_year=$start_year end_year=$end_year}<span id="endtime"{if $event.all_day_event == -1} style="display: none;"{/if}><br/>@ {html_select_time use_24_hours=$use24 time=$event.event_date_end_ut prefix=$tmp minute_interval=15 display_seconds=false}</span>
    </span>
  </p>
</div>

{if isset($allow_overlap)}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('cal_overlap')}:</p>
  <p class="pageinput">
    <input type="hidden" name="{$actionid}event_allows_overlap" value="0"/>
    <input type="checkbox" name="{$actionid}event_allows_overlap" value="1" checked="checked"/> 
    <br/>
    {$mod->Lang('cal_info_overlap')}
  </p>
</div>
{/if}

<div id="recur_all" {if $event.event_recur_period != 'none' && $event.event_id > 0}style="display: none;"{/if}>
{if $event.event_parent_id <= 0}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('cal_recur_period')}:</p>
  {capture assign='tmp'}{$actionid}event_recur_period{/capture}
  <p class="pageinput">
    <select id="recurperiod" name="{$actionid}event_recur_period" onclick="handleDropdown();">
    {foreach from=$recur_options key=key item=value}
      <option value="{$value}" {if $value == $event_recur_period}selected="selected"{/if}>{$key}</option>   
    {/foreach}
    </select>
  </p>
</div>

<div id="recurdetails" {if $event.event_recur_period == 'none'}style="display: none;"{/if}>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('cal_recur_details')}:</p>  
  <p class="pageinput">
  {capture assign='tmp'}{$actionid}event_recur_interval{/capture}
  {$mod->Lang('interval')}:&nbsp;{html_options name=$tmp selected=$event.event_recur_interval options=$nums}&nbsp;<span id="intervallabel">{$repeat_str}</span><br/>
  </p>
</div>
<div class="pageoverflow" id="recur_weekly" {if $event.event_recur_period != 'weekly'}style="display: none;{/if}">  
  <p class="pagetext">{$mod->Lang('weekdays')}:</p>
  <p class="pageinput">{$input_weekdays}</p>
</div>
<div class="pageoverflow" id="recur_monthly" {if $event.event_recur_period != 'monthly'}style="display: none;{/if}">  
  <p class="pagetext">{$mod->Lang('frequency')}:</p>
  <p class="pageinput">
   <select name="{$actionid}event_recur_monthdays[]" multiple="multiple" size="5">
     {html_options options=$recur_days selected=$event.event_recur_monthdays}
   </select>  
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('cal_recur_until')}:</p>
  {capture assign='tmp'}{$actionid}event_recur_date_{/capture}
  {capture assign='tmp2'}{$actionid}event_recur_count{/capture}
  <p class="pageinput">{html_select_date time=$event.event_date_recur_end_ut prefix=$tmp start_year=$start_year end_year=+20}
  <br/>{$mod->Lang('max_recur_events')}:&nbsp;{html_options name=$tmp2 options=$maxiters selected=$event.event_recur_count}</p>
</div>
</div>{* recurdetails *}
{/if}
</div>{* recur_all *}

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('cal_title')}:</p>
  <p class="pageinput">{$event_title}</p>
</div>

{if isset($event_summary)}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('cal_summary')}:</p>
  <p class="pageinput">{$event_summary}</p>
</div>
{/if}

{if isset($event_details)}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('cal_details')}:</p>
  <p class="pageinput">{$event_details}</p>
</div>
{/if}

{if isset($fields)}
{foreach from=$fields item='one'}
<div class="pageoverflow">
  <p class="pagetext">{$one->name}</p>
  <p class="pageinput">{if isset($one->value)}{$one->value}&nbsp;{/if}{$one->field}</p>
</div>
{/foreach}
{/if}

{if isset($categories)}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('cal_categories')}:</p>
  <p class="pageinput">
  {foreach from=$categories item='one'}
    {$one->field}&nbsp;{$one->name}<br/>
  {/foreach}
  </p>
</div>
{/if}

<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">{$submit}{$cancel}</p>
</div>

{$formend}