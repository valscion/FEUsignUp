{strip}
<table class="calendar" id="cal-calendar">
<caption class="calendar-month"><span class="calendar-prev"><a href="{$navigation.prev}">&laquo;</a></span>&nbsp;{$month_names[$month]}&nbsp;{$year}&nbsp;<span class="calendar-next"><a href="{$navigation.next}">&raquo;</a></span></caption>
<tbody><tr>
{foreach from=$day_names item=day key=key}
<th abbr="{$day}">{$day_short_names[$key]}</th>
{/foreach}</tr>

<tr>
{* initial empty days *}
{if $first_of_month_weekday_number > 0}
<td colspan="{$first_of_month_weekday_number}">&nbsp;</td>
{/if}

{* iterate over the days of this month *}
{assign var=weekday value=$first_of_month_weekday_number}
{foreach from=$days item=day key=key}
{if $weekday == 7}
	{assign var=weekday value=0}
</tr>
<tr>
{/if}
<td {if isset($day.class)}class="{$day.class}"{/if}>
{if isset($day.events.0)}<a href="{$day.url}">{$key}</a>
<ul>
{foreach from=$day.events item=event}
<li><a href="{$event.url}">{$event.event_title}</a></li>
{/foreach}
</ul>
{else}{$key}{/if}
</td>
{math assign=weekday equation="x + 1" x=$weekday}
{/foreach}

{* remaining empty days *}
{if $weekday != 7}
<td colspan="{math equation="7-x" x=$weekday}">&nbsp;</td>
{/if}


</tr>
</tbody></table>

{/strip}