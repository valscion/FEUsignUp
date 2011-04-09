<h3>{$title}</h3>

{if isset($message) }
  {if isset($error) }
    <p><font color="red">{$message}</font></p>
  {else}
    <p>{$message}</p>
  {/if}
{/if}

{$startform}
{if isset($hidden)}
<div>{$hidden}</div>
{/if}

<div class="pageoverflow">
  <p class="pagetext">{$prompt_groupname}</p>
  <p class="pageinput">{$input_groupname}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_groupdesc}</p>
  <p class="pageinput">{$input_groupdesc}</p>
</div>

{if $propcount > 0}
<br/>
<div class="pageoverflow">
<table cellspacing="0" class="pagetable">
  <thead>
    <tr>
      <th>{$nametext}</th>
      <th>{$prompttext}</th>
      <th>{$typetext}</th>
      <th>{$fieldstatustext}</th>
      <th>{$usedinlostuntext}</th>
      <th class="pageicon"></th>
      <th class="pageicon"></th>
    </tr>
  </thead>
  <tbody>
  {foreach from=$props item='prope'}
    {cycle values="row1,row2" assign='rowclass'}
    <tr class="{$rowclass}" onmouseover="this.className='{$rowclass}hover';" onmouseout="this.className='{$rowclass}';">
      <td>{$prope->hidden}{$prope->name}</td>
      <td>{$prope->prompt}</td>
      <td>{$prope->type}</td>
      <td>{$prope->required}</td>
      <td>{$prope->askinlostun}</td>
      <td>{if isset($prope->moveup)}{$prope->moveup}{/if}</td>
      <td>{if isset($prope->movedown)}{$prope->movedown}{/if}</td>
    </tr>
  {/foreach}
  </tbody>
</table>
</div>
{/if}

<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">{$hidden}{$submit}{$cancel}</p>
</div>
{$endform}
