{$tab_info}

{$formstart}
<div class="pageoverflow">
  <fieldset>
    <legend>{$filter_and_sort}:&nbsp;</legend>
    <div class="pageoverflow">
      <p class="pagetext">{$filter_by_from}:</p>
      <p class="pageinput">{$input_from}</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext">{$filter_by_event_id}:</p>
      <p class="pageinput">{$input_event_id}</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext">{$filter_by_in_or_out}:</p>
      <p class="pageinput">{$input_in_or_out}</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext">{$sort_by}:</p>
      <p class="pageinput">{$input_sort_by}&nbsp;{$input_sort_order}</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext">&nbsp;</p>
      <p class="pageinput">{$input_submit_filter_and_sort}&nbsp;{$reset_sorting}</p>
    </div>
  </fieldset>
</div>
<br/>
{$formend}

{if $signup_count > 0}
{if isset($pages)}
  <p>{$select_page}:
  {foreach from=$pages item=page}
    {$page}
  {/foreach}
  </p>
{/if}
<table cellspacing="0" class="pagetable">
    <thead>
        <tr>
            <th>{$th_id}</th>
            <th>{$th_feu}</th>
            <th>{$th_event}</th>
            <th>{$th_date}</th>
            <th>{$th_signed_up}</th>
            <th>{$th_desc}</th>
            <th class="pageicon">&nbsp;</th>
        </tr>
    </thead>
    <tbody>

{foreach from=$signups item=signup}
    <tr>
        <td>{$signup->id}</td>
        <td>{$signup->feu}</td>
        <td>{$signup->event_info}</td>
        <td>{$signup->event_date}</td>
        <td>{$signup->signed_up}</td>
        <td>{$signup->description}</td>
        <td>{if isset($signup->deletelink)}{$signup->deletelink}{else}&nbsp;{/if}</td>
    </tr>
{/foreach}
    </tbody>
</table>
{else}
<p><strong>{$no_signups}</strong></p>
{/if}