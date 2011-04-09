{literal}
<script type="text/javascript">
function selectall() {
	checkboxes = document.getElementsByTagName("input");
	for (i=0; i<checkboxes.length ; i++) {
	  if (checkboxes[i].type == "checkbox") checkboxes[i].checked=!checkboxes[i].checked;
	}
}
</script>
{/literal}

{$formstart}
<div class="pageoverflow">
  <fieldset>
    <legend>{$mod->Lang('filter')}:&nbsp;</legend>
    <div class="pageoverflow">
      <p class="pagetext">{$mod->Lang('cal_filter_by')}:</p>
      <p class="pageinput">{$input_keyword}</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext">{$mod->Lang('cal_show_only_events_in')}:</p>
      <p class="pageinput">{$input_categories}</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext">{$mod->Lang('show_child_events')}:</p>
      <p class="pageinput">{$show_children}</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext">&nbsp;</p>
      <p class="pageinput">{$input_submit}&nbsp;<input type="submit" name="{$actionid}filter_conflicting" value="{$mod->Lang('filter_conflicting')}" onclick="return confirm('{$mod->Lang('areyousure_removeconflicting')}')"/></p>
    </div>
  </fieldset>
</div>
<br/>
{$formend}

{$formstart2}
{if isset($events) && count($events) > 10}
<div class="pageoverflow">
 <div style="float: left; width: 49%";>{$addlink}&nbsp;&nbsp;{$import_link}</div>
 <div style="float: right: width: 49%; text-align: right;">{$delete_selected}</div>
</div>
{/if}

{if isset($events) && count($events)}
<table class="pagetable" cellspacing="0">
  <thead>
    <tr>
      <th>{$mod->Lang('cal_id')}</th>
      <th>{$mod->Lang('cal_title')}</th>
      <th>{$mod->Lang('start_date')}</th>
      <th>{$mod->Lang('end_date')}</th>
      <th>{$mod->Lang('recurs')}</th>
      <th>{$mod->Lang('recurs_until')}</th>
      <th>{$mod->Lang('parent')}</th>
      <th class="pageicon"></th>{* edit *}
      <th class="pageicon"></th>{* delete *}
      <th class="pageicon">{$selectall}</th>
    </tr>
  </thead>
  <tbody>
  {foreach from=$events item='one'}
    {cycle values="row1,row2" assign='rowclass'}
    <tr class="{$rowclass}" onmouseover="this.className='{$rowclass}hover';" onmouseout="this.className='{$rowclass}';">
      <td>{$one.event_id}</td>
      <td>
        {if $one.event_parent_id > 0}&nbsp;&nbsp;&nbsp;{/if}
{*        {if $one.event_parent_id > 0}
          {$one.event_title}
        {else}
*}
          <a href="{$one.edit_url}" title="{$one.event_title|strip_tags}">{$one.event_title|strip_tags}</a>
{*        {/if} *}
      </td>
      <td>{if $one.event_date_end == 0}{$one.event_date_start|date_format:"%x"}{else}{$one.event_date_start|date_format:"%x %X"}{/if}</td>
      <td>{if $one.event_date_end == 0}&nbsp;{else}{$one.event_date_end|date_format:"%x %X"}{/if}</td>
      <td>{if $one.event_recur_period != 'none'}
            {if $one.event_recur_period == 'weekly'}
              {capture assign='tmp2'}<em>{$mod->Lang('on')} ({$mod->ToAbbreviatedWeekdays($one.event_recur_weekdays)})</em>{/capture}
	    {else}
              {assign var='tmp2' value=''}
            {/if}
            {if $one.event_recur_interval > 1}
              {capture assign='tmp'}plural_{$one.event_recur_period}{/capture}
              {$mod->Lang('every')} {$one.event_recur_interval} {$mod->Lang($tmp)} {$tmp2}
            {elseif isset($one.event.recur_period) and {$one.event_recur_period != ''}
              {$mod->Lang($one.event_recur_period)} {$tmp2}
            {/if}
          {/if}
      </td>
      <td>{if $one.event_recur_period != 'none'}{$one.event_date_recur_end|date_format:"%x"}
          {if $one.event_recur_nevents > 0} {$mod->Lang('max')} {$one.event_recur_nevents} {$mod->Lang('times')}{/if}{/if}</td>
      <td>{if $one.event_parent_id <= 0}{$mod->Lang('n/a')}{else}{$one.event_parent_id}{/if}</td>
      <td>{$one.editlink}</td>
      <td>{$one.deletelink}</td>
      <td>{$one.checkbox}</td>
    </tr>
  {/foreach}
  </tbody>
</table>
{/if}

<div class="pageoverflow">
 <div style="float: left; width: 49%";>{$addlink}&nbsp;&nbsp;{$import_link}</div>
 <div style="float: right: width: 49%; text-align: right;">{$delete_selected}</div>
</div>
{$formend2}
