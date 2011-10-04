<h3>{$title_section}</h3>
{if $message!=''}<p>{$message}</p>{/if}
{if $title_pagination_help!=''}<p>{$title_pagination_help}</p>{/if}
{$startform}
{*	<div class="pageoverflow">
		<p class="pagetext">{$title_dateformat}:</p>
		<p class="pageinput">{$input_dateformat}</p>
	</div>
	<br>
*}
	<fieldset>
	<legend>{$title_fieldset_match}</legend>
		<div class="pageoverflow">
		        <p class="pagetext">{$title_default_league_id}:</p>
		        <p class="pageinput">{$input_default_league_id}</p>
		</div>
		<div class="pageoverflow">
		        <p class="pagetext">{$title_24hourclock}:</p>
		        <p class="pageinput">{$input_24hourclock}</p>
		</div>
		<div class="pageoverflow">
		        <p class="pagetext">{$title_show_seconds}:</p>
		        <p class="pageinput">{$input_show_seconds}</p>
		</div>
		<div class="pageoverflow">
		        <p class="pagetext">{$title_display0000}:</p>
		        <p class="pageinput">{$input_display0000}</p>
		</div>
		<div class="pageoverflow">
		        <p class="pagetext">{$title_showstats}:</p>
		        <p class="pageinput">{$input_showstats}</p>
		</div>
	</fieldset>
	<br>
	<fieldset>
	<legend>{$title_fieldset_team}</legend>
		<div class="pageoverflow">
		        <p class="pagetext">{$title_default_sexes}:</p>
		        <p class="pageinput">{$input_default_sexes}</p>
		</div>
	</fieldset>
	<br>
	<fieldset>
	<legend>{$title_fieldset_member}</legend>
		<div class="pageoverflow">
			<p class="pagetext">{$title_user_table}:</p>
			<p class="pageinput">{$input_user_table}</p>
			<p class="pageinput">{$info_user_table}</p>
		</div>
	</fieldset>
	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">{$submit}</p>
	</div>
	<br>
{$endform}