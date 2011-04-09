{* lost username confirm template form *}
<h4>{$title}</h4>
{if isset($message)}<h5 class="error">{$message}</h5>{/if}
{if $controlcount > 0}
  {$startform}{$hidden}
    <div class="pagerow">
      <div class="page_prompt">{$prompt_password}</div>
      <div class="page_input">{$input_password}</div>
    </div>
    {foreach from=$controls item='entry'}
       <div class="pagerow">
          <div class="page_prompt">{$entry->hidden}{$entry->prompt}</div
          <div class="page_input">{$entry->control}{$entry->addtext}</div>
       </div>
    {/foreach}
    <div class="pagerow">{$submit}{$cancel}</div>
    <div class="pagerow">
       {$captcha_title}{$input_captcha}{$captcha}
    </div>
  {$endform}
{/if}