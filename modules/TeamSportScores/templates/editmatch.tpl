{$startform}
	<div class="pageoverflow">
		<p class="pagetext">*{$hometeamtitle}:</p>
		<p class="pageinput">{$hometeamidinput}</p>
		<p class="pagetext">{$ortitle}</p>
		<p class="pageinput">{$hometeaminput}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">*{$visitorteamtitle}:</p>
		<p class="pageinput">{$visitorteamidinput}</p>
		<p class="pagetext">{$ortitle}</p>
		<p class="pageinput">{$visitorteaminput}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$locationtitle}:</p>
		<p class="pageinput">{$locationinput}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$matchdatetitle}:</p>
		<p class="pageinput">{html_select_date prefix=$match_dateprefix time=$match_date start_year='-2' end_year='+9'} 
			{html_select_time use_24_hours=$use_24hours display_seconds=$display_seconds prefix=$match_dateprefix time=$match_date}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$leaguetitle}:</p>
		<p class="pageinput">{$leagueinput}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$hometeamscoretitle}:</p>
		<p class="pageinput">{$hometeamscoreinput}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$visitorteamscoretitle}:</p>
		<p class="pageinput">{$visitorteamscoreinput}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$matchreporttitle}:</p>
		<p class="pageinput">{$matchreportinput}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">{$hidden}{$submit}{$cancel}{$addmatchstatslink}</p>
	</div>
{$endform}
