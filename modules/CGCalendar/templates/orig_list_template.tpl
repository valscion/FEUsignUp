<div class="calendar-list">
{if isset($navigation)}
{if isset($navigation.prev)}<span class="calendar-prev"><a href="{$navigation.prev}">{$lang.prev}</a></span>{/if} &nbsp; &nbsp;{if isset($navigation.next)}<span class="calendar-next"><a href="{$navigation.next}">{$lang.next}</a></span>{/if}
{/if}

<h1>{if $day > 0}{$day} {/if}{$month_names[$month]} {$year}</h1>
{foreach from=$events key=key item=event}
  <div class="calendar-event">
  <h2>{$event.event_title}</h2>

  {assign var=month_number value=$event.event_date_start|date_format:"%m"}
  {assign var=end_month_number value=$event.event_date_end|date_format:"%m"}
  {if $event.event_date_start == $event.event_date_end || $event.event_date_end == 0}
    <div class="calendar-date-from"><span class="calendar-date-title">{$lang.date}: </span>{$event.event_date_start|date_format:"%e"} {$month_names[$month_number]} {$event.event_date_start|date_format:"%Y"}</div>
  {else}
    {if $event.event_date_start|date_format:"%d%m%Y" == $event.event_date_end|date_format:"%d%m%Y"}
      <div class="calendar-date-from"><span class="calendar-date-title">{$lang.date}: </span>{$event.event_date_start|date_format:"%e"} {$month_names[$month_number]} {$event.event_date_start|date_format:"%Y %H:%M"} {$lang.to} {$event.event_date_end|date_format:"%H:%M"}</div>
    {else}
      <div class="calendar-date-from"><span class="calendar-date-title">{$lang.date}: </span>{$event.event_date_start|date_format:"%e"} {$month_names[$month_number]} {$event.event_date_start|date_format:"%Y %H:%M"} {$lang.to} {$event.event_date_end|date_format:"%d"} {$month_names[$end_month_number]} {$event.event_date_end|date_format:"%Y %H:%M"}</div>
    {/if}
  {/if}
  {if $event.event_summary !="" && ($detail != 1 || ($event.event_details =="" ||  $event.event_details == "<br />"))}
    <div class="calendar-summary"><span class="calendar-summary-title">{$lang.summary}: </span>{$event.event_summary}</div>
  {/if}
{* optionally display detail information 
	{if $event.event_details !="" && $event.event_details != "<br />"}
	<div class="calendar-details"><span class="calendar-details-title">{$lang.details}: </span>{$event.event_details}</div>
	{/if}
*}
  <a href="{$event.url}">{$mod->Lang('cal_more')}</a>
  </div>
{/foreach}

{if $return_url != ""}
  <div class="calendar-returnlink">{$return_url}</div>
{/if}
