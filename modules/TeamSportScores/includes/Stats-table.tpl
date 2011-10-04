{$startform}
	<table cellspacing="5" class="pagetable">
		<thead>
			<tr>
				<th>{$titlehometeam}</th>
				<th>{$titlevisitorteam}</th>
				<th>{$titlescore}</th>
				<th>{$titlelocation}</th>
		</thead>
			<tr>
				<td>{$hometeamname}</td>
				<td>{$visitorteamname}</td>
				<td>{$match_score}</td>
				<td>{$location}</td>
	</table>
	<br>
	<table cellspacing="1" class="pagetable">
		<thead>
			<tr>
				<th>{$stattimetext}</th>
				<th>{$playertext}</th>
				<th>{$player_goaltext}</th>
				<th>{$penaltycard}</th>
				<th>|</th>
				<th>{$playertext}</th>
				<th>{$player_goaltext}</th>
				<th>{$penaltycard}</th>
			</tr>
		</thead>
	{if $statedit != '0' }
		<tbody>
		{foreach from=$items item=entry}
			<tr class="{$entry->rowclass}" onmouseover="this.className='{$entry->rowclass}hover';" onmouseout="this.className='{$entry->rowclass}';">
				<td>{$entry->stattime}</td>
				<td>{$entry->hplayer}</td>
				<td>{$entry->hplayer_goal}</td>
				<td>{$entry->hplayer_pc}</td>
				<td>|</td>
				<td>{$entry->vplayer}</td>
				<td>{$entry->vplayer_goal}</td>
				<td>{$entry->vplayer_pc}</td>
			</tr>
		{/foreach}
		</tbody>
	{else}
		<tr class="{cycle values="row1,row2"}">
			<td colspan='8' align='center'>{$nostatsavailable}</td>
		</tr>
	{/if}
	</table>
{$endform}