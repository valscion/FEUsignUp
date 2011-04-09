{if $itemcount > 0}
<table cellspacing="0" class="pagetable">
	<thead>
		<tr>
			<th>{$titletext}</th>
			<th>{$typetext}</th>
			<th class="pageicon">&nbsp;</th>
			<th class="pageicon">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
{foreach from=$items item=entry}
		<tr class="{$entry->rowclass}" onmouseover="this.className='{$entry->rowclass}hover';" onmouseout="this.className='{$entry->rowclass}';">
			<td>{$entry->title}</td>
			<td>{$entry->typename}</td>
			<td>{$entry->editlink}</td>
			<td>{$entry->deletelink}</td>
		</tr>
{/foreach}
	</tbody>
</table>
{/if}

<div class="pageoptions"><p class="pageoptions">{$addtemplatelink}&nbsp;{$reimporttemplatelink}</p></div>
