{$tabs_start}
   {$start_general_tab}
      {$welcome_text}
   {$tab_end}
   {$start_prefs_tab}
      {if $start_prefs_tab != ''}
      {$start_form}
      	<div class="pageoverflow">
      		<p class="pagetext">{$title_allow_add}:</p>
      		<p class="pageinput">{$input_allow_add}</p>
      	</div>
      	<div class="pageoverflow">
      		<p class="pagetext">&nbsp;</p>
      		<p class="pageinput">{$submit}</p>
      	</div>
      </form>
      {/if}
   {$tab_end}
{$tabs_end}