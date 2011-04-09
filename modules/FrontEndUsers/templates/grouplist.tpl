
{if !isset($itemcount) }
<p>0&nbsp;{$groupsfound}</p>
{else}
<p>{$itemcount}&nbsp;{$groupsfound}</p>
<table cellspacing="0" class="pagetable cms_sortable tablesorter">
	<thead>
		<tr>
			<th width="5%">{$idtext}</th>
			<th>{$nametext}</th>
			<th>{$desctext}</th>
			<th class="pageicon">&nbsp;</th>
			<th class="pageicon">&nbsp;</th>
			<th class="pageicon">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
{foreach from=$items item=entry}
		<tr class="{$entry->rowclass}">
			<td>{$entry->id}</td>
			<td>{$entry->name}</td>
			<td>{$entry->desc}</td>
			<td>{if isset($entry->exportlink)}{$entry->exportlink}{/if}</td>
			<td>{$entry->editlink}</td>
			<td>{if isset($entry->deletelink)}{$entry->deletelink}{/if}</td>
		</tr>
{/foreach}
	</tbody>
</table>
{/if}

<p class="pageoverflow">
{if $propcount > 0}{$addlink}&nbsp;{/if}
{if isset($exportlink)}{$exportlink}&nbsp;{/if}
{$importlink}
</p>
