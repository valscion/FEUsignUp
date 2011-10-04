<h3>{$title_section}</h3>
{if $message!=''}<p>{$message}</p>{/if}
{$startform}
	<div class="pageoverflow">
		<p class="pagetext">{$title_summary_template}:</p>
		<p class="pageinput">{$input_summary_template}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">{$submittemplates}</p>
	</div>
{$endform}
