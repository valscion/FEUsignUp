{if isset($module_message)}<h2>{$module_message|escape}</h2>{/if}
<h3>{$title_num_records}</h3>
{foreach from=$records item=entry}
   {* display something different depending on the mode *}
   {if $mode=='summary'}
   <div>{$entry->id}: {$entry->name} ({$entry->view}|{$entry->edit}) </div>
   {else}
   <div>{$entry->id}: {$entry->name}<br />{$entry->explanation}<br />({$entry->edit}) </div>
   {/if}
{/foreach}

{if $add != ''}<div>{$add}</div>{/if}