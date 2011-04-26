{$tab_info}
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
      <p class="pageinput">{$hidden}{$submit}</p>
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
            <th class="pageicon">&nbsp;</th>
            <th class="pageicon">&nbsp;</th>
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
        <td>{if isset($link->deletelink)}{$link->deletelink}{/if}</td>
    </tr>
{/foreach}
    </tbody>
</table>
{/if}