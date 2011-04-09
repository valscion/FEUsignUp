{* original search result template *}

<h3>{$mod->Lang('search_results')}</h3>
<p>{$mod->Lang('search_words')}:&nbsp;{$search_text}</p>
<p>{$mod->Lang('start_date')}:&nbsp;{$search_start_date|cms_date_format}</p>
<p>{$mod->Lang('end_date')}:&nbsp;{$search_end_date|cms_date_format}</p>
<p>{$mod->Lang('category')}:&nbsp;{if $search_category == '-1'}{$mod->Lang('cal_any_category')}{else}{$mod->GetCategoryName($search_category)}{/if}</p>
{if !isset($events)}
  {$mod->Lang('no_results_found')}
{else}
<br/>

{* pagination stuff *}
{if isset($firstpage_url) || isset($lastpage_url)}
<div style="text-align: center;">
  {if isset($firstpage_url)}
    <a href="{$firstpage_url}">{$mod->Lang('first_page')}</a>&nbsp;
    <a href="{$prevpage_url}">{$mod->Lang('prev_page')}</a>&nbsp;
  {/if}
  {$mod->Lang('page_of',$pagenum,$numpages)}
  {if isset($lastpage_url)}
    &nbsp;<a href="{$nextpage_url}">{$mod->Lang('next_page')}</a>
    &nbsp;<a href="{$lastpage_url}">{$mod->Lang('last_page')}</a>
  {/if}
</div>
{/if}

{* display the output *}
{foreach from=$events key=key item=event}
	<div class="calendar-event">
	<h4>{$event.event_title}</h4>

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
{/if}