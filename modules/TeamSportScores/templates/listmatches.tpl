{if $message!=''}<p>{$message}</p>{/if}
<fieldset><br>
	<legend>&nbsp;{$matchfiltertitle}&nbsp;</legend>
	{$formstart}
		<div class="pageoverflow">
			<p class="pagetext">{$titlehometeam}:</p>
			<p class="pageinput">{$hometeamidinput}&nbsp;</p>
			<p class="pageinput">{$titlevisitorteam}:&nbsp;</p>
			<p class="pageinput">{$visitorteamidinput}&nbsp;</p>
			<p class="pageinput">{$titleleaguename}:&nbsp;</p>
			<p class="pageinput">{$leaguenameinput}</p>
		</div>
		<div class="pageoverflow">
			<p class="pagetext">{$futurematchonlytitle}:</p>
			<p class="pageinput">{$futurematchonlyinput}</p>
		</div>
		<div class="pageoverflow">
			<p class="pagetext">{$datefromtitle}:</p>
			<p class="pageinput">{html_select_date prefix=$datefromprefix time=$datefrom start_year='-2' end_year='+9'}&nbsp;</p>
			<p class="pageinput">{$datetotitle}:&nbsp;</p>
			<p class="pageinput">{html_select_date prefix=$datetoprefix time=$dateto start_year='-2' end_year='+10'}</p>
		</div>
		<div class="pageoverflow">
			<p class="pagetext">{$sortmatchbytitle}:</p>
			<p class="pageinput">{$sortmatchbyinput}&nbsp;</p>
			<p class="pageinput">{$matchsequenceinput}</p>
		</div>
		<div class="pageoverflow">
			<p class="pagetext">&nbsp;</p>
			<p class="pageinput">{$submitfilter}{$hidden}&nbsp;</p>
			<p class="pageinput">{$submitreset}{$hidden}</p>
		</div>
	{$formend}
</fieldset><br>
{if $itemcount > 0}
<table cellspacing="0" class="pagetable">
	<thead>
		<tr>
			<th>{$titlehometeam}</th>
			<th>{$titlevisitorteam}</th>
			<th>{$titlematchdate}</th>
			<th>{$titlescore}</th>
			<th>{$titleleaguename}</th>
			<th class="pageicon">&nbsp;</th>
			<th class="pageicon">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$items item=entry}
			<tr class="{$entry->rowclass}" onmouseover="this.className='{$entry->rowclass}hover';" onmouseout="this.className='{$entry->rowclass}';">
				<td>{$entry->hometeam}</td>
				<td>{$entry->visitorteam}</td>
				<td>{$entry->matchdate}</td>
				<td>{$entry->match_score}</td>
				<td>{$entry->league_name}</td>
				<td>{$entry->editlink}</td>
				<td>{$entry->deletelink}</td>
			</tr>
		{/foreach}
	</tbody>
</table>
{/if}

<div class="pageoptions"><p class="pageoptions">{$addmatchlink}</p></div>
