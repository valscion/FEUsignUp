<div class="calendar-event">
<h1>{$event.event_title}</h1>

{assign var=month_number value=$event.event_date_start|date_format:"%m"}
{assign var=end_month_number value=$event.event_date_end|date_format:"%m"}
{if $event.event_date_start == $event.event_date_end || $event.event_date_end == 0}
  <div class="calendar-date-from"><span class="calendar-date-title">{$lang.date}: </span>{$event.event_date_start|cms_date_format} {$event.event_date_start|date_format:"%X"}</div>
{else}
{if $event.event_date_start|date_format:"%d%m%Y" == $event.event_date_end|date_format:"%d%m%Y"}
  <div class="calendar-date-from"><span class="calendar-date-title">{$lang.date}: </span>{$event.event_date_start|cms_date_format} {$event.event_date_start|date_format:"%X"} {$lang.to} {$event.event_date_end|date_format:"%H:%M"}</div>
{else}
  <div class="calendar-date-from"><span class="calendar-date-title">{$lang.date}: </span>{$event.event_date_start|date_format:"%e"} {$month_names[$month_number]} {$event.event_date_start|date_format:"%Y %H:%M"} {$lang.to} {$event.event_date_end|date_format:"%d"} {$month_names[$end_month_number]} {$event.event_date_end|date_format:"%Y %H:%M"}</div>
{/if}
{/if}
{if $event.event_summary !="" && $event.event_details ==""}
	<div class="calendar-summary"><span class="calendar-summary-title">{$lang.summary}: </span>{$event.event_summary}</div>
{/if}
{if $event.event_details !="" && $event.event_details != "<br />"}
	<div class="calendar-details"><span class="calendar-details-title">{$lang.details}: </span>{eval var=$event.event_details}</div>
{/if}

{* Display custom fields
   There are two ways to address custom fields
   1) {$event.fields.fieldname}
   2) {foreach from=$event.fields key='fieldnamee' item='fieldvalue'}
        {$fieldname}:&nbsp;{$fieldvalue}
      {/foreach}
   You may want to use the former method with file upload fields.
*}
<div class="calendar-fields">
  {foreach from=$event.fields key='fieldname' item='fieldvalue'}
      {$fieldname}:&nbsp;{$fieldvalue}<br/>
  {/foreach}
</div>
<div class="calendar-returnlink">{$return_link}</div>
</div>
