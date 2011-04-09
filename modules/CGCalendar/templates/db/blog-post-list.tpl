<div class="calendar-list" id="{$table_id}">
{if $compact_view neq 1}
<span class="calendar-prev"><a href="{$navigation.prev}">{$lang.prev}</a></span> &nbsp; &nbsp; <span class="calendar-next"><a href="{$navigation.next}">{$lang.next}</a></span>

<h1>{if $day > 0}{$day} {/if}{$month_names[$month]} {$year}</h1>
{/if}
{foreach from=$events key=key item=event}
	<div class="calendar-event">
	<h2>{$event.event_title}</h2>

	{assign var=month_number value=$event.event_date_start|date_format:"%m"}
	{assign var=end_month_number value=$event.event_date_end|date_format:"%m"}

	<div class="calendar-date-from"><span class="calendar-date-title">{$lang.date}: </span>{$event.event_date_start|date_format:"%e"} {$month_names[$month_number]} {$event.event_date_start|date_format:"%Y %H:%M"}



	{if $event.event_summary !="" && ($detail != 1 || ($event.event_details =="" ||  $event.event_details == "<br />"))}
		<div class="calendar-summary"><span class="calendar-summary-title">{$lang.summary}: </span>{$event.event_summary}</div>
	{/if}
	{if $detail == 1}
		{if $event.event_details !="" && $event.event_details != "<br />"}
		<div class="calendar-details"><span class="calendar-details-title">{$lang.details}: </span>{$event.event_details}</div>
		{/if}
	{else}
		<a href="{$event.url}">{$moretext}</a>
	{/if}

	</div>
{/foreach}

{if $return_url != ""}
<div class="calendar-returnlink">{$return_url}</div>
{/if}
</div>

 
