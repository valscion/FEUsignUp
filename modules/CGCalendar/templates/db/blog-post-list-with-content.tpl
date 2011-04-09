<div class="calendar-list" id="{$table_id}">

{foreach from=$events key=key item=event}
	<div class="calendar-event">
	<h2><a href="{$event.url}">{$event.event_title}</a></h2>

	{assign var=month_number value=$event.event_date_start|date_format:"%m"}
	{assign var=end_month_number value=$event.event_date_end|date_format:"%m"}

	<div class="calendar-date-from"><span class="calendar-date-title">{$lang.date}: </span>{$event.event_date_start|date_format:"%e"} {$month_names[$month_number]} {$event.event_date_start|date_format:"%Y %H:%M"}


	{eval var=$event.event_details}

	<div style="border-top:1px solid black; margin-top:1em;">
		<div class="NewsSummaryAuthor" style="float:left;">
		Posted by {$event.authorname}
		</div>

		<div style="text-align:right;"><a href="{$event.url}">{cms_module module="Comments" action="count_comments" modulename='Calendar' pageid=$event.event_id} comments</a></div>
	</div>
	</div>
{/foreach}

{if $return_url != ""}
<div class="calendar-returnlink">{$return_url}</div>
{/if}
</div>