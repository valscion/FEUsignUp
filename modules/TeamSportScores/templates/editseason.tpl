{$startform}
	<div class="pageoverflow">
		<p class="pagetext">*{$seasontext}:</p>
		<p class="pageinput">{$inputname}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$startdatetext}:</p>
		<p class="pageinput">{html_select_date prefix=$start_dateprefix time=$start_date start_year='-2' end_year='+9'}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$enddatetext}:</p>
		<p class="pageinput">{html_select_date prefix=$end_dateprefix time=$end_date start_year='-2' end_year='+10'}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$statustext}:</p>
		<p class="pageinput">{$inputstatus}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">{$hidden}{$submit}{$cancel}</p>
	</div>
{$endform}
