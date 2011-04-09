<div class="calendar-list" id="{$table_id}">
{if $compact_view neq 1}
<span class="calendar-prev"><a href="{$navigation.prev}">{$lang.prev}</a></span> &nbsp; &nbsp; <span class="calendar-next"><a href="{$navigation.next}">{$lang.next}</a></span>

<h1>{if $day > 0}{$day} {/if}{$month_names[$month]} {$year}</h1>
{/if}
{foreach from=$events key=key item=event}
	<div class="calendar-event">
	<h2><a href="{$event.url}">{$event.event_title}</a></h2>

	{assign var=month_number value=$event.event_date_start|date_format:"%m"}
	{assign var=end_month_number value=$event.event_date_end|date_format:"%m"}

	<div class="calendar-date-from"><span class="calendar-date-title">{$lang.date}: </span>{$event.event_date_start|date_format:"%e"} {$month_names[$month_number]} {$event.event_date_start|date_format:"%Y %H:%M"}


	{eval var=$event.event_details}
	<p>Author: {$event.authorname}</p>
		<a href="{$event.url}">{cms_module module="Comments" action="count_comments" modulename='Calendar' pageid=$event.event_id} comments</a>

	</div>
{/foreach}

{if $return_url != ""}
<div class="calendar-returnlink">{$return_url}</div>
{/if}
</div>
