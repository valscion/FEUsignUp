{if $itemcount > 0}
<table cellspacing="0" class="pagetable">
	<thead>
		<tr>
			<th>{$associationtext}</th>
			<th>{$titlemaxperiods}</th>
			<th>{$titleperiodheading}</th>
			<th>{$titlepcblack}</th>
			<th>{$titlepcblue}</th>
			<th>{$titlepcgreen}</th>
			<th>{$titlepcred}</th>
			<th>{$titlepcwhite}</th>
			<th>{$titlepcyellow}</th>
			<th class="pageicon">&nbsp;</th>
			<th class="pageicon">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
	{foreach from=$items item=entry}
		<tr class="{$entry->rowclass}" onmouseover="this.className='{$entry->rowclass}hover';" onmouseout="this.className='{$entry->rowclass}';">
			<td>{$entry->description}</td>
			<td>{$entry->maxperiods}</td>
			<td>{$entry->periodheading}</td>
			<td>{$entry->pcblack}</td>
			<td>{$entry->pcblue}</td>
			<td>{$entry->pcgreen}</td>
			<td>{$entry->pcred}</td>
			<td>{$entry->pcwhite}</td>
			<td>{$entry->pcyellow}</td>
			<td>{$entry->editlink}</td>
			<td>{$entry->deletelink}</td>
		</tr>
	{/foreach}
	</tbody>
</table>
{/if}

<div class="pageoptions"><p class="pageoptions">{$addassociationlink}</p></div>
