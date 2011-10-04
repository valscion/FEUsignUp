<fieldset><br>
	<legend>&nbsp;{$memberfiltertitle}&nbsp;</legend>
	{$formstart}
		<div class="pageoverflow">
			<p class="pagetext">{$teamtitle}:</p>
			<p class="pageinput">{$teamidinput}</p>
		</div>
		<div class="pageoverflow">
			<p class="pagetext">&nbsp;</p>
			<p class="pageinput">{$submitmemberfilter}{$hidden}&nbsp;</p>
		</div>
	{$formend}
</fieldset><br>
<div class="pageoptions"><p class="pageoptions">{$addmemberlink}</p></div>
{if $itemcount > 0}
<table cellspacing="0" class="pagetable">
	<thead>
		<tr>
			<th>{$membertext}</th>
			<th>{$teamtext}</th>
			<th>{$typetext}</th>
			<th>{$statustext}</th>
			<th class="pageicon">&nbsp;</th>
			<th class="pageicon">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$items item=entry}
		<tr class="{$entry->rowclass}" onmouseover="this.className='{$entry->rowclass}hover';" onmouseout="this.className='{$entry->rowclass}';">
			<td>{$entry->membername}</td>
			<td>{$entry->team}</td>
			<td>{$entry->type}</td>
			<td>{$entry->statuslink}</td>
			<td>{$entry->editlink}</td>
			<td>{$entry->deletelink}</td>
		</tr>
		{/foreach}
	</tbody>
</table>
{/if}

<div class="pageoptions"><p class="pageoptions">{$addmemberlink}</p></div>
