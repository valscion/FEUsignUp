{* myevents template *}
<div id="cgcal_myevents_list">
{if isset($records)}
<table>
  <thead>
   <tr>
    <th>{$mod->Lang('cal_id')}</th>
    <th>{$mod->Lang('cal_title')}</th>
    <th>{$mod->Lang('start_date')}</th>
    <th>{$mod->Lang('end_date')}</th>
    <th class="pageicon"></th>
    <th class="pageicon"></th>
   </tr>
  </thead>
  <tbody>
  {foreach from=$records item='event'}
    <tr>
      <td>{$event.event_id}</td>
      <td>{$event.event_title|summarize:80}</td>
      <td>{$event.event_date_start|cms_date_format}</td>
      <td>{$event.event_date_end|cms_date_format}</td>
      <td><a href="{$event.edit_url}">{$mod->Lang('cal_edit')}</td>
      <td><a href="{$event.delete_url}" onclick="return confirm('{$mod->Lang('cal_areyousure')}');">{$mod->Lang('cal_delete')}</td>
    </tr>
  {/foreach}
  </tbody>
</table>
{/if}
{if isset($add_event_url)}
<a class="link" href="{$add_event_url}">Add New Event</a>
<br/>
{/if}
</div>
