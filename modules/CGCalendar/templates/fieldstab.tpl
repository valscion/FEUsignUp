{$formstart}
<h4>{$mod->Lang('info_customfields')}</h4><br/>
<table cellspacing="0">
  <thead>
    <th>{$nametext}</th>
    <th>{$typetext}</th>
    <th>{$mod->Lang('searchable')}</th>
  </thead>
  <tbody>
    {foreach from=$fields item='entry'}
      <tr>
        <td>{$entry->hidden}{$entry->name}</td>
        <td>{$entry->type}</td>
        <td>{if isset($entry->searchable)}{$entry->searchable}{/if}</td>
      </tr>
    {/foreach}
  </tbody>
</table>
<div class="pageoverflow">
  <p class="pagetext">{$submit}</p>
</div>
{$formend}