<!-- change settings template -->
{$title}
{if $message != ''}
  {if $error != ''}
    <p><font color="red">{$message}</font></p>
  {else}
    <p>{$message}</p>
  {/if}
{/if}
{$startform}
 {if $controlcount > 0}
  <center>
  <table width="75%">
     {foreach from=$controls item=control}
  <tr>
     <td>{$control->hidden}<font color="{$control->color}">{$control->prompt}{$control->marker}</font></td>
     <td>
       {if isset($control->image)}{$control->image}<br/>{/if}
       {$control->control}{$control->addtext}
       {if isset($control->control2)}{$control->prompt2}&nbsp;{$control->control2}<br/>{/if}
     </td>
  </tr>
 {/foreach}
  </table>
  </center>
 {/if}
 {$hidden}{$hidden2}{$submit}
{$endform}
<!-- change settings template -->
