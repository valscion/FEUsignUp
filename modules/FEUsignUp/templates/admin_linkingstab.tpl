<p>Hello world! This is the linkings-tab.</p>
{$start_form}
  <fieldset>
    <legend>{$prompt_addlink}</legend>
    <div class="pageoverflow">
      <p class="pagetext">{$prompt_feugroup}</p>
      <p class="pageinput">{$input_feugroup}</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext">{$prompt_cgcal_category}</p>
      <p class="pageinput">{$input_cgcal_category}</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext">{$prompt_tss_team}</p>
      <p class="pageinput">{$input_tss_team}</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext">{$prompt_description}</p>
      <p class="pageinput">{$input_description}</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext">&nbsp;</p>
      <p class="pageinput">{$submit}</p>
    </div>
  </fieldset>
</form>

{if $itemcount > 0}
<table cellspacing="0" class="pagetable">
	<thead>
		<tr>
			<th>{$th_id}</th>
			<th>{$th_feug}</th>
			<th>{$th_cgcc}</th>
            <th>{$th_tsst}</th>
            <th>{$th_desc}</th>
            <th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>

{foreach from=$items item=link}
    <tr>
        <td>{$link->id}</td>
        <td>{$link->feu_group}</td>
        <td>{$link->cgcal_category}</td>
        <td>{$link->tss_team}</td>
        <td>{$link->desc}</td>
        <td>{$link->editlink}</td>
    </tr>
{/foreach}
    </tbody>
</table>
{/if}