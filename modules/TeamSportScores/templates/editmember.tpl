{$startform}
	<div class="pageoverflow">
		<p class="pagetext">{$usertext}:</p>
		{if $prefusertable != 'MAN_USR'}
			<p class="pageinput">{$inputuser}</p>
		{else}
			<p class="pageinput">{$inputname}</p>
		{/if}
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$teamtext}:</p>
		<p class="pageinput">{$inputteam}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$typetext}:</p>
		<p class="pageinput">{$inputtype}</p>
	</div>
<!-- Evaluation not implemented
	<div class="pageoverflow">
		<p class="pagetext">{$seeevaltext}:</p>
		<p class="pageinput">{$inputseeeval}</p>
	</div>
-->
	<div class="pageoverflow">
		<p class="pagetext">{$notetext}:</p>
		<p class="pageinput">{$inputnote}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$statustext}:</p>
		<p class="pageinput">{$inputstatus}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">{$hidden}{$submit}{$saveandnew}{$cancel}</p>
	</div>
{$endform}
