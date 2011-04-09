{if isset($error)}<strong><font color="red">{$error}</font></strong>{/if}
{if isset($message)}<strong><font color="blue">{$message}</font></strong>{/if}
{$startform}
{if $itemcount > 0}
<table cellspacing="1" class="pagetable">
       {if $heading > 0}
             <thead>
		<tr>
			<th>{$titleteam}</th>
			<th>{$titlename}</th>
			<th>{$titletype}</th>
		</tr>
	</thead>
        {/if}
	<tbody>
	{foreach from=$items item=entry}
		<tr class="{$entry->rowclass}" onmouseover="this.className='{$entry->rowclass}hover';" onmouseout="this.className='{$entry->rowclass}';">
			<td>{$entry->team}&nbsp;</td>
			<td>{$entry->name}&nbsp;</td>
			<td>{$entry->type}&nbsp;</td>
		</tr>
	{/foreach}
	</tbody>
</table>
{/if}
{$endform}{$endform}