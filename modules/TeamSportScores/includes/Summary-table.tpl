{* Basic list of matches *}
{if isset($error)}<strong><font color="red">{$error}</font></strong>{/if}
{if isset($message)}<strong><font color="blue">{$message}</font></strong>{/if}
{$startform}
{if $itemcount > 0}
<table cellspacing="1" class="pagetable">
       {if $heading > 0}	
             <thead>
		<tr>
			<th>{$titlehometeam}</th>
			<th>{$titlevisitorteam}</th>
			{if $showlocation == "1"}
			  <th>{$titlelocation}</th>
			{/if}
			<th>{$titlematchdate}</th>
			{if $showtime}<th>{$titlematchtime}</th>{/if}
			<th>{$titlescore}</th>
		</tr>
	</thead>
        {/if}
	<tbody>
	{foreach from=$items item=entry}
		<tr class="{$entry->rowclass}" onmouseover="this.className='{$entry->rowclass}hover';" onmouseout="this.className='{$entry->rowclass}';">
			<td>{$entry->hometeam}&nbsp;</td>
			<td>{$entry->visitorteam}&nbsp;</td>
			{if $showlocation == "1"}
			  <td>{$entry->location}&nbsp;</td>
			{/if}
			<td>{$entry->match_date}&nbsp;</td>
			{if $showtime}<td>{$entry->match_time}&nbsp;</td>{/if}
			<td>{$entry->match_score}</td>
		</tr>
	{/foreach}
	</tbody>
</table>
{/if}
{$endform}{$endform}