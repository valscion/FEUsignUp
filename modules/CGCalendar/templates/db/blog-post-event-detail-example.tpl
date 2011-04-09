<div class="calendar-event" id="{$table_id}">
<h2>{$event.event_title}</h2>

{assign var=month_number value=$event.event_date_start|date_format:"%m"}
{assign var=end_month_number value=$event.event_date_end|date_format:"%m"}

<div class="calendar-date-from"><span class="calendar-date-title">{$lang.date}: </span>{$event.event_date_start|date_format:"%e"} {$month_names[$month_number]} {$event.event_date_start|date_format:"%Y %H:%M"} 
{eval var=$event.event_details}
<p>Author: {$event.authorname}</p>
{cms_module module='comments' modulename='Calendar' pageid=$event.event_id}

<div class="calendar-returnlink">{$return_url}</div>
</div>
